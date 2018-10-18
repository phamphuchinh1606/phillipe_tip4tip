import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import * as Utils from '../../Commons/Utils';
import i18n from "../../I18n";
import * as transKey from "../../I18n/TransKey";

const mails = [
    {
        id: '1',
        name: 'admin',
        subject: 'tieu de subject',
        date: 'Today 18:11'
    },
    {
        id: '2',
        name: 'admin',
        subject: 'tieu de subject',
        date: 'Today 18:11'
    }
];

export default class MessagesComponent extends Component {
    componentDidMount(){
        let { onMessageAllFetch, onLoginSuccess } = this.props;
        let userInfo = Utils.getLogin();
        onLoginSuccess(Utils.getLogin());
        if (userInfo) {
            onMessageAllFetch(userInfo.userId);
        }
    }

    render() {
        let messages = this.props.messageAll;
        return (
            <div className="box box-primary">
                <div className="box-header with-border">
                    <h3 className="box-title">{i18n.t(transKey.MAIL_TITLE)}</h3>
                </div>
                <div className="mailbox-messages">
                    <table className="table table-hover table-striped messages__list_mobile">
                        <thead>
                            <tr>
                                <th>{i18n.t(transKey.MAIL_NO)}.</th>
                                <th>{i18n.t(transKey.MAIL_SENDER)}</th>
                                <th>{i18n.t(transKey.MAIL_SUBJECT)}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {
                                messages.map((item, index) => {
                                    return (
                                        <tr key={index}>
                                            <td className="message__no" align="center">{index + 1}</td>
                                            <td className="message__sender">
                                                <div className="message__box">
                                                    <span className="message__sender">
                                                        {item.authorMess}
                                                    </span>
                                                    <span className="message__date">{item.dateSend}</span>
                                                </div>
                                            </td>
                                            <td className="message__title">
                                                <div className="message__box">
                                                    <span className="message__title">
                                                        {item.title}
                                                    </span>
                                                    <span className="message__content" dangerouslySetInnerHTML={ { __html: item.contentShow } } />
                                                </div>
                                            </td>
                                            <td className="message__actions actions text-center">
                                                <Link to={{ pathname: `/messages/show/${item.id}` }} className="btn btn-xs btn-success">
                                                    <i className="fa fa-eye"></i>
                                                </Link>
                                                {/* <Link to={{ pathname: `/leads/edit/${item.id}` }} className="btn btn-xs btn-info" title="Edit">
                                                        <i className="fa fa-pencil"></i>
                                                    </Link> */}
                                                {/* <a href="{{route('leads.edit', $lead->id)}}" className="btn btn-xs btn-info" title="Edit"><i className="fa fa-pencil"></i></a> */}
                                            </td>
                                        </tr>
                                    )
                                })
                            }
                        </tbody>
                    </table>
                </div>
            </div>
        );
    }
}