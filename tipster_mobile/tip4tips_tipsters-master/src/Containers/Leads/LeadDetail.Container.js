import {connect} from 'react-redux';

import LeadDetailComponent from '../../Components/Leads/LeadDetail.Component';
import * as action from '../../Actions/index';

const mapStateToProps = (state) => {
    return{
        lead: state.leadReducer.lead,
        leadDeleteStatus: state.leadReducer.leadDeleteStatus,
        isConnection: state.networkReducer.isConnection
    }
}

const mapDispatchToProps = (dispatch) => {
    return{
        fetchLeadDetail: (leadId)=>{
            dispatch(action.leadDetailFetch(leadId));
        },
        leadDeleteInit: ()=>{
            dispatch(action.leadDeleteInit());
        },
        onDeleteLead: (leadId) =>{
            dispatch(action.leadDelete(leadId));
        },
        onLoginSuccess: (userInfo) => {
            dispatch(action.loginSuccess(userInfo));
        },

    }
}

const LeadDetailContainer = connect(mapStateToProps, mapDispatchToProps)(LeadDetailComponent);
export default LeadDetailContainer;