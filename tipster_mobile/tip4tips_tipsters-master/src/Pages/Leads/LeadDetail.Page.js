import React, {Component} from 'react';
import LeadDetailContainer from '../../Containers/Leads/LeadDetail.Container';

export default class LeadDetailPage extends Component{
    render(){
        return(
            <LeadDetailContainer history = {this.props.history} match = {this.props.match}/>
        );
    }
}