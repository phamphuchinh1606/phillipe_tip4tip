import {connect} from 'react-redux';

import LeadNewComponent from '../../Components/Leads/LeadNew.Component';
import * as action from '../../Actions/index';

const mapStateToProps = (state) => {
    return{
        leadCreate: state.leadReducer.leadCreate,
        leadCreaeStatus : state.leadReducer.leadCreaeStatus,
        regions: state.leadReducer.regions,
        products : state.leadReducer.products,
        tipsterId : state.LoginReducer.userId
    }
}

const mapDispatchToProps = (dispatch) => {
    return{
        loadCreate: (tipsterId) =>{
            dispatch(action.leadLoadCreate(tipsterId));
        },
        leadCreateInit: ()=>{
            dispatch(action.leadCreaeInit());
        },
        onCreateLead: (lead) =>{
            dispatch(action.leadCreate(lead));
        },
        regionFetch: ()=>{
            dispatch(action.regionFetch());
        },
        productFetch: ()=>{
            dispatch(action.productFetch());
        },
        onLoginSuccess: (userInfo)=>{
            dispatch(action.loginSuccess(userInfo));
        }
    }
}

const ListNewContainer = connect(mapStateToProps, mapDispatchToProps)(LeadNewComponent);
export default ListNewContainer;