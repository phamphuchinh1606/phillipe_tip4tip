import * as actionType from './ActionType';

export const loginAction = (value) => {
    return{
        type: actionType.LOGIN_ACTION,
        value : value
    }
}

export const loginCheck = () => {
    return{
        type: actionType.LOGIN_CHECK
    }
}

export const logOutAction = () => {
    return{
        type: actionType.LOG_OUT
    }
}

export const loginSuccess = (userInfo) =>{
    return {
        type: actionType.LOGIN_SUCCESS,
        userInfo : userInfo
    }
}

export const loginFailed = (error) => {
    return {
        type : actionType.LOGIN_FAILED,
        error: error
    }
}

//Loadding
export const loaddingTrue = () =>{
    return{
        type : actionType.LOADDING_TRUE
    }
}

export const loaddingFalse = () =>{
    return{
        type : actionType.LOADDING_FALSE
    }
}

//Lead
export const leadFetch = (tipsterId, productId, statusId, listStatusId, fromDate, toDate) => {
    return{
        type: actionType.LEAD_FETCH,
        tipsterId: tipsterId,
        productId: productId,
        statusId: statusId,
        listStatusId : listStatusId,
        fromDate : fromDate,
        toDate : toDate
    }
}

export const leadFetchSuccess = (leads) => {
    return{
        type : actionType.LEAD_FETCH_SUCCESS,
        leads: leads
    }
}

export const leadFetchFailead = (error) => {
    return{
        type : actionType.LEAD_FETCH_SUCCESS,
        error: error
    }
}

export const leadSortDate = (sortDate) =>{
    return{
        type: actionType.LEAD_SORT_DATE,
        sortDate: sortDate
    }
}

export const leadSortProduct = (sortProduct) =>{
    return{
        type: actionType.LEAD_SORT_PRODUCT,
        sortDate: sortProduct
    }
}

//load lead create
export const leadLoadCreate = (tipsterId) => {
    return{
        type: actionType.LEAD_LOAD_CREATE,
        tipsterId: tipsterId
    }
}

export const leadLoadCreateSuccess = (lead) => {
    return{
        type : actionType.LEAD_LOAD_CREATE_SUCCESS,
        lead: lead
    }
}

export const leadLoadCreateFailed = (error) => {
    return{
        type : actionType.LEAD_LOAD_CREATE_FAILED,
        error: error
    }
}

export const leadCreaeInit = () => {
    return{
        type: actionType.LEAD_CREATE_INIT
    }
}

export const leadCreate = (lead) => {
    return{
        type: actionType.LEAD_CREATE,
        lead: lead
    }
}

export const leadCreateSuccess = (success) => {
    return{
        type : actionType.LEAD_CREATE_SUCCESS,
        leadCreaeStatus: success
    }
}

export const leadCreateFailed = (error) => {
    return{
        type : actionType.LEAD_CREATE_FAILED,
        leadCreaeStatus: error
    }
}

//lead lead update
export const leadLoadUpdate = (tipsterId, leadId) => {
    return{
        type: actionType.LEAD_LOAD_UPDATE,
        tipsterId: tipsterId,
        leadId: leadId
    }
}

export const leadLoadUpdateSuccess = (leadUpdate) => {
    return{
        type : actionType.LEAD_LOAD_UPDATE_SUCCESS,
        leadUpdate: leadUpdate
    }
}

export const leadLoadUpdateFailed = (error) => {
    return{
        type : actionType.LEAD_LOAD_UPDATE_FAILED,
        error: error
    }
}

export const leadUpdateInit = () => {
    return{
        type: actionType.LEAD_UPDATE_INIT
    }
}

export const leadUpdate = (lead) => {
    return{
        type: actionType.LEAD_UPDATE,
        lead: lead
    }
}

export const leadUpdateSuccess = (success) => {
    return{
        type : actionType.LEAD_UPDATE_SUCCESS,
        leadUpdateStatus: success
    }
}

export const leadUpdateFailed = (error) => {
    return{
        type : actionType.LEAD_UPDATE_FAILED,
        leadUpdateStatus: error
    }
}

//lead delete
export const leadDeleteInit = () => {
    return{
        type: actionType.LEAD_DELETE_INIT
    }
}

export const leadDelete = (leadId) => {
    return{
        type: actionType.LEAD_DELETE,
        leadId: leadId
    }
}

export const leadDeleteSuccess = (success) => {
    return{
        type : actionType.LEAD_DELETE_SUCCESS,
        leadDeleteStatus: success
    }
}

export const leadDeleteFailed = (error) => {
    return{
        type : actionType.LEAD_DELETE_FAILED,
        leadDeleteStatus: error
    }
}
//Regions
export const regionFetch = () => {
    return{
        type: actionType.REGION_FETCH
    }
}

export const regionFetchSuccess = (regions) =>{
    return{
        type: actionType.REGION_FETCH_SUCCESS,
        regions: regions
    }
}

export const regionFetchFailed = (error) =>{
    return{
        type: actionType.REGION_FETCH_FAILED,
        error: error
    }
}
//Products
export const productFetch = () => {
    return{
        type: actionType.PRODUCT_FETCH
    }
}

export const productFetchSuccess = (products) =>{
    return{
        type: actionType.PRODUCT_FETCH_SUCCESS,
        products: products
    }
}

export const productFetchFailed = (error) =>{
    return{
        type: actionType.PRODUCT_FETCH_FAILED,
        error: error
    }
}

//Tipster
export const tipsterFetch = (tipsterId) => {
    return{
        type: actionType.TIPSTER_FETCH,
        tipsterId: tipsterId
    }
}

export const tipsterFetchSuccess = (tipsters) =>{
    return{
        type: actionType.TIPSTER_FETCH_SUCCESS,
        tipsters: tipsters
    }
}

