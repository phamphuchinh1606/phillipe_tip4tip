import {connect} from 'react-redux';

import UserEditComponent from '../../Components/Users/UserEdit.Component';
import * as action from '../../Actions/index';

const mapStateToProps = (state) => {
    return{
        userUpdate: state.userReducer.userUpdate,
        userUpdateStatus: state.userReducer.userUpdateStatus
    }
}

const mapDispatchToProps = (dispatch) => {
    return{
        onLoginSuccess: (userInfo) => {
            dispatch(action.loginSuccess(userInfo));
        },
        onLoadUpdate: (tipsterId)=>{
            dispatch(action.userUpdateShowFetch(tipsterId));
        },
        onLoaddingTrue: () =>{
            dispatch(action.loaddingTrue());
        },
        onLoaddingFalse: () =>{
            dispatch(action.loaddingFalse());
        },
        onUpdateAction: (userInfo)=>{
            dispatch(action.userUpdate(userInfo));
        },
        onUpdateInit: () =>{
            dispatch(action.userUpdateInit());
        }
    }
}

const UserEditContainer = connect(mapStateToProps, mapDispatchToProps)(UserEditComponent);
export default UserEditContainer;