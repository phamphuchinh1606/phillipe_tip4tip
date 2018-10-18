import React, { Component } from 'react';
import MenuParnerContainer from '../../Containers/Parners/MenuParner.Container';

export default class MenuParnerPage extends Component {
    render() {
        return (
            <MenuParnerContainer history = {this.props.history}/>
        );
    }
}