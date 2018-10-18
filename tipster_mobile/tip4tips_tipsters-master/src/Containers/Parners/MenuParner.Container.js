import {connect} from 'react-redux';

import MenuParnerComponent from '../../Components/Parners/MenuParner.Component';
import * as action from '../../Actions/index';

const mapStateToProps = (state) => {
    return{
        products : state.leadReducer.products,
        tipsterId : state.LoginReducer.userId
    }
}

const mapDispatchToProps = (dispatch) => {
    return{
        productFetch: ()=>{
            dispatch(action.productFetch());
        },
        onLoginSuccess: (userInfo)=>{
            dispatch(action.loginSuccess(userInfo));
        },
    }
}

const MenuParnerContainer = connect(mapStateToProps, mapDispatchToProps)(MenuParnerComponent);
export default MenuParnerContainer;