import * as actionType from '../Actions/ActionType';

const INITIAL_STATE = {
    messageAll: [],
    messageAllCount: 0,
    messageNews: [],
    messageNewCount: 0,
    messageDetail: {}
}

var LoginReducer = (state = INITIAL_STATE, action) => {
    let stateCopy = { ...state };
    switch (action.type) {
        case actionType.MESSAGE_NEW_FETCH_SUCCESS:
            stateCopy.messageNews = action.messageNews;
            stateCopy.messageNewCount = action.messageNewCount;
            return stateCopy;
        case actionType.MESSAGE_ALL_FETCH_SUCCESS:
            stateCopy.messageAll = action.messageAll;
            stateCopy.messageAllCount = action.messageAllCount;
            return stateCopy;
        case actionType.MESSAGE_DETAIL_FETCH_SUCCESS:
            stateCopy.messageDetail = action.messageDetail;
            return stateCopy;
        default:
            return state;
    }
}

export default LoginReducer;