export const tipsterFetchFailed = (error) =>{
    return{
        type: actionType.TIPSTER_FETCH_FAILED,
        error: error
    }
}

export const leadDetailFetch = (leadId) =>{
    return{
        type: actionType.LEAD_DETAIL_FETCH,
        leadId: leadId
    }
}

export const leadDetailFetchSuccess = (lead) =>{
    return{
        type: actionType.LEAD_DETAIL_FETCH_SUCCESS,
        lead: lead
    }
}

export const leadDetailFetchFailed = (error) =>{
    return{
        type: actionType.LEAD_DETAIL_FETCH_FAILED,
        error: error
    }
}

//Home
export const recentStatusLeadsFetch = (tipsterId, productId) => {
    return{
        type: actionType.RECENT_STATUS_LEADS_FETCH,
        tipsterId: tipsterId,
        productId: productId
    }
}

export const recentStatusLeadsFetchSuccess = (recentStatusLeads) => {
    return{
        type: actionType.RECENT_STATUS_LEADS_FETCH_SUCCESS,
        recentStatusLeads: recentStatusLeads
    }
}

export const recentStatusLeadsFetchFailed = (error) => {
    return{
        type: actionType.RECENT_STATUS_LEADS_FETCH_FAILED,
        error: error
    }
}

//Message
export const messageNewFetch = (tipsterId) => {
    return{
        type: actionType.MESSAGE_NEW_FETCH,
        tipsterId: tipsterId
    }
}

export const messageNewFetchSuccess = (messageNews, messageNewCount) => {
    return{
        type: actionType.MESSAGE_NEW_FETCH_SUCCESS,
        messageNews: messageNews,
        messageNewCount: messageNewCount
    }
}

export const messageNewFetchFailed = (error) => {
    return{
        type: actionType.MESSAGE_NEW_FETCH_FAILED,
        error: error
    }
}

export const messageAllFetch = (tipsterId) => {
    return{
        type: actionType.MESSAGE_ALL_FETCH,
        tipsterId: tipsterId
    }
}

export const messageAllFetchSuccess = (messageAll, messageAllCount) => {
    return{
        type: actionType.MESSAGE_ALL_FETCH_SUCCESS,
        messageAll: messageAll,
        messageAllCount: messageAllCount
    }
}

export const messageAllFetchFailed = (error) => {
    return{
        type: actionType.MESSAGE_ALL_FETCH_FAILED,
        error: error
    }
}

export const messageDetailFetch = (messageId) => {
    return{
        type: actionType.MESSAGE_DETAIL_FETCH,
        messageId: messageId
    }
}

export const messageDetailFetchSuccess = (messageDetail) => {
    return{
        type: actionType.MESSAGE_DETAIL_FETCH_SUCCESS,
        messageDetail: messageDetail
    }
}

export const messageDetailFetchFailed = (error) => {
    return{
        type: actionType.MESSAGE_DETAIL_FETCH_FAILED,
        error: error
    }
}

//Users
export const userShowFetch = (tipsterId) => {
    return{
        type: actionType.USERS_SHOW_FETCH,
        tipsterId: tipsterId
    }
}

export const userShowFetchSuccess = (userInfo) => {
    return{
        type: actionType.USERS_SHOW_FETCH_SUCCESS,
        userInfo: userInfo
    }
}

export const userShowFetchFailed = (error) => {
    return{
        type: actionType.USERS_SHOW_FETCH_FAILED,
        error: error
    }
}

export const userUpdateShowFetch = (tipsterId) => {
    return{
        type: actionType.USERS_UPDATE_SHOW_FETCH,
        tipsterId: tipsterId
    }
}

export const userUpdateShowFetchSuccess = (userUpdate) => {
    return{
        type: actionType.USERS_UPDATE_SHOW_FETCH_SUCCESS,
        userUpdate: userUpdate
    }
}

export const userUpdateShowFetchFailed = (error) => {
    return{
        type: actionType.USERS_UPDATE_SHOW_FETCH_FAILED,
        error: error
    }
}

export const userUpdate = (userInfo) => {
    return{
        type: actionType.USERS_UPDATE,
        userInfo: userInfo
    }
}

export const userUpdateInit = () =>{
    return{
        type: actionType.USERS_UPDATE_INIT
    }
}

export const userUpdateSuccess = (userUpdate) => {
    return{
        type: actionType.USERS_UPDATE_SUCCESS,
        userUpdate: userUpdate
    }
}

export const userUpdateFailed = (error) => {
    return{
        type: actionType.USERS_UPDATE_FAILED,
        error: error
    }
}

//Gift
export const giftFetchList = (tipsterId) =>{
    return {
        type : actionType.GIFT_FETCH_LIST,
        tipsterId : tipsterId
    }
}

export const giftFetchListSuccess = (gifts) => {
    return {
        type : actionType.GIFT_FETCH_LIST_SUCCESS,
        gifts : gifts
    }
}

export const giftFetchListFailed = (gifts) => {
    return {
        type : actionType.GIFT_FETCH_LIST_FAILED,
        gifts : gifts
    }
}

export const giftFetchGiftDetail = (giftId) =>{
    return {
        type : actionType.GIFT_FETCH_DETAIL,
        giftId : giftId
    }
}

export const giftFetchGiftDetailSuccess = (gift) =>{
    return {
        type : actionType.GIFT_FETCH_DETAIL_SUCCESS,
        gift : gift
    }
}

export const giftFetchGiftDetailFailed = (error) =>{
    return {
        type : actionType.GIFT_FETCH_DETAIL_FAILED,
        error : error
    }
}

//Network
export const networkSet = (isConnection)=>{
    return{
        type: actionType.NETWORD_SET,
        isConnection: isConnection
    }
}