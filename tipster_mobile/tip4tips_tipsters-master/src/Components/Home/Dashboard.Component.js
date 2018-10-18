import React, { Component } from 'react';
import { Redirect, Link } from 'react-router-dom';
import RecentLeads from './RecentLeads';
import LeadStatus from './LeadStatus';
import * as Utils from '../../Commons/Utils';
import i18n from '../../I18n/index';
import * as transKey from '../../I18n/TransKey';

export default class DashboardComponent extends Component {
    constructor(props) {
        super(props);
    }
    componentDidMount() {
        let { fetchRecentStatus, onLoginSuccess, onProductFetch, onFetchRegions } = this.props;
        let userInfo = Utils.getLogin();
        onLoginSuccess(Utils.getLogin());
        if (userInfo) {
            fetchRecentStatus(userInfo.userId, -1);
            onProductFetch();
            onFetchRegions();
        }
    }

    render() {
        let { recentStatusLeads,products,fetchRecentStatus } = this.props;
        let recentleads = recentStatusLeads.recentleads;
        let statusLead = recentStatusLeads.statusLead;

        return (
            <div className="row dashboard">
                <div className="row margin-bottom-10">
                    <div className="col-sm-12 col-lg-12">
                        <Link className="btn btn-primary btn-block btn-add-lead" to="/menuparner">
                            <i className="fa fa-plus"></i>
                            <span className="margin-left-10"> {i18n.t(transKey.HOME_ADD_NEW_LEAD)}</span>
                        </Link>
                    </div>
                </div>
                <div className="row">
                    <div className="col-sm-12 col-lg-6">
                        {/* LEADS LIST */}
                        <LeadStatus {...this.props} statusLead={statusLead} products={products} fetchRecentStatus={fetchRecentStatus}
                                    i18n={i18n} transKey={transKey}/>
                    </div>
                    <div className="col-sm-12 col-lg-6">
                        {/* LEADS LIST */}
                        <RecentLeads recentleads={recentleads} i18n={i18n} transKey={transKey}/>
                    </div>
                </div>
            </div>
        );
    }
}