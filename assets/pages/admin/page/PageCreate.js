import React, {useState} from 'react'
import Layout from "../../../components/admin/Layout";
import Header from "../../../components/admin/Header";
import {useDispatch, useSelector} from "react-redux";
import {createPage} from "../../../actions/page";

function PageCreate() {

    const [name, setName] = useState('')
    const [url, setUrl] = useState('')
    const [status, setStatus] = useState(true)

    const errors = useSelector(state => state.errors)

    const handleName = (e) => setName(e.target.value)
    const handleUrl = (e) => setUrl(e.target.value)
    const handleStatus = (e) => setStatus(e.target.value)

    const dispatch = useDispatch();

    const handleClick = () => {
        dispatch(createPage({name, url, status}))
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
                            <label htmlFor="nameInput">Name</label>
                            <input
                                className="u-full-width"
                                type="text"
                                id="nameInput"
                                onChange={handleName}
                                value={name}
                            />
                            {errors && errors.name ?
                                <div style={{color: 'red'}}>{errors.name}</div>
                                : ''}
                        </div>

                        <div>
                            <label htmlFor="textInput">Url</label>
                            <input
                                className="u-full-width"
                                type="text"
                                id="textInput"
                                onChange={handleUrl}
                                value={url}
                            />
                            {errors && errors.url ?
                                <div style={{color: 'red'}}>{errors.url}</div>
                                : ''}
                        </div>

                        <div>
                            <span>Status</span>
                            <select
                                className="u-full-width"
                                onChange={handleStatus}
                                value={status}
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

export default PageCreate;