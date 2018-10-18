import React, { Component } from 'react';
import {connect} from 'react-redux';
import $ from 'jquery';
import './Loadding.css';


class Loadding extends Component {
    render() {
        if(!this.props.isLoading){
            return null;
        }
        return (
            <div className='loadding'>
                <img src="/images/svg/spiner.svg" alt="loading"/>
            </div>
        );
    }
}

const mapStateToProps = (state) => {
    return{
        isLoading : state.loaddingReducer.isLoading
    }
}

const mapDispatchToProps = (dispatch) => {
    return{}
}

export default connect(mapStateToProps, mapDispatchToProps)(Loadding);