import React, { Component } from 'react';
import {Link} from 'react-router-dom';
import i18n from "../../I18n";
import * as transKey from "../../I18n/TransKey";

const dataLeads = [
    {
        id: 1,
        date: '26-Apr-2018',
        fullname: 'phu chinh 1',
        product: 'Medical',
        status: 'Win'
    },
    {
        id: 2,
        date: '26-Apr-2018',
        fullname: 'phu chinh 2',
        product: 'Medical',
        status: 'Win'
    },
    {
        id: 3,
        date: '26-Apr-2018',
        fullname: 'phu chinh 3',
        product: 'Medical',
        status: 'Win'
    },
    {
        id: 4,
        date: '26-Apr-2018',
        fullname: 'phu chinh 4',
        product: 'Medical',
        status: 'Win'
    },
    {
        id: 5,
        date: '26-Apr-2018',
        fullname: 'phu chinh 5',
        product: 'Medical',
        status: 'Win'
    }
];

export default class RecentLeads extends Component {
    render() {
        let {recentleads} = this.props;
        if(!recentleads){
            recentleads = [];
        }
        return (
            <div className="box box-default">
                {/* box-header */}
                <div className="box-header with-border">
                    <h3 className="box-title">{i18n.t(transKey.HOME_RECENT_LEADS)}</h3>
                </div>
                {/* box-body */}
                <div className="box-body">
                    <div className="row">
                        <ul className="ul__users lead__list clearfix">
                            {
                                recentleads.map((item, index) => {
                                    return (
                                        <li key={index}>
                                            <span className="lead__box">
                                            <span className="lead__create-at">{item.created_date}</span>
                                            <Link to={`leads/show/${item.id}`} className="lead__info">
                                                <span className="lead__name">{item.fullname}
                                                    <span className="lead__status" style={{color: item.status_color}}>{item.status_text}</span>
                                                </span>
                                                <span className="lead__product">{item.product}</span>
                                            </Link>
                                            </span>
                                        </li>
                                    );
                                })
                            }
                        </ul>
                    </div>
                    {/* /.row */}
                </div>
                <div className="box-footer text-center">
                    <Link to="/leads" className="uppercase">
                        {i18n.t(transKey.HOME_VIEW_MORE_LEADS)} &#8594;
                    </Link>
                </div>
            </div>
        );
    }
}