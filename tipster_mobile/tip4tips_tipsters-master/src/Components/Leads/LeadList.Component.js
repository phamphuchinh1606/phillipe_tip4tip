import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import Modal from 'react-modal';
import apiCaller from '../../API/apiCaller';
import * as URL from '../../API/URL';
import './css/LeadNew.css';
import * as Utils from '../../Commons/Utils';
import * as LocalStorageAction from '../../Commons/LocalStorageAction';
import i18n from "../../I18n";
import * as transKey from "../../I18n/TransKey";
import  Select  from 'react-select';
import DatePicker from 'react-datepicker';
import "react-datepicker/dist/react-datepicker.css";
import "./css/LeadList.css"

const customStyles = {
    content: {
        top: '50%',
        left: '50%',
        right: 'auto',
        bottom: 'auto',
        with: '100%',
        transform: 'translate(-50%, -50%)',
        padding: 0,

    },
    filter:{
        paddingTop:'5px'
    }
};

const customStylesSelect = {
    control: styles => ({ ...styles, height: '43px',backgroundColor: "#f9ffff" })
}

let statusNewName = i18n.t(transKey.HOME_LEAD_STATUS_NEW);
let statusCallName = i18n.t(transKey.HOME_LEAD_STATUS_CALL);
let statusQuoteName = i18n.t(transKey.HOME_LEAD_STATUS_QUOTE);
let statusWinName = i18n.t(transKey.HOME_LEAD_STATUS_WIN);
let statusLostName = i18n.t(transKey.HOME_LEAD_STATUS_LOST);
let statusAssignName = i18n.t(transKey.HOME_LEAD_STATUS_ASSIGN);

const listStatus = [
    {
        id : 0,
        name : i18n.t(transKey.HOME_LEAD_STATUS_NEW)
    },
    {
        id : 5,
        name : i18n.t(transKey.HOME_LEAD_STATUS_ASSIGN)
    },
    {
        id : 1,
        name : i18n.t(transKey.HOME_LEAD_STATUS_CALL)
    },
    {
        id : 2,
        name : i18n.t(transKey.HOME_LEAD_STATUS_QUOTE)
    },
    {
        id : 3,
        name : i18n.t(transKey.HOME_LEAD_STATUS_WIN)
    },
    {
        id: 4,
        name: i18n.t(transKey.HOME_LEAD_STATUS_LOST)
    }
];

export default class LeadListComponent extends Component {
    constructor(props) {
        super(props);
        let today = new Date(),
        date = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
        this.state = {
            modalIsOpen: false,
            leadsSync: [],
            leadSyncName: 'Phạm Phú Chinh',
            totalRecordSync: 0,
            recordSynchronized: 0,
            syncContinue: true,
            userId: '',
            sortDate: 'desc',
            sortProduct: '',
            productId : '',
            statusId : '',
            selectedStatusOption: [],
            fromDate : date,
            toDate : date
        };
        this.openSync = this.openSync.bind(this);
        this.afterOpenModal = this.afterOpenModal.bind(this);
        this.closeModal = this.closeModal.bind(this);
    }

    openSync() {
        this.setState({ syncContinue: true });
        this.setState({ modalIsOpen: true });
    }

    delay = (ms) => {
        return new Promise(function (resolve, reject) {
            setTimeout(resolve, ms);
        });
    }

    async afterOpenModal() {
        if (this.state.leadsSync) {
            if (this.state.leadsSync.length > 0) {
                this.state.totalRecordSync = this.state.leadsSync.length;
                this.state.recordSynchronized = 0;
                this.setState(this.state);
                try {
                    let leads = this.state.leadsSync;
                    let urlEndPoint = URL.END_PONNT_LEAD_CREATE;
                    for (let index in leads) {
                        if (this.state.syncContinue) {
                            this.setState({ leadSyncName: leads[index].fullname });
                            await apiCaller(urlEndPoint, "POST", leads[index]).then(res => {
                                if (res.data) {
                                    if (res.data.status == "0") {
                                        LocalStorageAction.setLeadSync(leads[index]);
                                        console.log("thanh cong");
                                    }
                                }
                                this.setState({ recordSynchronized: this.state.recordSynchronized + 1 });
                            });
                        }
                    }
                    this.setState({ modalIsOpen: false });
                    let userInfo = Utils.getLogin();
                    if (userInfo) {
                        this.props.leadFetch(userInfo.userId,'','');
                    }
                } catch (error) {
                    console.log(error);
                    this.setState({ modalIsOpen: false });
                }
            }
        }
    }

