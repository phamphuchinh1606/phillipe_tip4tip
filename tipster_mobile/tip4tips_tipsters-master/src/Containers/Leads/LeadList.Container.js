import { connect } from 'react-redux';

import LeadListComponent from '../../Components/Leads/LeadList.Component';
import * as action from '../../Actions/index';

const mapStateToProps = (state) => {
    return {
        leads: state.leadReducer.leads,
        leadCreaeStatus: state.leadReducer.leadCreaeStatus,
        leadDeleteStatus: state.leadReducer.leadDeleteStatus,
        userInfo: state.LoginReducer,
        isConnection: state.networkReducer.isConnection,
        products : state.leadReducer.products
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        leadFetch: (tipsterId, productId, statusId, listStatusId, fromDate, toDate) => {
            dispatch(action.leadFetch(tipsterId, productId, statusId, listStatusId, fromDate, toDate));
        },
        leadSortDate: (sortDate) => {
          dispatch(action.leadSortDate(sortDate));
        },
        leadSortProduct: (sortProduct) => {
            dispatch(action.leadSortProduct(sortProduct));
        },
        leadCreateInit: () => {
            dispatch(action.leadCreaeInit());
        },
        leadUpdateInit: () => {
            dispatch(action.leadUpdateInit());
        },
        leadDeleteInit: () => {
            dispatch(action.leadDeleteInit());
        },
        onLoginSuccess: (userInfo) => {
            dispatch(action.loginSuccess(userInfo));
        },
        onFetchProducts: () => {
            dispatch(action.productFetch());
        },
        onFetchRegions: () => {
            dispatch(action.regionFetch());
        },
        onFetchTipsters: (tipsterId) =>{
            dispatch(action.tipsterFetch(tipsterId));
        }
    }
}

const LeadListContainer = connect(mapStateToProps, mapDispatchToProps)(LeadListComponent);
export default LeadListContainer;