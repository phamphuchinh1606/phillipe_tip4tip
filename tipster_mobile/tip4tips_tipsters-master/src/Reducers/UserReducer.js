import * as actionType from '../Actions/ActionType';

const INITIAL_STATE = {
    userInfo: {},
    userUpdate:{
        userInfo: {},
        regions: []
    },
    userUpdateStatus:{}
}

var UserReducer = (state = INITIAL_STATE, action) => {
    let stateCopy = { ...state };
    switch (action.type) {
        case actionType.USERS_SHOW_FETCH_SUCCESS:
            stateCopy.userInfo = action.userInfo;
            return stateCopy;
        case actionType.USERS_UPDATE_SHOW_FETCH_SUCCESS:
            stateCopy.userUpdate = action.userUpdate;
            return stateCopy;
        case actionType.USERS_UPDATE_SUCCESS:
            stateCopy.userUpdateStatus = action.userUpdate;
            return stateCopy;
        case actionType.USERS_UPDATE_INIT:
            stateCopy.userUpdateStatus = {}
            return stateCopy;
        default:
            return state;
    }
}

export default UserReducer;