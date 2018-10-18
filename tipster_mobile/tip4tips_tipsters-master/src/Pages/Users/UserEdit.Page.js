import React, { Component } from 'react';
import UserEditContainer from '../../Containers/Users/UserEdit.Container';

export default class UserEditPage extends Component {
    render() {
        return (
            <UserEditContainer history = {this.props.history} match = {this.props.match}/>
        );
    }
}