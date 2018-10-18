import React, { Component } from 'react';
import { Link, Redirect } from 'react-router-dom';
import * as Utils from '../../Commons/Utils';
import i18n from "../../I18n";
import * as transKey from "../../I18n/TransKey";

export default class UserShowComponent extends Component {
    constructor(props) {
        super(props);
    }

    componentDidMount() {
        let { id } = this.props.match.params;
        let { onFetchUserShow, onLoginSuccess } = this.props;
        let userInfo = Utils.getLogin();
        onLoginSuccess(Utils.getLogin());
        if (userInfo) {
            onFetchUserShow(userInfo.userId);
        }
    }

    render() {
        let { userInfo, isConnection } = this.props;
        let linkEdit = [];
        if (isConnection) {
            linkEdit = <Link to={`/user/edit/2`} className="btn btn-xs btn-info">
                            <i className="fa fa-pencil"></i> {i18n.t(transKey.COMMON_EDIT)}
                        </Link>
        }
        return (
            <div className="user_show row">
                <div className="col-md-8">
                    {/* About Me Box */}
                    <div className="box box-primary">
                        {/* box-header */}
                        <div className="box-header with-border">
                            <h3 className="box-title">{i18n.t(transKey.USER_TITLE_SHOW)}</h3>
                            <span className="group__action pull-right">
                                <Link to="/" className="btn btn-xs btn-default">
                                    <i className="fa fa-angle-left"></i> {i18n.t(transKey.COMMON_BACK)}
                                    </Link>
                                {linkEdit}
                            </span>
                        </div>
                        <div className="box-body">
                            <div className="row box-line">
                                <div className="col-sm-6">
                                    <p className="text-muted">
                                        <i className="fa fa-address-book margin-r-5"></i> {i18n.t(transKey.USER_FULL_NAME)}
                                            <span className="text-highlight">{userInfo.fullname}</span>
                                    </p>
                                </div>
                                <div className="col-sm-6">
                                    <p className="text-muted">
                                        <i className="fa fa-building margin-r-5"></i> {i18n.t(transKey.USER_LEVEL)}
                                            <span className="text-highlight">{userInfo.level}</span>
                                    </p>
                                </div>
                            </div>
                            <div className="row box-line">
                                <div className="col-sm-6">

                                    <p className="text-muted">
                                        <i className="fa fa-calendar margin-r-5"></i> {i18n.t(transKey.USER_BIRTHDAY)}
                                        <span className="text-highlight">{userInfo.birthday}</span>
                                    </p>
                                </div>
                                <div className="col-sm-6">
                                    <p className="text-muted">
                                        <i className="fa fa-venus-mars margin-r-5"></i> {i18n.t(transKey.USER_GENDER)}
                                            <span className="text-highlight">{userInfo.showGender}</span>
                                    </p>
                                </div>
                            </div>
                            <div className="row box-line">
                                <div className="col-sm-6">
                                    <p className="text-muted">
                                        <i className="fa fa-envelope margin-r-5"></i> {i18n.t(transKey.USER_EMAIL)}
                                        <span className="text-highlight">{userInfo.email}</span>
                                    </p>
                                </div>
                                <div className="col-sm-6">
                                    <p className="text-muted">
                                        <i className="fa fa-phone margin-r-5"></i> {i18n.t(transKey.USER_PHONE)}
                                        <span className="text-highlight">{userInfo.phone}</span>
                                    </p>
                                </div>
                            </div>
                            <div className="row box-line">
                                <div className="col-sm-6">
                                    <p className="text-muted">
                                        <i className="fa fa-home margin-r-5"></i> {i18n.t(transKey.USER_ADDRESS)}
                                        <span className="text-highlight">{userInfo.address}</span>
                                    </p>
                                </div>
                                <div className="col-sm-6">
                                    <p className="text-muted">
                                        <i className="fa fa-map-marker margin-r-5"></i> {i18n.t(transKey.USER_LOCATION)}
                                        <span className="text-highlight">{userInfo.region}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="col-md-4">
                    {/* Profile Image */}
                    <div className="box box-warning">
                        <div className="box-header with-border">
                            <h3 className="box-title">{i18n.t(transKey.USER_ACTIONS)}</h3>
                        </div>
                        <div className="box-body box-profile">
                            <div className="upload__area-image">
                                <span>
                                    <img id="imgHandle" src={`${userInfo.path_image}/${userInfo.avatar}`} />
                                    <label htmlFor="imgAnchorInput">{i18n.t(transKey.USER_UPLOAD_IMAGE)}</label>
                                </span>
                                <h4>{i18n.t(transKey.USER_AVATAR)}</h4>
                            </div>
                        </div>
                        <div className="box-body box-points">
                            <h4>{i18n.t(transKey.USER_POINT_TOTAL)}: <span>{userInfo.point}</span> {i18n.t(transKey.USER_POINTS)}</h4>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}