import {LOGIN_SUCCESS, LOG_OUT, LOGIN_FAILED} from '../Actions/ActionType';

const INITIAL_STATE = {
    userName: '',
    userId : '',
    avata: '',
    date: '',
    pathImage: '',
    fullName: '',
    loginError: null,
    loginState: false
}

var LoginReducer = (state = INITIAL_STATE, action) => {
    return state;
    let stateCopy = { ...state };
    switch (action.type) {
        case LOG_OUT:
            return INITIAL_STATE;
        case LOGIN_SUCCESS:
            return action.userInfo;
        case LOGIN_FAILED:
            stateCopy.loginState = false;
            stateCopy.loginError = action.error;
            return stateCopy;
        default:
            return state;
    }
}

export default LoginReducer;