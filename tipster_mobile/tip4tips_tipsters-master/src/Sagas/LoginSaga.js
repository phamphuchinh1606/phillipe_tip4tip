import React from 'react';
import * as loginService from '../Services/Auth/LoginService';
import {LOGIN_ACTION, LOG_OUT} from '../Actions/ActionType';
import {loginSuccess, loginFailed} from '../Actions/index';
import {put, takeLatest} from 'redux-saga/effects';
import i18n from '../I18n/index';
import * as API from '../API/apiCaller';

const userInfoSuccess = {
    userName: 'phamphuchinh',
    userId : '2',
    avata: 'avata.jpg',
    fullName: 'phạm phú chinh',
    error: null,
    loginState: true
}

const USER_DEFAULT = {
    userName: '',
    userId : '',
    avata: '',
    fullName: '',
    error: null,
    loginState: false
}

function* login(action){
    try{
        let {email, password} = action.value;
        // yield put(loginSuccess(userInfoSuccess));
        // yield localStorage.setItem("userInfo",JSON.stringify(userInfoSuccess));
        let userInfo = yield loginService.loginAction(email,password);
        if(userInfo.status){
            if(userInfo.status === "0"){
                let userInfoSuccess = {};
                userInfoSuccess.userName = userInfo.user_info.username;
                userInfoSuccess.userId = userInfo.user_info.id;
                userInfoSuccess.avata = userInfo.user_info.avatar;
                userInfoSuccess.pathImage = userInfo.user_info.path_image,
                userInfoSuccess.fullName = userInfo.user_info.fullname,
                userInfoSuccess.date = userInfo.user_info.date,
                userInfoSuccess.error = null,
                userInfoSuccess.loginState = true;
                userInfoSuccess.preferredLang = userInfo.user_info.	preferred_lang;
                i18n.changeLanguage(userInfoSuccess.preferredLang);
                yield put(loginSuccess(userInfoSuccess));
                yield localStorage.setItem("userInfo",JSON.stringify(userInfoSuccess));
            }else{
                yield put(loginFailed(userInfo.message));
            }
        }else{
            yield put(loginFailed(userInfo.message));
        }
    }catch(error){
        console.log(error);
        yield put(loginFailed(error));
    }
}

function* logout(){
    try{
        yield localStorage.setItem("userInfo",JSON.stringify(USER_DEFAULT));
    }catch(error){
        console.log(error);
        yield put(loginFailed(error));
    }
}

export function* watchLogin(){
    yield takeLatest(LOGIN_ACTION,login);
}

export function* watchLogout(){
    yield takeLatest(LOG_OUT,logout);
}