import * as URL from '../../API/URL';
import apiCaller from '../../API/apiCaller';

export function* fetchProducts() {
    let products = {};
    let urlEndPoint = URL.END_POINT_PRODUCT_LIST;
    yield apiCaller(urlEndPoint, "GET", null).then(res => {
        products = res.data;
    });
    return products;
}

export function* fetchRegions() {
    let regions = {};
    let urlEndPoint = URL.END_POINT_REGION_LIST;
    yield apiCaller(urlEndPoint, "GET", null).then(res => {
        regions = res.data;
    });
    return regions;
}

export function* fetchTipsters(tipsterId) {
    let tipsters = {};
    let urlEndPoint = URL.END_POINT_TIPSTER_LIST + "/" + tipsterId;
    yield apiCaller(urlEndPoint, "GET", null).then(res => {
        tipsters = res.data;
    });
    return tipsters;
}
