import React from 'react'
import Layout from "../../components/admin/Layout";
import Header from "../../components/admin/Header";

function Dashboard() {

    return (
        <Layout>
            <Header/>
            <div className="container">
                <h2 className="text-center mt-5 mb-3">Dashboard</h2>
            </div>
        </Layout>
    );
}

export default Dashboard;