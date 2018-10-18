import React, { Component } from 'react';
import { Link, Redirect } from 'react-router-dom';
import ReactPhoneInput from 'react-phone-input-2';
import apiCaller from '../../API/apiCaller';
import * as URL from '../../API/URL';
import * as Utils from '../../Commons/Utils';
import { confirmAlert } from 'react-confirm-alert'; // Import
import 'react-confirm-alert/src/react-confirm-alert.css' // Import css
import * as LocalStorageAction from '../../Commons/LocalStorageAction';

import './css/LeadNew.css';
import $ from "jquery";
import i18n from "../../I18n";
import * as transKey from "../../I18n/TransKey";

const lead = {
    leadName: '',
    gender: '',
    phone: '',
    email: '',
    regionId: '',
    region: '',
    product: '',
    productId: '',
    notes: '',
    tipsterReference: '',
    tipsterReferenceId: '',
    historys: []
}

export default class LeadUpdate extends Component {

    constructor(props) {
        super(props);
        this.state = {
            regions: [],
            products: [],
            tipsters: [],
            id: '',
            fullname: '',
            relationship: '',
            gender: '0',
            phone: '',
            email: '',
            regionId: '',
            productId: '',
            notes: '',
            tipsterId: '',
            lead: null,
            errors: ''
        }
    }

    async componentDidMount() {
        let { tipsterId, loadUpdate, leadUpdateInit, onLoginSuccess, isConnection } = this.props;
        let userInfo = Utils.getLogin();
        onLoginSuccess(Utils.getLogin());
        if (userInfo) {
            tipsterId = userInfo.userId;
        }
        leadUpdateInit();
        let { id } = this.props.match.params;
        if (isConnection) {
            let urlEndPoint = URL.END_POINT_LEAD_UPDATE + "/" + tipsterId + "/" + id;
            try {
                console.log(this.props);
                await this.props.onLoaddingTrue();
                await apiCaller(urlEndPoint, "GET", null).then(res => {
                    if (res) {
                        this.state.regions = res.data.regions;
                        this.state.products = res.data.products;
                        this.state.tipsters = res.data.tipsters;
                        this.state.id = res.data.lead.id;
                        this.state.fullname = res.data.lead.fullname;
                        this.state.relationship = res.data.lead.relationship;
                        this.state.gender = res.data.lead.gender;
                        this.state.phone = res.data.lead.phone;
                        this.state.email = res.data.lead.email;
                        this.state.regionId = res.data.lead.region_id;
                        this.state.productId = res.data.lead.product_id;
                        this.state.notes = res.data.lead.notes;
                        this.state.tipsterId = res.data.lead.tipster_id;
                        this.setState(this.state);
                    }
                });
            } catch (error) {
                console.log(error);
            } finally {
                await this.props.onLoaddingFalse();
            }
        } else {
            this.state.regions = LocalStorageAction.getRegionsList();
            this.state.products = LocalStorageAction.getProductsList();
            this.state.tipsters = LocalStorageAction.getTipstersList();
            let lead = LocalStorageAction.getLeadDetail(id);
            if (lead) {
                this.state.id = lead.id;
                this.state.fullname = lead.fullname;
                this.state.relationship = lead.relationship;
                this.state.gender = lead.gender;
                this.state.phone = lead.phone;
                this.state.email = lead.email;
                this.state.regionId = lead.region_id;
                this.state.productId = lead.product_id;
                this.state.notes = lead.notes;
                this.state.tipsterId = lead.tipster_id;
                this.state.lead = lead;
            }
            this.setState(this.state);
        }
    }

    handleChangeInput = (e) => {
        const name = e.target.name;
        const value = e.target.value;
        this.setState({ [name]: value });
    }

    handleOnChange = (value) => {
        this.setState({
            phone: value
        });
    }

    onSubmit = (e) => {
        e.preventDefault();
        let lead = {};
        if (this.state.lead) {
            lead = this.state.lead;
        }
        //Check Validate
        if(this.state.email == "" && (this.state.phone == "" || this.state.phone == "+84" || this.state.phone == "+")){
            this.state.errors = "Please enter email or phone number.";
            this.setState(this.state);
            return;
        }else{
            this.state.errors = "";
            this.setState(this.state);
        }
        lead.id = this.state.id;
        lead.fullname = this.state.fullname;
        lead.relationship = this.state.relationship;
        lead.email = this.state.email;
        lead.gender = this.state.gender;
        lead.phone = this.state.phone;
        lead.notes = this.state.notes;
        lead.product_id = this.state.productId;
        lead.region_id = this.state.regionId;
        lead.tipster_id = this.state.tipsterId;
        this.props.onUpdate(lead);
    }

