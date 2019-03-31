import {combineReducers} from 'redux';
import LoginReducer from './LoginReducer';
import leadReducer from './LeadReducer';
import loaddingReducer from './LoaddingReducer';
import messageReducer from './MessageReducer';
import userReducer from './UserReducer';
import giftReducer from './GiftReducer';
import networkReducer from './NetWorkReducer';

const allReducers = combineReducers({
    LoginReducer,
    leadReducer,
    loaddingReducer,
    messageReducer,
    userReducer,
    giftReducer,
    networkReducer
});
export default allReducers;