import React, { Component } from 'react';
import { Doughnut } from 'react-chartjs-2';
import {Link} from 'react-router-dom';
import * as Utils from "../../Commons/Utils";
import i18n from "../../I18n";
import * as transKey from "../../I18n/TransKey";

export default class LeadStatus extends Component {

    _onChangeProduct = (e) =>{
        let {fetchRecentStatus} = this.props;
        let userInfo = Utils.getLogin();
        if (userInfo) {
            fetchRecentStatus(userInfo.userId, e.target.value);
        }
    }

    __formatNumber = (value) =>{
        return Math.round(value) + '%';
    }

    render() {
        let {statusLead, products} = this.props;
        let dataView = [0, 0, 0];
        let backgroundColor = [ '#FF6384','#36A2EB','#FFCE56'];
        if(statusLead){
            dataView = [statusLead.new, statusLead.call, statusLead.quote, statusLead.win, statusLead.lost];
            backgroundColor = [statusLead.colorNew, statusLead.colorCall, statusLead.colorQuote, statusLead.colorWin, statusLead.colorLost];
        }
        let labelsTitle = [ "New", "Call", "Quote", "Win", "Lost"];
        if(statusLead){
            labelsTitle = [statusLead.newPersen + "% New",statusLead.callPersen + "% Call",statusLead.quotePersen + "% Quote", statusLead.winPersen + "% Win",
                statusLead.lostPersen + "% Lost"];
            // labelsTitle = [ "New : " + this.__formatNumber(100*statusLead.new/sumData), "Call : " + this.__formatNumber(100*statusLead.call/sumData),
            //     "Quote : " + this.__formatNumber(100*statusLead.quote/sumData), "Win : " + this.__formatNumber(100*statusLead.win/sumData) ,
            //     "Lost : " + this.__formatNumber(100*statusLead.lost/sumData)];
        }
        let data = {
            labels: labelsTitle,
            datasets: [{
                data: dataView,
                backgroundColor: backgroundColor,
                hoverBackgroundColor: backgroundColor
            }]
        };
        let fillterProduct = "";
        if(this.props.isConnection){
            fillterProduct = <div className="form-group pull-right product">
                                <select name="productId" className="form-control" onChange={this._onChangeProduct}>
                                    <option value="" disabled="">All Product</option>
                                    {
                                        products.map((item, index) => {
                                            return (
                                                <option value={item.id} key={index}>{item.name}</option>
                                            )
                                        })
                                    }
                                </select>
                            </div>
        }
        return (
            <div className="box box-default lead-status-header">
                {/* box-header */}
                <div className="box-header with-border">
                    <h3 className="box-title">{i18n.t(transKey.HOME_LATEST_STATUS)}</h3>
                    {fillterProduct}
                </div>

                {/* box-body */}
                <div className="box-body">
                    <div className="row">
                        <div className="col-xs-12">
                            <div className="chart-responsive">
                                <Doughnut data={data}
                                    height={317}
                                    options={{
                                        maintainAspectRatio: false,
                                        tooltips:{
                                            enabled : true
                                        }
                                    }} />
                            </div>
                        </div>
                        <div className="col-xs-12">
                            <div id="pieChart-legend-con"></div>
                        </div>
                    </div>
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