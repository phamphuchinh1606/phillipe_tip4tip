import React from 'react';
import * as giftService from '../Services/Gifts/GiftService';
import * as actionType from '../Actions/ActionType';
import * as actionFunction from '../Actions/index';
import * as LocalStorageAction from '../Commons/LocalStorageAction';
import { put, takeLatest, select } from 'redux-saga/effects';
import * as API from '../API/apiCaller';

const getItems = state => state.networkReducer.isConnection;
function* checkIsOnline() {
    return yield select(getItems);
}


function* giftFetch(action) {
    try {
        yield put(actionFunction.loaddingTrue());
        const isOnline = yield checkIsOnline();
        if (!isOnline) {
            // let messageAll = yield LocalStorageAction.getMessagesList();
            // let messageAllCount = 0;
            // yield put(actionFunction.messageAllFetchSuccess(messageAll, messageAllCount));
        } else {
            let { tipsterId, filterPoint } = action;
            let data = yield giftService.fetchGift(tipsterId,filterPoint);
            let gifts = [];
            if (data.gifts) {
                gifts = data.gifts;
            }
            // yield LocalStorageAction.setMessagesList(messageAll);
            yield put(actionFunction.giftFetchListSuccess(gifts));
        }
    } catch (error) {
        console.log(error);
        yield put(actionFunction.giftFetchListFailed(error));
    } finally {
        yield put(actionFunction.loaddingFalse());
    }
}

function* fetchGiftDetail(action){
    try {
        yield put(actionFunction.loaddingTrue());
        const isOnline = yield checkIsOnline();
        if (!isOnline) {
            // let messageAll = yield LocalStorageAction.getMessagesList();
            // let messageAllCount = 0;
            // yield put(actionFunction.messageAllFetchSuccess(messageAll, messageAllCount));
        } else {
            let { giftId } = action;
            let data = yield giftService.fetchGiftDetail(giftId);
            let gift = {};
            if (data) {
                gift = data;
            }
            // yield LocalStorageAction.setMessagesList(messageAll);
            yield put(actionFunction.giftFetchGiftDetailSuccess(gift));
        }
    } catch (error) {
        console.log(error);
        yield put(actionFunction.giftFetchGiftDetailFailed(error));
    } finally {
        yield put(actionFunction.loaddingFalse());
    }
}

export function* watchGiftFetch() {
    yield takeLatest(actionType.GIFT_FETCH_LIST, giftFetch);
}

export function* watchGiftFetchDetail() {
    yield takeLatest(actionType.GIFT_FETCH_DETAIL, fetchGiftDetail);
}