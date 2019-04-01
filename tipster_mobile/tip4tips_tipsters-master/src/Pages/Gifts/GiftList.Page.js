import React, { Component } from 'react';
import GiftListContainer from '../../Containers/Gifts/GiftList.Container';
import GiftDetailContainer from "../../Containers/Gifts/GiftDetail.Container";

export default class GiftListPage extends Component {
    render() {
        return (
            <GiftListContainer history = {this.props.history} match = {this.props.match}/>
        );
    }
}