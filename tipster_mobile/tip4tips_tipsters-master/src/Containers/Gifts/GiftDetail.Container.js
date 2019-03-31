import {connect} from 'react-redux';

import GiftDetailComponent from '../../Components/Gifts/GiftDetail.Component';
import * as action from '../../Actions/index';

const mapStateToProps = (state) => {
    return{
        gift : state.giftReducer.gift,
        isConnection: state.networkReducer.isConnection
    }
}

const mapDispatchToProps = (dispatch) => {
    return{
        fetchGiftDetail: (giftId)=>{
            dispatch(action.giftFetchGiftDetail(giftId));
        },
        onLoginSuccess: (userInfo) => {
            dispatch(action.loginSuccess(userInfo));
        },

    }
}

const GistDetailContainer = connect(mapStateToProps, mapDispatchToProps)(GiftDetailComponent);
export default GistDetailContainer;