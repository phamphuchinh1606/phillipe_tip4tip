import React, { Component } from 'react';
import { Redirect, Link } from 'react-router-dom';
import * as Utils from '../../Commons/Utils';
import i18n from '../../I18n/index';
import * as transKey from '../../I18n/TransKey';

export default class GiftListComponent extends Component {
    constructor(props) {
        super(props);
    }
    componentDidMount() {
        let {onLoginSuccess, onFetchGiftList } = this.props;
        let userInfo = Utils.getLogin();
        onLoginSuccess(Utils.getLogin());
        if (userInfo) {
            onFetchGiftList(userInfo.userId);
        }
    }

    render() {
        let { gifts } = this.props;
        console.log(gifts);
        //check length leads
        let noRecords = "";
        if(gifts != null && gifts.length == 0){
            noRecords = <tr className="text-center">
                <td valign="top" colSpan="4" className="dataTables_empty">{i18n.t(transKey.COMMON_NO_RECORD)}</td>
            </tr>
        }

        return (
            <div className="box box-list">
                {/* box-header */}
                <div className="box-header with-border" style={{height:50}}>
                    <h3 className="box-title">{i18n.t(transKey.GIFTS_TITLE)}</h3>
                </div>
                <div>
                    <div>
                        <table className="table table-hover table-striped lead__list_mobile" style={{marginTop : 10}}>
                            <thead>
                            <tr>
                                <th>{i18n.t(transKey.GIFTS_NO)}.</th>
                                <th>
                                    {i18n.t(transKey.GIFTS_IMAGE)}
                                </th>
                                <th>
                                    {i18n.t(transKey.GIFTS_CATEGORY)}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            {
                                gifts.map((item, index) => {
                                    return (
                                        <tr key={index}>
                                            <td className="lead__no" align="center">{index + 1}</td>
                                            <td className="lead__name">
                                                <div className="lead__box">
                                                    <span className="lead__name">
                                                        <img src={item.path_image + '/' + item.thumbnail} alt={item.name} title={item.name} style={{maxWidth:80}} />
                                                    </span>
                                                    <span className="lead__product">{item.name}</span>
                                                </div>
                                            </td>
                                            <td className="lead__status">
                                                <div className="lead__box">
                                                    <span className="lead__name">
                                                        {item.category_name}
                                                    </span>
                                                    <span className="lead__product">{item.point}</span>
                                                </div>
                                            </td>
                                            <td className="lead__actions actions text-center">
                                                <Link to={{ pathname: `/gifts/show/${item.id}` }} className="btn btn-xs btn-success">
                                                    <i className="fa fa-eye"></i>
                                                </Link>
                                            </td>
                                        </tr>
                                    )
                                })
                            }
                            {/*If lead length = 0 then*/}
                            {noRecords}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        );
    }
}