import React, { Component, Fragment } from 'react';
import { connect } from 'react-redux';


import routers from '../routers';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import Fullscreen from "react-full-screen";

import { checkLogin } from '../../Commons/Utils';

import LogigPage from '../Auth/Login.Page';
import Layout from './Layout';

import Loadding from '../../Components/Commons/Loadding';

const userInfoSuccess = {
    userName: 'phamphuchinh',
    userId: '1',
    avata: 'avata.jpg',
    fullName: 'phạm phú chinh',
    error: null,
    loginState: true
}

class RootLayout extends Component {

    constructor(props) {
        super(props);

        this.state = {
            isFull: false,
        };
    }
    goFull = () => {
        this.setState({ isFull: true });
    }

    showLayoutLogin() {
        return <Fullscreen
            enabled={this.state.isFull}
        >  
            <LogigPage {...this.props}/>
        </Fullscreen>
    }

    render() {
        let isLogin = checkLogin();
        if (!isLogin) {
            return this.showLayoutLogin();
        } else {
            
            return (
                <Fullscreen
                    enabled={this.state.isFull}
                >
                    <Layout {...this.props}/>
                    <Loadding/>
                </Fullscreen>
            );
        }
    }
}

const mapStateToProps = (state) => {
    return {
        userInfo: state.LoginReducer
    }
}

const mapDispatchToProps = (dispatch) => {
    return {}
}

export default RootLayout;