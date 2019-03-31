import {connect} from 'react-redux';

import GiftListComponent from '../../Components/Gifts/GiftList.Component';
import * as action from '../../Actions/index';

const mapStateToProps = (state) => {
    return{
        gifts : state.giftReducer.gifts,
        isConnection: state.networkReducer.isConnection
    }
}

const mapDispatchToProps = (dispatch) => {
    return{
        onFetchGiftList : (tipsterId) => {
            dispatch(action.giftFetchList(tipsterId));
        },
        // fetchLeadDetail: (leadId)=>{
        //     dispatch(action.leadDetailFetch(leadId));
        // },
        // leadDeleteInit: ()=>{
        //     dispatch(action.leadDeleteInit());
        // },
        // onDeleteLead: (leadId) =>{
        //     dispatch(action.leadDelete(leadId));
        // },
        onLoginSuccess: (userInfo) => {
            dispatch(action.loginSuccess(userInfo));
        },

    }
}

const GistListContainer = connect(mapStateToProps, mapDispatchToProps)(GiftListComponent);
export default GistListContainer;