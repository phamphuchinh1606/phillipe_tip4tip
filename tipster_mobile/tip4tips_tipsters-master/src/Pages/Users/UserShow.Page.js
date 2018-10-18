import React, { Component } from 'react';
import UserShowContainer from '../../Containers/Users/UserShow.Container';

export default class UserShowPage extends Component {
    render() {
        return (
            <UserShowContainer history = {this.props.history} match = {this.props.match}/>
        );
    }
}