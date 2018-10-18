import {connect} from 'react-redux';

import DashboardComponent from '../../Components/Home/Dashboard.Component';
import * as action from '../../Actions/index';
import * as Utils from '../../Commons/Utils';

const mapStateToProps = (state) => {
    return{
        recentStatusLeads : state.leadReducer.recentStatusLeads,
        userInfo: state.LoginReducer,
        products : state.leadReducer.products,
        isConnection: state.networkReducer.isConnection
    }
}

const mapDispatchToProps = (dispatch) => {
    return{
        onLoginSuccess: (userInfo)=>{
            dispatch(action.loginSuccess(userInfo));
        },
        fetchRecentStatus: (tipsterId, productId) => {
            dispatch(action.recentStatusLeadsFetch(tipsterId, productId));
        },
        onProductFetch: ()=>{
            dispatch(action.productFetch());
        },
        onFetchRegions: () => {
            dispatch(action.regionFetch());
        }
    }
}

const DashboardContainer = connect(mapStateToProps, mapDispatchToProps)(DashboardComponent);
export default DashboardContainer;