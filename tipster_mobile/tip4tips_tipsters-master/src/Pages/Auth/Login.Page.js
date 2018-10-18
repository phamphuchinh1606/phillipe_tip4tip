import React, {Component} from 'react';
import LoginContainer from '../../Containers/Auth/Login.Container';

export default class LoginPage extends Component{
    render(){
        return(
            <LoginContainer {...this.props}/>
        );
    }
}