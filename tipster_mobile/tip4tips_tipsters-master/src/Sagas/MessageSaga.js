import React from 'react';
import * as messageService from '../Services/Messages/MessageService';
import * as actionType from '../Actions/ActionType';
import * as actionFunction from '../Actions/index';
import * as LocalStorageAction from '../Commons/LocalStorageAction';
import { put, takeLatest, select } from 'redux-saga/effects';
import * as API from '../API/apiCaller';

const getItems = state => state.networkReducer.isConnection;
function* checkIsOnline() {
    return yield select(getItems);
}

function* messageNewFetch(action) {
    try {
        yield put(actionFunction.loaddingTrue());
        let { tipsterId } = action;
        const isOnline = yield checkIsOnline();
        if (!isOnline) {
            let messageNewCount = 0;
            let messageNews = [];
            yield put(actionFunction.messageNewFetchSuccess(messageNews, messageNewCount));       
        } else {
            let data = yield messageService.fetchMessageNew(tipsterId);
            let messageNewCount = 0;
            let messageNews = [];
            if (data.messageAmount) {
                messageNewCount = data.messageAmount;
            }
            if (data.messages) {
                messageNews = data.messages.data;
            }
            yield put(actionFunction.messageNewFetchSuccess(messageNews, messageNewCount));
        }

    } catch (error) {
        console.log(error);
        yield put(actionFunction.messageNewFetchFailed(error));
    } finally {
        yield put(actionFunction.loaddingFalse());
    }
}

function* messageAllFetch(action) {
    try {
        yield put(actionFunction.loaddingTrue());
        const isOnline = yield checkIsOnline();
        if (!isOnline) {
            let messageAll = yield LocalStorageAction.getMessagesList();
            let messageAllCount = 0;
            yield put(actionFunction.messageAllFetchSuccess(messageAll, messageAllCount));
        } else {
            let { tipsterId } = action;
            let data = yield messageService.fetchMessageAll(tipsterId);
            let messageAllCount = 0;
            let messageAll = [];
            if (data.messageAmount) {
                messageAllCount = data.countMessages;
            }
            if (data.messages) {
                messageAll = data.messages.data;
            }
            yield LocalStorageAction.setMessagesList(messageAll);
            yield put(actionFunction.messageAllFetchSuccess(messageAll, messageAllCount));
        }
    } catch (error) {
        console.log(error);
        yield put(actionFunction.messageAllFetchFailed(error));
    } finally {
        yield put(actionFunction.loaddingFalse());
    }
}

function* messageDetailFetch(action) {
    try {
        yield put(actionFunction.loaddingTrue());
        let { messageId } = action;
        const isOnline = yield checkIsOnline();
        if (!isOnline) {
            let messageDetail = LocalStorageAction.getMessageDetail(messageId);
            yield put(actionFunction.messageDetailFetchSuccess(messageDetail));
        } else {
            let data = yield messageService.fetchMessageDetail(messageId);
            let messageDetail = 0;
            if (data.message) {
                messageDetail = data.message;
            }
            yield put(actionFunction.messageDetailFetchSuccess(messageDetail));
        }
    } catch (error) {
        console.log(error);
        yield put(actionFunction.messageDetailFetchFailed(error));
    } finally {
        yield put(actionFunction.loaddingFalse());
    }
}

export function* watchMessageNewFetch() {
    yield takeLatest(actionType.MESSAGE_NEW_FETCH, messageNewFetch);
}

export function* watchMessageAllFetch() {
    yield takeLatest(actionType.MESSAGE_ALL_FETCH, messageAllFetch);
}

export function* watchMessageDetailFetch() {
    yield takeLatest(actionType.MESSAGE_DETAIL_FETCH, messageDetailFetch);
}