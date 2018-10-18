import React, { Component } from 'react';
 import MailDetailContainer from '../../Containers/Messages/MessageDetail.Container';

export default class MessageDetailPage extends Component {
    render() {
        return (
            <MailDetailContainer history = {this.props.history} match = {this.props.match}/>
        );
    }
}