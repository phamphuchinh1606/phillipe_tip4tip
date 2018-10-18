import React, { Component } from 'react';
import LeadNewContainer from '../../Containers/Leads/LeadNew.Container';

export default class LeadNewPage extends Component {
    render() {
        return (
            <LeadNewContainer history = {this.props.history} match = {this.props.match}/>
        );
    }
}