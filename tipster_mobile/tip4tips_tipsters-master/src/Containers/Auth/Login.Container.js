import {connect} from 'react-redux';

import LoginComponent from '../../Components/Auth/Login.Component';
import {loginAction,loginSuccess} from '../../Actions/index';

const mapStateToProps = (state) => {
    return{
        userInfo: state.LoginReducer,
        loginState: state.LoginReducer.loginState,
        loginError: state.LoginReducer.loginError
    }
}

const mapDispatchToProps = (dispatch) => {
    return{
        onLogin: (value)=>{
            dispatch(loginAction(value));
        },
        onLoginSuccess: (userInfo)=>{
            dispatch(loginSuccess(userInfo));
        }
    }
}

const LoginContainer = connect(mapStateToProps, mapDispatchToProps)(LoginComponent);
export default LoginContainer;