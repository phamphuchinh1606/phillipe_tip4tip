import React, { Component } from 'react';
import LeadUpdateContainer from '../../Containers/Leads/LeadUpdate.Container';

export default class LeadUpdatePage extends Component {
    render() {
        return (
            <LeadUpdateContainer history = {this.props.history} match = {this.props.match}/>
        );
    }
}