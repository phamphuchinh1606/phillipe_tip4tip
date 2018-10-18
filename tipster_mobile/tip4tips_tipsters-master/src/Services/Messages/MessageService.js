import * as URL from '../../API/URL';
import apiCaller from '../../API/apiCaller';

export function* fetchMessageNew(tipsterId) {
    let messageNew = {};
    let urlEndPoint = URL.END_POINT_MESSAGE_NEW + "/" + tipsterId;
    yield apiCaller(urlEndPoint, "GET", null).then(res => {
        if (res.data) {
            messageNew = res.data;
        }
    });
    return messageNew;
}

export function* fetchMessageAll(tipsterId) {
    let messageAll = {};
    let urlEndPoint = URL.END_POINT_MESSAGE_ALL + "/" + tipsterId;
    yield apiCaller(urlEndPoint, "GET", null).then(res => {
        if (res.data) {
            messageAll = res.data;
        }
    });
    return messageAll;
}

export function* fetchMessageDetail(messageId) {
    let messageDetail = {};
    let urlEndPoint = URL.END_POINT_MESSAGE_DETAIL + "/" + messageId;
    yield apiCaller(urlEndPoint, "GET", null).then(res => {
        if (res.data) {
            messageDetail = res.data;
        }
    });
    return messageDetail;
}