    _onClickDelete = () => {
        let { onDeleteLead, lead } = this.props;
        let message = i18n.t(transKey.LEAD_MESSAGE_CONFIRM_DELETE_LEAD) + this.state.fullname + " ?";
        confirmAlert({
            title: i18n.t(transKey.LEAD_TITLE_CONFIRM_DELETE_LEAD),
            message: message,
            buttons: [
                {
                    label: i18n.t(transKey.LEAD_LABEL_DELETE_YES),
                    onClick: () => {
                        onDeleteLead(this.state.id);
                    }
                },
                {
                    label: i18n.t(transKey.LEAD_LABEL_DELETE_NO),
                    onClick: () => {

                    }
                }
            ]
        })
    }

    render() {
        let regions = this.state.regions.map((item, index) => {
            if (this.state.regionId == item.id) {
                return <option value={item.id} key={index} selected>{item.name}</option>
            }
            return (
                <option value={item.id} key={index}>{item.name}</option>
            )
        });

        let products = this.state.products.map((item, index) => {
            if (this.state.productId == item.id) {
                return <option value={item.id} key={index} selected>{item.name}</option>;
            }
            return (
                <option value={item.id} key={index}>{item.name}</option>
            )
        });

        let tipsters = this.state.tipsters.map((item, index) => {
            if (this.state.tipsterId == item.id) {
                <option value={item.id} selected key={index}> {item.username} </option>
            }
            return (
                <option value={item.id} selected key={index}> {item.username} </option>
            )
        });
        let inputMale = (<input type="radio" value="0" name="gender" onClick={this.handleChangeInput.bind(this)}/>);
        let inputFemale = <input type="radio" value="1" name="gender" onClick={this.handleChangeInput.bind(this)}/>
        if (this.state.gender === '0') {
            inputMale = <input type="radio" value="0" name="gender" checked onClick={this.handleChangeInput.bind(this)} />;
        } else {
            inputFemale = <input type="radio" value="1" name="gender" checked onClick={this.handleChangeInput.bind(this)} />
        }

        let inputRelationshipFamily = (<input type="radio" value="family" name="relationship" onClick={this.handleChangeInput.bind(this)}/>);
        let inputRelationshipAcquaintance = ( <input type="radio" value="acquaintance" name="relationship" onClick={this.handleChangeInput.bind(this)}/>);
        let inputRelationshipStanger = (<input type="radio" value="stranger" name="relationship" onClick={this.handleChangeInput.bind(this)}/>);
        if (this.state.relationship == 'family') {
            inputRelationshipFamily = (<input type="radio" value="family" name="relationship" checked onClick={this.handleChangeInput.bind(this)}/>);
        } else if (this.state.relationship == 'acquaintance'){
            inputRelationshipAcquaintance = ( <input type="radio" value="acquaintance" name="relationship" checked onClick={this.handleChangeInput.bind(this)}/>);
        } else {
            inputRelationshipStanger = (<input type="radio" value="stranger" name="relationship" checked onClick={this.handleChangeInput.bind(this)}/>);
        }

        let headerError = [];
        let { leadUpdateStatus } = this.props;
        if (leadUpdateStatus.status) {
            if (leadUpdateStatus.status == "1") {
                headerError = <div className="alert alert-danger clearfix"><p>{leadUpdateStatus.message}</p></div>
            } else {
                return <Redirect to="/leads" />
            }
        }

        if(this.state.errors != ""){
            headerError = <div className="alert alert-danger clearfix">
                <p>{this.state.errors}</p>
            </div>;
            $(window).scrollTop(0);
        }

        let { leadDeleteStatus } = this.props;
        if (leadDeleteStatus.status) {
            if (leadDeleteStatus.status === "1") {
                headerError = <div class="alert alert-danger clearfix"><p>{leadDeleteStatus.message}</p></div>
            } else {
                return <Redirect to="/leads" />
            }
        }
        return (
            <form onSubmit={this.onSubmit}>
                <div className="lead_update row">
                    <div className="col-md-12">
                        {/* create manager form */}
                        <div className="box box-success">
                            {/* box-header */}
                            <div className="box-header with-border">
                                <h3 className="box-title">Update Lead</h3>
                                <Link to="/leads" className="btn btn-xs btn-default pull-right">
                                    <i className="fa fa-angle-left"></i> {i18n.t(transKey.COMMON_BACK)}
                            </Link>
                            </div>

                            {/* box-body */}
                            <div className="box-body">
                                {/* header error */}
                                {headerError}
                                <div className="row">
                                    <div className="col-xs-12 col-sm-6">
                                        {/* text input */}
                                        <div className="form-group">
                                            <label>{i18n.t(transKey.LEAD_FULL_NAME)}</label>
                                            <input name="fullname" value={this.state.fullname} type="text" className="form-control" placeholder="Enter ..." required onChange={this.handleChangeInput.bind(this)} />
                                        </div>
                                    </div>
                                </div>

                                <div className="row">
                                    <div className="col-xs-12 col-sm-6">
                                        <div className="form-group group__relationship">
                                            <label className="Relationship">{i18n.t(transKey.LEAD_RELATIONSHIP)}</label>
                                            <div className="radio-inline relationship_female">
                                                <label>
                                                    {inputRelationshipFamily}
                                                    Family
                                                </label>
                                            </div>
                                            <div className="radio-inline relationship_female">
                                                <label>
                                                    {inputRelationshipAcquaintance}
                                                    Acquaintance
                                                </label>
                                            </div>
                                            <div className="radio-inline relationship_female">
                                                <label>
                                                    {inputRelationshipStanger}
                                                    Stranger
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="col-xs-12 col-sm-6">
                                        <div className="form-group group__gender">
                                            <label className="Gender">{i18n.t(transKey.LEAD_GENDER)}</label>
                                            <div className="radio-inline">
                                                <label>
                                                    {inputMale}
                                                    Male
                                                </label>
                                            </div>
                                            <div className="radio-inline">
                                                <label>
                                                    {inputFemale}
                                                    Female
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div className="row">
                                    <div className="col-xs-12 col-sm-6">
                                        <div className="form-group">
                                            <label>{i18n.t(transKey.LEAD_PHONE)}</label>
                                            {/*<input name="phone" value={this.state.phone} type="text" className="form-control" placeholder="Enter ..." onChange={this.handleChangeInput.bind(this)} required />*/}
                                            <ReactPhoneInput defaultCountry={'vn'} name="phone" onChange={this.handleOnChange} value={this.state.phone} inputClass="phone-number"/>
                                        </div>
                                    </div>
                                    <div className="col-xs-12 col-sm-6">
                                        <div className="form-group">
                                            <label>{i18n.t(transKey.LEAD_EMAIL)}</label>
                                            <input name="email" value={this.state.email} type="text" className="form-control" placeholder="Enter ..." onChange={this.handleChangeInput.bind(this)} />
                                        </div>
                                    </div>
                                </div>

                                <div className="row">
                                    <div className="col-xs-12 col-sm-6">
                                        <div className="form-group">
                                            <label>{i18n.t(transKey.LEAD_REGION)}</label>
                                            <select name="regionId" className="form-control" required onChange={this.handleChangeInput.bind(this)} required>
                                                <option value="" disabled selected>Please pick a region</option>
                                                {regions}
                                            </select>
                                        </div>
                                    </div>
                                    <div className="col-xs-12 col-sm-6">
                                        <div className="form-group">
                                            <label>{i18n.t(transKey.LEAD_PRODUCT)}</label>
                                            <select name="productId" className="form-control" required onChange={this.handleChangeInput.bind(this)} required>
                                                <option value="" disabled selected>Please pick a product</option>
                                                {products}
                                            </select>
                                        </div>
                                    </div>
                                    <div className="col-xs-12">
                                        <div className="form-group">
                                            <label>{i18n.t(transKey.LEAD_PRODUCT)}</label>
                                            <textarea name="notes" className="form-control" placeholder="URGENT - PLEASE CONTACT ASAP" rows="5" value={this.state.notes}
                                                onChange={this.handleChangeInput.bind(this)}>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div className="box-footer">
                                <Link to="/leads" className="btn btn-default">
                                    {i18n.t(transKey.COMMON_CANCEL)}
                                </Link>

                                <button type="submit" className="btn btn-primary pull-right">{i18n.t(transKey.COMMON_UPDATE)}</button>
                                <button type="button" className="btn btn-danger pull-right" onClick={this._onClickDelete.bind(this)}>
                                    {i18n.t(transKey.COMMON_DELETE)}
                                </button>
                            </div>
                        </div>
                    </div>
                    {/* <div className="col-md-4">
                        <div className="box box-success">
                            <div className="box-header with-border">
                                <h3 className="box-title">Actions</h3>
                            </div>
                            <div className="box-body">
                                <div className="form-group">
                                    <label>Tipster reference</label>
                                    <select name="tipsterId" className="form-control" onChange={this.handleChangeInput.bind(this)} required>
                                        <option value="" disabled selected>Please pick a tipster</option>
                                        {tipsters}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> */}
                </div>
            </form>
        );
    }
}