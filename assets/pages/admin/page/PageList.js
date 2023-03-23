import React, { useState, useEffect } from "react";
import Layout from "../../../components/admin/Layout";
import Header from "../../../components/admin/Header";
import {useDispatch, useSelector} from "react-redux";
import { Link } from "react-router-dom";
import {getPages} from "../../../actions/page";

function PageList() {
    const pages = useSelector(state => state.pages)

    const dispatch = useDispatch()

    useEffect(() => {
        dispatch(getPages())
    }, [])
    console.log(pages)

    return (
        <Layout>
            <Header/>
            <div className="container">
                <div className="row">
                    <h2 className="text-center mt-5 mb-3">Page list</h2>
                </div>
                <div className="row">
                    <div className="two columns">
                        <button className="button-primary" >
                            <Link to={'/pages/create'}>Add</Link>
                        </button>
                    </div>
                </div>
                <div className="row">
                    <table className="u-full-width">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Url</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        { Array.isArray(pages) ? pages.map( page => (
                            <tr>
                                <td>{page.id}</td>
                                <td>{page.name}</td>
                                <td>{page.url}</td>
                                <td>{page.status ? 'Enable' : 'Disable'}</td>
                                <td>
                                    <button>Delete</button>
                                    <Link to={`/pages/${page.id}/edit`}><button>Edit</button></Link>
                                </td>
                            </tr>
                        )) : 'List is empty'}
                        </tbody>
                    </table>
                </div>
            </div>
        </Layout>
    );
}

export default PageList;