import {combineReducers} from 'redux';
import LoginReducer from './LoginReducer';
import leadReducer from './LeadReducer';
import loaddingReducer from './LoaddingReducer';
import messageReducer from './MessageReducer';
import userReducer from './UserReducer';
import networkReducer from './NetWorkReducer';

const allReducers = combineReducers({
    LoginReducer,
    leadReducer,
    loaddingReducer,
    messageReducer,
    userReducer,
    networkReducer
});
export default allReducers;