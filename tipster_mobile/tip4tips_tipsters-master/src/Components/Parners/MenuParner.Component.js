import React, { Component } from 'react';
import { Link, Redirect } from 'react-router-dom';
import * as Utils from '../../Commons/Utils';
import './MenuParner.css';
import i18n from "../../I18n";
import * as transKey from "../../I18n/TransKey";

const menuPartner = [
    {
        image: './images/menu-partner/01.png',
        text: 'MEDICAL'
    },
    {
        image: './images/menu-partner/02.png',
        text: 'AUTO/MOTO'
    },
    {
        image: './images/menu-partner/03.png',
        text: 'SHOPS'
    },
    {
        image: './images/menu-partner/04.png',
        text: 'FACTORY'
    },
    {
        image: './images/menu-partner/05.png',
        text: 'OFFICE'
    },
    {
        image: './images/menu-partner/06.png',
        text: 'HOME'
    },
    {
        image: './images/menu-partner/07.png',
        text: 'TRAVEL'
    },
    {
        image: './images/menu-partner/08.png',
        text: 'STUDENT'
    },
    {
        image: './images/menu-partner/08.png',
        text: 'OTHER'
    }
];

export default class MenuParnerComponent extends Component {
    constructor(props) {
        super(props);
        this.state = {
            selectedProduct : []
        }
    }

    componentDidMount() {
        this.props.productFetch();
        this.props.onLoginSuccess(Utils.getLogin());
    }

    _onClickInsuranceType = (productId, productName) => {
        if(this.handleCheckProduct(productId)){
            this.state.selectedProduct = this.state.selectedProduct.filter(item => item.value != productId);
        }else{
            this.state.selectedProduct = [...this.state.selectedProduct,{value: productId, label: productName}];
        }
        this.setState(this.state);
    }

    _onDoubleClickInsuranceType = (productId, productName) =>{
        this.props.history.push({pathname : '/leads-add', state : {productId: [{value:productId, label: productName}]}});
    }

    handleCheckProduct(val) {
        return this.state.selectedProduct.some(item => val === item.value);
    }

    _onClickNewLead = () =>{
        if(this.state.selectedProduct.length > 0){
            this.props.history.push({pathname : '/leads-add', state : {productId: this.state.selectedProduct}});
        }
    }

    render() {
        let { products } = this.props;
        let buttonNewLead = "";
        if(this.state.selectedProduct.length > 0){
            buttonNewLead = <button className="btn btn-primary pull-right" onClick={this._onClickNewLead.bind(this)}>{i18n.t(transKey.MENU_PARTNER_LEAD_CREATE)}</button>;
        }
        return (
            <div className="row">
                <div>
                    {/* create manager form */}
                    <div className="box box-success">
                        {/* box-header */}
                        <div className="box-header with-border">
                            <h3 className="box-title">
                                {/* <img src="./images/image1-orange.png" width="46" height="46" alt="" /> */}
                                <span className="text">{i18n.t(transKey.MENU_PARTNER_TITLE)}</span>
                            </h3>
                            {buttonNewLead}
                        </div>
                        <div className="row">
                            <div className="list-type">
                                <ul>
                                    {
                                        products.map((item, index) => {
                                            let imageCheck = "";
                                            if(this.handleCheckProduct(item.id)){
                                                imageCheck = <span className="menu-partner-tick">
                                                                <img src="./images/red-tick.png" width="20" />
                                                            </span>
                                            }
                                            return (
                                                <li key={index} onClick={this._onClickInsuranceType.bind(this,item.id, item.name)}
                                                    onDoubleClick={this._onDoubleClickInsuranceType.bind(this,item.id, item.name)}>
                                                    <span>
                                                        <img src={item.path_image + '/' + item.thumbnail} alt={item.name} title={item.name} />
                                                        {imageCheck}
                                                    </span>
                                                    <br />
                                                    <div className="partner_text">{item.name}</div>
                                                </li>
                                            );
                                        })
                                    }

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}