    closeModal = ()=> {
        this.setState({ syncContinue: false });
        this.setState({ modalIsOpen: false });
    }

    componentDidMount() {
        let { leadFetch, leadCreateInit, leadUpdateInit, leadDeleteInit, onLoginSuccess, onFetchProducts, onFetchRegions, onFetchTipsters } = this.props;
        let userInfo = Utils.getLogin();
        onLoginSuccess(Utils.getLogin());
        if (userInfo) {
            leadFetch(userInfo.userId,'','');
            onFetchTipsters(userInfo.userId);
            this.state.userId = userInfo.userId;
        }
        onFetchProducts();
        onFetchRegions();
        leadCreateInit();
        leadUpdateInit();
        leadDeleteInit();
        this.state.leadsSync = LocalStorageAction.getLeadNotSync();
        this.setState(this.state);
    }

    fetchLead = (productId, statusId, listStatusId, fromDate, toDate) =>{
        let {leadFetch} = this.props;
        leadFetch(this.state.userId, productId, statusId, listStatusId, fromDate, toDate);
    }

    _onClickSortDate = () =>{
        if(this.state.sortDate == ""){
            this.state.sortDate = "asc";
        }else if(this.state.sortDate == "desc"){
            this.state.sortDate = "asc";
        }else{
            this.state.sortDate = "desc";
        }
        this.setState(this.state);
        this.props.leadSortDate(this.state.sortDate);
    }

    _onClickSortProduct = () =>{
        if(this.state.sortProduct == ""){
            this.state.sortProduct = "asc";
        }else if(this.state.sortProduct == "desc"){
            this.state.sortProduct = "asc";
        }else{
            this.state.sortProduct = "desc";
        }
        this.setState(this.state);
        this.props.leadSortProduct(this.state.sortProduct);
    }

    _onChangeProduct = (e) =>{
        this.state.productId = e.target.value;
        this.setState(this.state);
        this.fetchLead(this.state.productId, this.state.statusId, this.state.selectedStatusOption);
    }

    _onChangeStatus = (e) =>{
        this.state.statusId = e.target.value;
        this.setState(this.state);
        let listStatusId = this.state.selectedStatusOption.map((item) => {
            return item.value;
        });
        this.fetchLead(this.state.productId, this.state.statusId, this.state.listStatusId, this.state.fromDate, this.state.toDate);
    }

    __handleChangeSelectStatus = (selectedStatusOption) => {
        this.state.selectedStatusOption = selectedStatusOption;
        this.setState(this.state);
        let listStatusId = this.state.selectedStatusOption.map((item) => {
            return item.value;
        });
        this.fetchLead(this.state.productId, this.state.statusId,listStatusId, this.state.fromDate, this.state.toDate);
    }

    __handleChangeInputFromDate = (date) => {
        let strDate = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
        this.state.fromDate = strDate;
        this.setState(this.state);
        let listStatusId = this.state.selectedStatusOption.map((item) => {
            return item.value;
        });
        this.fetchLead(this.state.productId, this.state.statusId,listStatusId, this.state.fromDate, this.state.toDate);
    }

    __handleChangeInputToDate = (date) => {
        let strDate = date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
        this.state.toDate = strDate;
        this.setState(this.state);
        let listStatusId = this.state.selectedStatusOption.map((item) => {
            return item.value;
        });
        this.fetchLead(this.state.productId, this.state.statusId,listStatusId, this.state.fromDate, this.state.toDate);
    }

