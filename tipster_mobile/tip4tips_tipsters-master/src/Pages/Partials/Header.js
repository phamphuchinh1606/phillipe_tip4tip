import React, { Component, Fragment } from 'react';
import { Link, Redirect } from 'react-router-dom';
import { connect } from 'react-redux';
import InnerHTML from 'dangerously-set-inner-html';
import { RawHTML } from 'react-dom';
import * as actionFunction from '../../Actions';
import * as Utils from '../../Commons/Utils';
import { Network } from '../../Commons/Utils';
import i18n from "../../I18n";
import * as transKey from "../../I18n/TransKey";

class Header extends Component {
    constructor(props) {
        super(props);
    }

    componentDidMount() {
        let { onLoadMessageNew } = this.props;
        let userInfo = Utils.getLogin();
        if (userInfo) {
            onLoadMessageNew(userInfo.userId);
        }
    }

    _onClickLogout = () => {
        var { onLogout } = this.props;
        onLogout();
        <Redirect to="/login" />
    }

    _clickRefreshMail = () =>{
        let { onLoadMessageNew } = this.props;
        let userInfo = Utils.getLogin();
        if (userInfo) {
            onLoadMessageNew(userInfo.userId);
        }
    }

    render() {
        let { messageNews, messageNewCount } = this.props;
        let userInfo = Utils.getLogin();
        let messagesHtml = <li>No messages.</li>;
        if (messageNews && messageNews.length > 0) {
            messagesHtml = messageNews.map((item, index) => {
                return (
                    <li key={index}>{/* start message */}
                        <Link to={`/messages/show/${item.id}`}>
                            <div className="pull-left">
                                {/* User Image */}
                                <img src={`${item.pathImage}/${item.senderAvatar}`} className="img-circle" alt="" />
                            </div>
                            {/* Message title and timestamp */}
                            <h4>
                                {item.senderUsername}
                                <small><i className="fa fa-clock-o"></i>
                                    <span dangerouslySetInnerHTML={{ __html: item.dateSend }} />
                                </small>
                            </h4>
                            {/* The message */}
                            <p dangerouslySetInnerHTML={{ __html: item.titleShow }} />
                        </Link>

                    </li>
                )
            })
        }
        return (
            <header className="main-header">
                <Network
                    onChange={({ online }) => {
                        if (online && window.cornify_add) {
                            window.cornify_add()
                        }
                    }}
                    render={({ online }) => {
                        let reloadPage = false;
                        if(!this.props.isConnection && online){
                            reloadPage = true;
                        }
                        this.props.onSetNetwork(online);
                        if(reloadPage){
                            window.location = "/";
                        }
                        return null;
                    }}
                />
                {/* Logo  */}
                <Link className="logo" to="#">
                    {/* mini logo for sidebar mini 50x50 pixels  */}
                    <span className="logo-mini"><img src="./logoTip4tip.png" width="20"/></span>
                    {/* logo for regular state and mobile devices  */}
                    <span className="logo-lg"><img src="./logoTip4tip.png" width="20"/> Tip4Tips</span>
                </Link>
                {/* Header Navbar */}
                {/* Right Side Of Navbar */}
                <nav className="navbar navbar-static-top" role="navigation">
                    {/* Sidebar toggle button*/}
                    <a href="#" className="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span className="sr-only">Toggle navigation</span>
                    </a>
                    <div className="navbar-custom-menu">
                        <ul className="nav navbar-nav">
                            {/* Messages: style can be found in dropdown.less*/}
                            <li className="dropdown messages-menu">
                                {/* Menu toggle button */}
                                <a href="#" className="dropdown-toggle" data-toggle="dropdown">
                                    <i className="fa fa-envelope-o"></i>
                                    <span className="label label-success">{messageNewCount}</span>
                                </a>
                                <ul className="dropdown-menu">
                                    <li className="header">
                                        <span>You have {messageNewCount} new messages</span>
                                        <button className="btn btn-xs btn-info pull-right" onClick={this._clickRefreshMail.bind(this)}>
                                            <i className="fa fa-refresh"></i> {i18n.t(transKey.MENU_REFRESH)}
                                        </button>
                                    </li>
                                    <li>
                                        {/* inner menu: contains the messages */}
                                        <ul className="menu">
                                            {messagesHtml}
                                            {/* end message */}
                                        </ul>
                                        {/* /.menu */}
                                    </li>
                                    <li className="footer">
                                        <Link to="/messages">{i18n.t(transKey.MENU_SEE_ALL_MESSAGE)}</Link>
                                    </li>
                                </ul>
                            </li>
                            {/* messages-menu */}

                            {/* User Account Menu */}
                            <li className="dropdown user user-menu">
                                {/* Menu Toggle Button */}
                                <a href="#" className="dropdown-toggle" data-toggle="dropdown">
                                    {/* The user image in the navbar*/}
                                    <img src={`${userInfo.pathImage}/${userInfo.avata}`} className="user-image" alt="user-image" />
                                    {/* hidden-xs hides the username on small devices so only the image appears. */}
                                    <span className="hidden-xs">{userInfo.fullName}</span>
                                </a>
                                <ul className="dropdown-menu">
                                    {/* The user image in the menu */}
                                    <li className="user-header">
                                        <img src={`${userInfo.pathImage}/${userInfo.avata}`} className="img-circle" alt="User Image" />
                                        <p>
                                            {userInfo.userName}
                                            <small>Member since : {userInfo.date}</small>
                                        </p>
                                    </li>
                                    {/* Menu Footer*/}
                                    <li className="user-footer">
                                        <div className="pull-left">
                                            <Link to={`/user/show/${userInfo.userId}`} className="btn btn-default btn-flat">
                                                {i18n.t(transKey.MENU_PROFILE)}
                                            </Link>
                                        </div>
                                        <div className="pull-right">
                                            <Link to="/login" onClick={() => this._onClickLogout()} className="btn btn-default btn-flat">
                                                {i18n.t(transKey.MENU_LOGOUT)}
                                            </Link>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
        );
    }
}

const mapStateToProps = (state) => {
    return {
        userInfo: state.LoginReducer,
        messageNews: state.messageReducer.messageNews,
        messageNewCount: state.messageReducer.messageNewCount,
        isConnection: state.networkReducer.isConnection
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        onLogout: () => {
            dispatch(actionFunction.logOutAction());
        },
        onLoadMessageNew: (tipsterId) => {
            dispatch(actionFunction.messageNewFetch(tipsterId));
        },
        onSetNetwork: (isConnection) =>{
            dispatch(actionFunction.networkSet(isConnection));
        }
    }
}

const HeaderContainer = connect(mapStateToProps, mapDispatchToProps)(Header);
export default HeaderContainer;