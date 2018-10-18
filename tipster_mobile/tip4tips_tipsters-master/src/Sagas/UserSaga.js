import React from 'react';


import * as userService from '../Services/Users/UserService';
import * as actionType from '../Actions/ActionType';
import * as actionFunction from '../Actions/index';
import * as LocalStorageAction from '../Commons/LocalStorageAction';
import {put, takeLatest, select} from 'redux-saga/effects';
import * as API from '../API/apiCaller';

const getItems = state => state.networkReducer.isConnection;
function* checkIsOnline(){
    return yield select(getItems);
}

function* fetchUserShow(action){
    try{
        yield put(actionFunction.loaddingTrue());
        const isOnline = yield checkIsOnline();
        let {tipsterId} = action;
        let userInfo = null;
        if(!isOnline){
            userInfo = yield LocalStorageAction.getUserInfo();
        }else{
            userInfo = yield userService.fetchUserShow(tipsterId);
            yield LocalStorageAction.setUserInfo(userInfo);
        }
        if(userInfo){
            yield put(actionFunction.userShowFetchSuccess(userInfo));
        }
    }catch(error){
        console.log(error);
        yield put(actionFunction.userShowFetchFailed(error));
    }finally{
        yield put(actionFunction.loaddingFalse());
    }
}

function* fetchUserUpdateShow(action){
    try{
        yield put(actionFunction.loaddingTrue());
        const isOnline = yield checkIsOnline();
        let {tipsterId} = action;
        let userUpdate = {};
        if(!isOnline){
            userUpdate.userInfo = yield LocalStorageAction.getUserInfo();
        }else{
            let data = yield userService.fetchUserUpdate(tipsterId);
            if(data.userInfo){
                userUpdate.userInfo = data.userInfo;
            }
            if(data.regions){
                userUpdate.regions = data.regions;
            }
        }
        if(userUpdate.userInfo){
            yield put(actionFunction.userUpdateShowFetchSuccess(userUpdate));
        }
    }catch(error){
        console.log(error);
        yield put(actionFunction.userUpdateShowFetchFailed(error));
    }finally{
        yield put(actionFunction.loaddingFalse());
    }
}

function* userUpdateAction(action){
    try{
        yield put(actionFunction.loaddingTrue());
        const isOnline = yield checkIsOnline();
        let {userInfo} = action;
        if(!isOnline){
            yield(put(actionFunction.userUpdateSuccess()));
        }else{
            let data = yield userService.userUpdateAction(userInfo);
            if(data.status){
                yield put(actionFunction.userUpdateSuccess(data));
            }else{
                yield put(actionFunction.userUpdateFailed("update tipster failed"));
            }
        }
    }catch(error){
        console.log(error);
        yield put(actionFunction.userUpdateFailed(error));
    }finally{
        yield put(actionFunction.loaddingFalse());
    }
}

export function* watchfetchUserShow(){
    yield takeLatest(actionType.USERS_SHOW_FETCH,fetchUserShow);
}

export function* watchfetchUserUpdateShow(){
    yield takeLatest(actionType.USERS_UPDATE_SHOW_FETCH,fetchUserUpdateShow);
}

export function* watchUserUpdate(){
    yield takeLatest(actionType.USERS_UPDATE,userUpdateAction);
}