import {connect} from 'react-redux';

import UserShowComponent from '../../Components/Users/UserShow.Component';
import * as action from '../../Actions/index';

const mapStateToProps = (state) => {
    return{
        userInfo: state.userReducer.userInfo,
        isConnection: state.networkReducer.isConnection
    }
}

const mapDispatchToProps = (dispatch) => {
    return{
        onFetchUserShow: (tipsterId)=>{
            dispatch(action.userShowFetch(tipsterId));
        },
        onLoginSuccess: (userInfo) => {
            dispatch(action.loginSuccess(userInfo));
        }
    }
}

const UserShowContainer = connect(mapStateToProps, mapDispatchToProps)(UserShowComponent);
export default UserShowContainer;