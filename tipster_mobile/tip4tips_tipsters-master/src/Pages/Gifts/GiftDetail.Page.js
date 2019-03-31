import React, { Component } from 'react';
import GiftDetailContainer from '../../Containers/Gifts/GiftDetail.Container';

export default class GiftListPage extends Component {
    render() {
        return (
            <GiftDetailContainer history = {this.props.history} match = {this.props.match}/>
        );
    }
}