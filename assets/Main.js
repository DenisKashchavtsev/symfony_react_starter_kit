import React from 'react';
import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Home from "./pages/Home"
import Blog from "./pages/Blog"
import About from "./pages/About"
import Contact from "./pages/Contact"
import NotFound from "./pages/NotFound"
import Dashboard from "./pages/admin/Dashboard";
import PageList from "./pages/admin/page/PageList";
import store from "./store";
import { Provider } from "react-redux";
import PageCreate from "./pages/admin/page/PageCreate";
import PageEdit from "./pages/admin/page/PageEdit";

function Main() {
    return (
        <Router>
            <Routes>
                <Route exact path="/" element={<Home/>} />
                <Route path="/blog" element={<Blog/>} />
                <Route path="/about" element={<About/>} />
                <Route path="/contact" element={<Contact/>} />
                <Route path="/admin" element={<Dashboard/>} />

                <Route path="/pages" element={<PageList />}/>
                <Route path="/pages/create" element={<PageCreate/>} />
                <Route path="/pages/:id/edit" element={<PageEdit/>} />

                <Route element={<NotFound/>} />
            </Routes>
        </Router>
    );
}

export default Main;

if (document.getElementById('app')) {
    const rootElement = document.getElementById("app");
    const root = createRoot(rootElement);

    root.render(
        <Provider store={store}>
            <StrictMode>
                <Main />
            </StrictMode>
        </Provider>
    );
}