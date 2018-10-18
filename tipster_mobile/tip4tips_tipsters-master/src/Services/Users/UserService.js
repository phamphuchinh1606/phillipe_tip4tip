import * as URL from '../../API/URL';
import apiCaller from '../../API/apiCaller';

export function* fetchUserShow(tipsterId) {
    let userInfo = {};
    let urlEndPoint = URL.END_POINT_USER_SHOW + "/" + tipsterId;
    yield apiCaller(urlEndPoint, "GET", null).then(res => {
        if(res.data){
            userInfo = res.data.userInfo;
        }
    });
    return userInfo;
}

export function* fetchUserUpdate(tipsterId){
    let data = {};
    let urlEndPoint = URL.END_POINT_USER_UPDATE + "/" + tipsterId;
    yield apiCaller(urlEndPoint, "GET", null).then(res => {
        if(res.data){
            data = res.data;
        }
    });
    return data;
}

export function* userUpdateAction(userInfo){
    let data = {};
    let body = userInfo;
    let urlEndPoint = URL.END_POINT_USER_UPDATE;
    yield apiCaller(urlEndPoint, "POST", body).then(res => {
        if(res.data){
            data = res.data;
        }
    });
    return data;
}
