import React, {useEffect, useState} from 'react'
import Layout from "../../../components/admin/Layout";
import Header from "../../../components/admin/Header";
import {useDispatch, useSelector} from "react-redux";
import {createPage, getPage, updatePage} from "../../../actions/page";
import {useParams} from "react-router-dom";

function PageEdit() {

    const [page, setPage] = useState({
        name: '',
        content: '',
        url: '',
        metaTitle: '',
        metaDescription: '',
        status: true,
    })

    const params = useParams();

    useEffect(() => {
        dispatch(getPage(params.id)).then(res => {
            setPage(res);
        });
    }, []);

    const errors = useSelector(state => state.errors)

    const handlePage = (e, field) => {
        setPage({...page, [field]: e.target.value})
    }

    const dispatch = useDispatch();

    const handleClick = () => {
        dispatch(updatePage(params.id, page))
    }

    return (
        <Layout>
            <Header/>
            <div className="container">
                <div className="row">
                    <h1>Add page</h1>
                </div>
                <div className="row">
                    <div className="three columns">

                        <div>
                            <label htmlFor="name">Name</label>
                            <input
                                className="u-full-width"
                                type="text"
                                id="name"
                                onChange={(e) => handlePage(e, 'name')}
                                value={page.name}
                            />
                            {errors && errors.name ?
                                <div style={{color: 'red'}}>{errors.name}</div>
                                : ''}
                        </div>

                        <div>
                            <label htmlFor="content">Content</label>
                            <textarea
                                className="u-full-width"
                                id="content"
                                onChange={(e) => handlePage(e, 'content')}
                                value={page.content}
                            />
                            {errors && errors.content ?
                                <div style={{color: 'red'}}>{errors.name}</div>
                                : ''}
                        </div>

                        <div>
                            <label htmlFor="metaTitle">Meta title</label>
                            <textarea
                                className="u-full-width"
                                id="metaTitle"
                                onChange={(e) => handlePage(e, 'metaTitle')}
                                value={page.metaTitle}
                            />
                            {errors && errors.metaTitle ?
                                <div style={{color: 'red'}}>{errors.metaTitle}</div>
                                : ''}
                        </div>

                        <div>
                            <label htmlFor="metaDescription">Meta description</label>
                            <textarea
                                className="u-full-width"
                                id="metaDescription"
                                onChange={(e) => handlePage(e, 'metaDescription')}
                                value={page.metaDescription}
                            />
                            {errors && errors.metaDescription ?
                                <div style={{color: 'red'}}>{errors.metaDescription}</div>
                                : ''}
                        </div>

                        <div>
                            <label htmlFor="url">Url</label>
                            <input
                                className="u-full-width"
                                type="text"
                                id="url"
                                onChange={(e) => handlePage(e, 'url')}
                                value={page.url}
                            />
                            {errors && errors.url ?
                                <div style={{color: 'red'}}>{errors.url}</div>
                                : ''}
                        </div>

                        <div>
                            <span>Status</span>
                            <select
                                className="u-full-width"
                                id="status"
                                onChange={(e) => handlePage(e, 'status')}
                                value={page.status}
                            >
                                <option value="1">Enable</option>
                                <option value="0">Disable</option>
                            </select>
                            {errors && errors.status ?
                                <div style={{color: 'red'}}>{errors.status}</div>
                                : ''}
                        </div>

                        <div>
                            <button className="button-primary" onClick={handleClick}>Save</button>
                        </div>

                    </div>
                </div>
            </div>
        </Layout>
    );
}

export default PageEdit;