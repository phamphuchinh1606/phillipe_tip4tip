import * as actionType from '../Actions/ActionType';

const INITIAL_STATE = {
    isConnection: true,
}

var NetworkReducer = (state = INITIAL_STATE, action) => {
    let stateCopy = { ...state };
    switch (action.type) {
        case actionType.NETWORD_SET:
            stateCopy.isConnection = action.isConnection;
            return stateCopy;
        default:
            return state;
    }
}

export default NetworkReducer;