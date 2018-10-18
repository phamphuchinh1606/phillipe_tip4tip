import * as actionType from '../Actions/ActionType';

const INITIAL_STATE = {
    isLoading: false
}

var LoaddingReducer = (state = INITIAL_STATE, action) => {
    let stateCopy = { ...state };
    switch (action.type) {
        case actionType.LOADDING_TRUE:
            stateCopy.isLoading = true;
            return stateCopy;
        case actionType.LOADDING_FALSE:
            stateCopy.isLoading = false;
            return stateCopy;
        default:
            return state;
    }
}

export default LoaddingReducer;