    render() {
        let { leads, leadCreaeStatus, leadDeleteStatus, isConnection, products } = this.props;

        if (!leads) leads = [];
        let headerInfo = [];
        if (leadCreaeStatus.status) {
            if (leadCreaeStatus.status === "0") {
                headerInfo = <div className="alert alert-success clearfix"><p>{leadCreaeStatus.message}</p></div>
            }
        } else if (leadDeleteStatus.status) {
            if (leadDeleteStatus.status === "0") {
                headerInfo = <div className="alert alert-success clearfix"><p>{leadDeleteStatus.message}</p></div>
            }
        }
        let leadsSync = LocalStorageAction.getLeadNotSync();
        let buttonSync = null;
        if (isConnection && leadsSync && leadsSync.length > 0) {
            buttonSync = <button className="btn btn-md btn-warning pull-right sync-leads" onClick={this.openSync}>
                <i className="fa fa-refresh"></i> {i18n.t(transKey.LEADS_SYNCHRONIZE)}
                        </button>;
        }
        //check length leads
        let noRecords = "";
        if(leads != null && leads.length == 0){
            noRecords = <tr className="text-center">
                            <td valign="top" colSpan="4" className="dataTables_empty">{i18n.t(transKey.COMMON_NO_RECORD)}</td>
                        </tr>
        }
        let sortDate = "fa fa-sort-numeric-asc";
        if(this.state.sortDate == "desc"){
            sortDate = "fa fa-sort-numeric-desc";
        }

        let sortProduct = "fa fa-sort-numeric-asc";
        if(this.state.sortProduct == "desc"){
            sortProduct = "fa fa-sort-numeric-desc";
        }

        let buttonFillter = "";
        let fillter = "";
        let statusOptions = listStatus.map((item, index) => {
            return ({ value: item.id, label: item.name })
        });
        if(this.props.isConnection){
            buttonFillter = <a href="#demo" data-toggle="collapse" className="btn btn-primary btn-xs">
                                <i className="fa fa-filter" aria-hidden="true"> </i>
                            </a>;
            fillter = <div id="demo" className="collapse row" style={customStyles.filter}>
                <div className="col-md-12">
                    <div className="col-xs-6">
                        <div className="form-group">
                            <label>{i18n.t(transKey.LEADS_FROM_DATE)}</label>
                            <div>
                                <DatePicker
                                    value={this.state.fromDate}
                                    dateFormat="MM/DD/YYYY"
                                    onChange={this.__handleChangeInputFromDate.bind(this)}
                                    className="form-control"
                                    name="fromDate"
                                    required={true}
                                />
                            </div>
                            {/*<input name="fromDate" type="date" className="form-control" value={this.state.fromDate} placeholder="Enter ..."*/}
                                   {/*onChange={this.__handleChangeInputDate.bind(this)}/>*/}
                        </div>
                    </div>
                    <div className="col-xs-6">
                        <div className="form-group">
                            <label>{i18n.t(transKey.LEADS_TO_DATE)}</label>
                            <div>
                                <DatePicker
                                    value={this.state.toDate}
                                    dateFormat="MM/DD/YYYY"
                                    onChange={this.__handleChangeInputToDate.bind(this)}
                                    className="form-control"
                                    name="toDate"
                                    required={true}
                                />
                            </div>
                            {/*<input name="toDate" type="date" className="form-control" value={this.state.toDate} placeholder="Enter ..."*/}
                                   {/*onChange={this.__handleChangeInputDate.bind(this)}/>*/}
                        </div>
                    </div>
                </div>
                <div className="col-md-12" style={{height:35}}>
                    <div className="col-xs-6" style={{height:25}}>
                        <select name="productId" className="form-control" onChange={this._onChangeProduct}>
                            <option value="" disabled="">{i18n.t(transKey.COMMON_ALL_PRODUCT)}</option>
                            {
                                products.map((item, index) => {
                                    return (
                                        <option value={item.id} key={index}>{item.name}</option>
                                    )
                                })
                            }
                        </select>
                    </div>
                    <div className="col-xs-6" style={{height:35}}>
                        {/*<select name="status" className="form-control" onChange={this._onChangeStatus}>*/}
                        {/*<option value="" disabled="">All Status</option>*/}
                        {/*{*/}
                        {/*listStatus.map((item, index) => {*/}
                        {/*return (*/}
                        {/*<option value={item.id} key={index}>{item.name}</option>*/}
                        {/*)*/}
                        {/*})*/}
                        {/*}*/}
                        {/*</select>*/}
                        <Select
                            value={this.state.selectedStatusOption}
                            onChange={this.__handleChangeSelectStatus}
                            options={statusOptions}
                            isMulti={true}
                            placeholder={i18n.t(transKey.COMMON_ALL_STATUS)}
                            styles={customStylesSelect}
                        />
                    </div>
                </div>

            </div>
        }
        return (
            <div className="box box-list">
                {/* box-header */}
                <div className="box-header with-border">
                    <h3 className="box-title">{i18n.t(transKey.LEADS_TITLE)}</h3>
                    <Link to="/menuparner" className="btn btn-md btn-primary pull-right">
                        <i className="fa fa-plus"></i> {i18n.t(transKey.LEADS_NEW_LEAD)}
                    </Link>
                    {buttonSync}
                </div>
                {fillter}
                <div>
                    {/* header info */}
                    {headerInfo}
                    <div>
                        <table className="table table-hover table-striped lead__list_mobile" style={{marginTop : 10}}>
                            <thead>
                                <tr>
                                    <th>{i18n.t(transKey.LEADS_NO)}.</th>
                                    <th>
                                        {i18n.t(transKey.LEADS_LEAD)}
                                        <span className="sort-date" onClick={this._onClickSortProduct}>
                                            <i className={sortProduct} aria-hidden="true"></i>
                                        </span>
                                    </th>
                                    <th>
                                        {i18n.t(transKey.LEADS_STATUS)}
                                        <span className="sort-date" onClick={this._onClickSortDate}>
                                            <i className={sortDate} aria-hidden="true"></i>
                                        </span>
                                    </th>
                                    <th className="text-center">
                                        {buttonFillter}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {
                                    leads.map((item, index) => {
                                        return (
                                            <tr key={index}>
                                                <td className="lead__no" align="center">{index + 1}</td>
                                                <td className="lead__name">
                                                    <div className="lead__box">
                                                        <span className="lead__name">
                                                            {item.fullname}
                                                        </span>
                                                        <span className="lead__product">{item.product}</span>
                                                    </div>
                                                </td>
                                                <td className="lead__status">
                                                    <div className="lead__box">
                                                        <span className="lead__name" style={{ color: item.status_color }}>
                                                            {item.status_text}
                                                            <span className="not_sync"> {item.new_offline_text} </span>
                                                        </span>
                                                        <span className="lead__product">{item.date}</span>
                                                    </div>
                                                </td>
                                                <td className="lead__actions actions text-center">
                                                    <Link to={{ pathname: `/leads/show/${item.id}` }} className="btn btn-xs btn-success">
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

                <Modal
                    isOpen={this.state.modalIsOpen}
                    onAfterOpen={this.afterOpenModal}
                    onRequestClose={this.closeModal}
                    style={customStyles}
                    contentLabel="Example Modal"
                >
                    <div className="header-modal">
                        <h3>{i18n.t(transKey.LEADS_SYNCHRONIZE_LEAD)}</h3>
                    </div>
                    <div className="content-modal">
                        <h4 className="text-center">lead: {this.state.leadSyncName}</h4>
                        <span className="image-loading"><img src="./images/sync_loadding.gif" /></span>
                        <div className="action-model clearfix">
                            <span className="total_leads">{i18n.t(transKey.LEADS_TOTAL_LEADS)} : {this.state.totalRecordSync}</span>
                            <span className="synchronized">{i18n.t(transKey.LEADS_SYNCHKRONIZED)} : {this.state.recordSynchronized}</span>
                        </div>
                    </div>
                    <div className="footer-modal">
                        <a className="btn btn-md btn-default pull-right" onClick={this.closeModal.bind(this)}>
                            <i className="fa fa-times-circle"></i> {i18n.t(transKey.COMMON_CLOSE)}
                        </a>
                    </div>
                </Modal>
            </div>
        );
    }
}