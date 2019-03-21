import React, { Component } from 'react';
import { Link, Redirect } from 'react-router-dom';
import ReactPhoneInput from 'react-phone-input-2';
import  Select  from 'react-select';
import $ from 'jquery';
import * as Utils from '../../Commons/Utils';

import './css/LeadNew.css';
import {confirmAlert} from "react-confirm-alert";
import i18n from "../../I18n";
import * as transKey from "../../I18n/TransKey";

const customStylesSelect = {
    control: styles => ({ ...styles, height: '43px',backgroundColor: "#f9ffff" })
}

export default class LeadNew extends Component {

    constructor(props) {
        super(props);
        this.state = {
            fullname: '',
            relationship: '',
            gender: '0',
            phone: '',
            email: '',
            regionId: '',
            productId: '',
            notes: '',
            tipsterId: '',
            errors: '',
            isCreateContinue : false,
            selectedOption: [],
        }
    }

    componentDidMount() {
        //fet data drop box
        let { loadCreate, tipsterId, leadCreateInit, onLoginSuccess } = this.props;
        let userInfo = Utils.getLogin();
        onLoginSuccess(Utils.getLogin());
        if (userInfo) {
            tipsterId = userInfo.userId;
        }
        leadCreateInit();
        loadCreate(tipsterId);
        this.state.tipsterId = tipsterId;
        if (this.props.history.location.state) {
            let productParamId = this.props.history.location.state.productId;
            this.state.selectedOption = productParamId;
        }
        this.state.relationship = 'family';
        this.setState(this.state);
        this.refs.fullname.focus();
    }

    init = () => {
        this.props.leadCreateInit();
        this.state.fullname = '';
        this.state.phone = '';
        this.state.email = '';
        this.state.errors = '';
        this.state.notes = '';
        this.state.isCreateContinue = true;
        this.setState(this.state);
        this.forceUpdate();
    }

    handleChangeInput = (e) => {
        const name = e.target.name;
        const value = e.target.value;
        this.setState({ [name]: value });
        this.setState({ 'errors': '' });

    }

    handleOnChange = (value) => {
        this.setState({
            phone: value
        });
    }

    handleChangeSelect = (selectedOption) => {
        this.setState({ selectedOption });
    }

    onSubmit = (e) => {
        e.preventDefault();
        this.state.isCreateContinue = false;
        //Check Validate
        if(this.state.email == "" && (this.state.phone == "" || this.state.phone == "+84" || this.state.phone == "+")){
            this.state.errors = "Please enter email or phone number.";
            this.setState(this.state);
            return;
        }else if(this.state.selectedOption.length == 0){
            this.state.errors = "Please chose product.";
            this.setState(this.state);
            return;
        }else{
            this.state.errors = "";
            this.setState(this.state);
        }
        let lead = {};
        lead.fullname = this.state.fullname;
        lead.relationship = this.state.relationship;
        lead.email = this.state.email;
        lead.gender = this.state.gender;
        lead.phone = this.state.phone;
        lead.notes = this.state.notes;
        //Selected product
        if(this.state.selectedOption.length > 0){
            let listProductId = this.state.selectedOption.map((item) => {
                return item.value;
            });
            lead.product_id = listProductId.join(',');
        }else{
            lead.product_id = '';
        }
        if(this.state.regionId == ''){
            let { leadCreate } = this.props;
            if (leadCreate.tipsters) {
                this.state.regionId = leadCreate.tipsters.region_id;
            }
        }
        lead.region_id = this.state.regionId;
        lead.tipster_id = this.state.tipsterId;
        this.props.onCreateLead(lead);
    }

    _onClickComfirm = async () => {
        let message = i18n.t(transKey.LEAD_MESSAGE_CONFIRM_ADD_NEW_LEAD);
        await confirmAlert({
            title: i18n.t(transKey.LEAD_TITLE_CONFIRM_ADD_NEW_LEAD),
            message: message,
            buttons: [
                {
                    label: i18n.t(transKey.LEAD_LABEL_ADD_NEW_LEAD),
                    onClick: () => {
                        // window.location = "/leads-add";
                        this.init();
                        this.render();
                    }
                },
                {
                    label: i18n.t(transKey.LEAD_LABEL_NO_THANK),
                    onClick: () => {
                        this.props.history.push('/leads');
                    }
                }
            ]
        });
    }

