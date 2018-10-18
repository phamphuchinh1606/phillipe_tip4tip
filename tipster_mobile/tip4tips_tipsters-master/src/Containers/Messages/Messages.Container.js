import {connect} from 'react-redux';

import MessagesComponent from '../../Components/Messages/Messages.Component';
import * as action from '../../Actions/index';

const mapStateToProps = (state) => {
    return{
        messageAll: state.messageReducer.messageAll,
        messageAllCount: state.messageReducer.messageAllCount
    }
}

const mapDispatchToProps = (dispatch) => {
    return{
        onMessageAllFetch : (tipsterId) =>{
            dispatch(action.messageAllFetch(tipsterId));
        },
        onLoginSuccess: (userInfo)=>{
            dispatch(action.loginSuccess(userInfo));
        }
    }
}

const MessagesContainer = connect(mapStateToProps, mapDispatchToProps)(MessagesComponent);
export default MessagesContainer;