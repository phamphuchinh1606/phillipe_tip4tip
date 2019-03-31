import React, { Component } from 'react';
import { Link, Redirect } from 'react-router-dom';
import * as Utils from '../../Commons/Utils';
import i18n from "../../I18n";
import * as transKey from "../../I18n/TransKey";

export default class GiftDetailComponent extends Component {
    constructor(props) {
        super(props);
    }

    componentDidMount() {
        let { id } = this.props.match.params;
        let { fetchGiftDetail, onLoginSuccess } = this.props;
        let userInfo = Utils.getLogin();
        onLoginSuccess(userInfo);
        fetchGiftDetail(id);
    }

    render() {
        let { gift, isConnection} = this.props;
        console.log(gift);
        return (
            <div className="user_show row">
                <div className="col-md-8">
                    {/* About Me Box */}
                    <div className="box box-primary">
                        {/* box-header */}
                        <div className="box-header with-border">
                            <h3 className="box-title">{i18n.t(transKey.GIFTS_DETAIL)}</h3>
                            <span className="group__action pull-right">
                                <Link to="/gifts" className="btn btn-xs btn-default">
                                    <i className="fa fa-angle-left"></i> {i18n.t(transKey.COMMON_BACK)}
                                </Link>
                            </span>
                        </div>
                        <div className="box-body">
                            <div className="row box-line">
                                <div className="col-sm-6">
                                    <p className="text-muted">
                                        <i className="fa fa-gift margin-r-5"></i> {i18n.t(transKey.GIFTS_NAME)}
                                        <span className="text-highlight">{gift.name}</span>
                                    </p>
                                </div>
                                <div className="col-sm-6">

                                    <p className="text-muted">
                                        <i className="fa fa-folder-open margin-r-5"></i> {i18n.t(transKey.GIFTS_CATEGORY)}
                                        <span className="text-highlight">{gift.category_name}</span>
                                    </p>
                                </div>
                            </div>
                            <div className="row box-line">
                                <div className="col-sm-6">
                                    <p className="text-muted">
                                        <i className="fa fa-braille margin-r-5"></i> {i18n.t(transKey.GIFTS_POINT)}
                                        <span className="text-highlight">{gift.point}</span>
                                    </p>
                                </div>
                                <div className="col-sm-6">
                                    <p className="text-muted">
                                        <i className="fa fa-info-circle margin-r-5"></i> {i18n.t(transKey.GIFTS_DESCRIPTION)}
                                        <span className="text-highlight">{gift.description}</span>
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
                            <h3 className="box-title">{i18n.t(transKey.GIFTS_IMAGE)}</h3>
                        </div>
                        <div className="box-body box-profile">
                            <div className="upload__area-image">
                                <span>
                                    <img id="imgHandle" src={`${gift.path_image}/${gift.thumbnail}`} />
                                    <label htmlFor="imgAnchorInput">{i18n.t(transKey.GIFTS_IMAGE)}</label>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}