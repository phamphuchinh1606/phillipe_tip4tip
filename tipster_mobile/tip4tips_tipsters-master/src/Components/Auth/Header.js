import React, { Component } from 'react';
import {Link} from 'react-router-dom';

export default class Header extends Component {
    render() {
        return (
            <nav className="navbar-static-top">
                <div className="container">
                    <div className="navbar-header">
                        {/* Collapsed Hamburger */}
                        <button type="button" className="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                            <span className="sr-only">Toggle Navigation</span>
                            <span className="icon-bar" />
                            <span className="icon-bar" />
                            <span className="icon-bar" />
                        </button>
                        {/* Branding Image */}
                        <Link className="navbar-brand" to="#">
                            Tip4tips
                        </Link>
                    </div>
                    <div className="collapse navbar-collapse" id="app-navbar-collapse">
                        {/* Right Side Of Navbar */}
                        <ul className="nav navbar-nav navbar-right">
                            {/* Authentication Links */}
                            <li>
                                <a className="btn-register">Register</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        );
    }
}