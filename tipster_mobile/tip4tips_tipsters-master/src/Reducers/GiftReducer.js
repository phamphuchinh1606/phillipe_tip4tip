import * as actionType from '../Actions/ActionType';

const INITIAL_STATE = {
    gifts: [],
    gift: {}
}

var GiftReducer = (state = INITIAL_STATE, action) => {
    let stateCopy = { ...state };
    switch (action.type) {
        case actionType.GIFT_FETCH_LIST_SUCCESS:
            stateCopy.gifts = action.gifts;
            return stateCopy;
        case actionType.GIFT_FETCH_DETAIL_SUCCESS:
            stateCopy.gift = action.gift;
            return stateCopy;
        default:
            return state;
    }
}

export default GiftReducer;