    render() {
        let { leadCreate, leadCreaeStatus } = this.props;
        let regions = [];
        if (leadCreate.regions) {
            regions = leadCreate.regions.map((item, index) => {
                if (leadCreate.tipsters && leadCreate.tipsters.region_id == item.id) {
                    return (
                        <option value={item.id} key={index} selected="selected">{item.name}</option>
                    )
                }
                return (
                    <option value={item.id} key={index}>{item.name}</option>
                )
            });
        }
        let productOptions = [];
        if (leadCreate.products) {
            productOptions = leadCreate.products.map((item, index) => {
                return ({ value: item.id, label: item.name })
            });
        }
        let tipster = [];
        if (leadCreate.tipsters) {
            tipster = <option value={leadCreate.tipsters.id} selected> {leadCreate.tipsters.username} </option>
        }

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
        if(this.state.errors != ""){
            headerError = <div className="alert alert-danger clearfix">
                <p>{this.state.errors}</p>
            </div>;
            $(window).scrollTop(0);
        }
        if(leadCreaeStatus.status){
            if(leadCreaeStatus.status === "1"){
                headerError = <div className="alert alert-danger clearfix">
                                    <p>{leadCreaeStatus.message}</p>
                                </div>;
                $(window).scrollTop(0);
            }else{
                if(!this.state.isCreateContinue){
                    this._onClickComfirm();
                }
            }
        }
        return (
            <form onSubmit={this.onSubmit}>
                <div className="lead_new row">
                    <div className="col-md-12">
                        {/* create manager form */}
                        <div className="box box-success">
                            {/* box-header */}
                            <div className="box-header with-border">
                                <h3 className="box-title">{i18n.t(transKey.LEAD_TITLE)}</h3>
                                <Link to="/leads" className="btn btn-xs btn-default pull-right">
                                    <i className="fa fa-angle-left"></i> {i18n.t(transKey.COMMON_BACK)}
                                </Link>
                            </div>

                            {/* box-body */}
                            <div className="box-body">
                                {/* show header error */}
                                {headerError}
                                <div className="row">
                                    <div className="col-xs-12 col-sm-6">
                                        {/* text input */}
                                        <div className="form-group">
                                            <label>{i18n.t(transKey.LEAD_FULL_NAME)}</label>
                                            <input name="fullname" value={this.state.fullname} type="text" className="form-control" placeholder="Enter ..." required
                                                onChange={this.handleChangeInput.bind(this)} ref="fullname"/>
                                        </div>
                                    </div>
                                </div>

                                <div className="row">
                                    <div className="col-xs-12 col-sm-6">
                                        <div className="form-group group__relationship">
                                            <label className="Relationship">{i18n.t(transKey.LEAD_RELATIONSHIP)}</label>
                                            <div className="radio-inline relationship_female">
                                                <label>
                                                    {/*<input type="radio" value="family" name="Relationship" checked onChange={this.handleChangeInput.bind(this)}/>*/}
                                                    {inputRelationshipFamily}
                                                    Family
                                                </label>
                                            </div>
                                            <div className="radio-inline relationship_female">
                                                <label>
                                                    {/*<input type="radio" value="acquaintance" name="Relationship" onChange={this.handleChangeInput.bind(this)}/>*/}
                                                    {inputRelationshipAcquaintance}
                                                    Acquaintance
                                                </label>
                                            </div>
                                            <div className="radio-inline relationship_female">
                                                <label>
                                                    {/*<input type="radio" value="stranger" name="Relationship" onChange={this.handleChangeInput.bind(this)}/>*/}
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
                                                    {/*<input type="radio" value="0" name="gender" checked onChange={this.handleChangeInput.bind(this)}/>*/}
                                                    {inputMale}
                                                    Male
                                                </label>
                                            </div>
                                            <div className="radio-inline gender_female">
                                                <label>
                                                    {/*<input type="radio" value="1" name="gender" onChange={this.handleChangeInput.bind(this)}/>*/}
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
                                            {/*<input name="phone" value={this.state.phone} type="text" className="form-control" placeholder="Enter ..."*/}
                                                {/*onChange={this.handleChangeInput.bind(this)}/>*/}
                                            <ReactPhoneInput defaultCountry={'vn'} onChange={this.handleOnChange} value={this.state.phone} inputClass="phone-number"/>
                                        </div>
                                    </div>
                                    <div className="col-xs-12 col-sm-6">
                                        <div className="form-group">
                                            <label>{i18n.t(transKey.LEAD_EMAIL)}</label>
                                            <input name="email" value={this.state.email} type="email" className="form-control" placeholder="Enter ..."
                                                onChange={this.handleChangeInput.bind(this)}/>
                                        </div>
                                    </div>
                                </div>

                                <div className="row">
                                    <div className="col-xs-12 col-sm-6">
                                        <div className="form-group">
                                            <label>{i18n.t(transKey.LEAD_REGION)}</label>
                                            <select name="regionId" className="form-control" required onChange={this.handleChangeInput.bind(this)}>
                                                <option value="" disabled selected>Please pick a region</option>
                                                {regions}
                                            </select>
                                        </div>
                                    </div>
                                    <div className="col-xs-12 col-sm-6">
                                        <div className="form-group">
                                            <label>{i18n.t(transKey.LEAD_PRODUCT)}</label>
                                            <Select
                                                value={this.state.selectedOption}
                                                onChange={this.handleChangeSelect}
                                                options={productOptions}
                                                isMulti={true}
                                                placeholder="Please pick a product"
                                                styles={customStylesSelect}
                                            />
                                        </div>
                                    </div>
                                    <div className="col-xs-12">
                                        <div className="form-group">
                                            <label>{i18n.t(transKey.LEAD_NOTES)}</label>
                                            <textarea name="notes" className="form-control" placeholder="URGENT - PLEASE CONTACT ASAP" rows="5"
                                                onChange={this.handleChangeInput.bind(this)} value={this.state.notes}></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div className="box-footer">
                                <Link to="/leads" className="btn btn-default">
                                    {i18n.t(transKey.COMMON_CANCEL)}
                                </Link>
                                <button type="submit" className="btn btn-primary pull-right">{i18n.t(transKey.COMMON_CREATE)}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        );
    }
}