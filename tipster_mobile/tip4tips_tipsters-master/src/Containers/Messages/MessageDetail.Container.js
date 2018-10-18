import {connect} from 'react-redux';

import MessageDetailComponent from '../../Components/Messages/MessageDetail.Component';
import * as action from '../../Actions/index';

const mapStateToProps = (state) => {
    return{
        messageDetail: state.messageReducer.messageDetail,
    }
}

const mapDispatchToProps = (dispatch) => {
    return{
        onMessageDetailFetch : (messageId) =>{
            dispatch(action.messageDetailFetch(messageId));
        },
        onLoadMessageNew: (tipsterId) => {
            dispatch(action.messageNewFetch(tipsterId));
        },
        onLoginSuccess: (userInfo) => {
            dispatch(action.loginSuccess(userInfo));
        },
    }
}

const MessageDetailContainer = connect(mapStateToProps, mapDispatchToProps)(MessageDetailComponent);
export default MessageDetailContainer;