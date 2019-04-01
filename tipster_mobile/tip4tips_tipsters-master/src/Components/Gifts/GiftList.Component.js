import React, { Component } from 'react';
import { Redirect, Link } from 'react-router-dom';
import * as Utils from '../../Commons/Utils';
import i18n from '../../I18n/index';
import * as transKey from '../../I18n/TransKey';
import queryString from "query-string";

export default class GiftListComponent extends Component {
    constructor(props) {
        super(props);
        this.state = {
            filterPoint: '1',
        };
    }
    componentDidMount() {
        let {onLoginSuccess, onFetchGiftList } = this.props;
        let userInfo = Utils.getLogin();
        onLoginSuccess(Utils.getLogin());
        if (userInfo) {
            const values = queryString.parse(this.props.history.location.search);
            this.state.filterPoint = values.filter_point;
            this.setState(this.state);
            onFetchGiftList(userInfo.userId, this.state.filterPoint);
        }
    }

    _onChangeFilterPoint = (e) =>{
        this.state.filterPoint = e.target.value;
        this.setState(this.state);
        let userInfo = Utils.getLogin();
        this.props.onFetchGiftList(userInfo.userId,this.state.filterPoint);
    }

    render() {
        let { gifts, isConnection } = this.props;
        console.log(gifts);
        //check length leads
        let noRecords = "";
        if(gifts != null && gifts.length == 0){
            noRecords = <tr className="text-center">
                <td valign="top" colSpan="4" className="dataTables_empty">{i18n.t(transKey.COMMON_NO_RECORD)}</td>
            </tr>
        }
        let fillter = "";
        let fillterPointGift = [
            {
                'name' : i18n.t(transKey.GIFTS_CAN_GET),
                'value' : 1
            },
            {
                'name' : i18n.t(transKey.GIFTS_ALL_GIFT),
                'value' : ''
            },
        ];
        if(isConnection){
            fillter =
                <div className="row" style={{paddingTop:5}}>
                    <div className="col-md-12">
                        <select name="pointStatus" className="form-control" onChange={this._onChangeFilterPoint}>
                            {
                                fillterPointGift.map((item, index) => {
                                    if(this.state.filterPoint == item.value){
                                        return (
                                            <option value={item.value} key={index} selected>{item.name}</option>
                                        )
                                    }
                                    return (
                                        <option value={item.value} key={index}>{item.name}</option>
                                    )
                                })
                            }
                        </select>
                    </div>
                </div>
        }

        return (
            <div className="box box-list">
                {/* box-header */}
                <div className="box-header with-border" style={{height:50}}>
                    <h3 className="box-title">{i18n.t(transKey.GIFTS_TITLE)}</h3>
                </div>
                {fillter}
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
                                                <Link to={{ pathname: `/gifts/show/${item.id}`, search: '?filter_point=' + this.state.filterPoint, }} className="btn btn-xs btn-success">
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