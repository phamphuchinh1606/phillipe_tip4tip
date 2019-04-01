import * as URL from '../../API/URL';
import apiCaller from '../../API/apiCaller';

export function* fetchGift(tipsterId, filterPoint) {
    let gifts = {};
    let urlEndPoint = URL.END_POINT_GIFT_LIST + "/" + tipsterId+ "?filter_point="+filterPoint;
    yield apiCaller(urlEndPoint, "GET", null).then(res => {
        if (res.data) {
            gifts = res.data;
        }
    });
    return gifts;
}

export function* fetchGiftDetail(giftId){
    let gift = {};
    let urlEndPoint = URL.END_POINT_GIFT_DETAIL + "/" + giftId;
    yield apiCaller(urlEndPoint, "GET", null).then(res => {
        if (res.data) {
            gift = res.data;
        }
    });
    return gift;
}