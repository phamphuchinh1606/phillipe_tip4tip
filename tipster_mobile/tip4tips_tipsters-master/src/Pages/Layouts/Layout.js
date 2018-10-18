import React, { Component, Fragment } from 'react';
import { connect } from 'react-redux';


import routers from '../routers';
import { Switch, Route, Redirect } from 'react-router-dom';


import { checkLogin, Network } from '../../Commons/Utils';

import Header from '../Partials/Header';
import Footer from '../Partials/Footer';
import Menu from '../Partials/Menu';
import LogigPage from '../Auth/Login.Page';
import Dashboard from '../Home/Dashboard.Page';
import LeadList from '../Leads/LeadList.Page';

export default class Layout extends Component {

    showContentRoute = (routes) => {
        var result = null;
        if (routes.length > 0) {
            result = routes.map((route, index) => {
                return (
                    <Route
                        key={index}
                        path={route.path}
                        exact={route.exact}
                        component={route.main}
                    />
                );
            });
        }
        return result;
    }

    render() {
        let isLogin = checkLogin();
        if (!isLogin) {
            <Redirect to="/login" />
        }
        return (
            <div className="main-content">
                {/* header-starts */}
                <Header />
                {/* //header-ends */}
                {/*left-fixed -navigation*/}
                <Menu />
                {/*left-fixed -navigation*/}

                {/* main content start*/}
                <div className="content-wrapper" style={{ minHeight: 660 }}>
                    <section className="content">
                        <Network
                            onChange={({ online }) => {
                                if (online && window.cornify_add) {
                                    window.cornify_add()
                                }
                            }}
                            render={({ online }) => {
                                if(!online){
                                    return (
                                        <div className="network">
                                            No internet connection
                                        </div>
                                    )
                                }
                                return null;
                            }}
                        />
                        <Switch>
                            {this.showContentRoute(routers)}
                        </Switch>
                        <div className="clearfix"> </div>
                    </section>
                </div>
                {/*footer*/}
                <Footer />
                {/*//footer*/}
            </div>
        );
    }
}