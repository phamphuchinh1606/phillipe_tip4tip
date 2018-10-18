import React, { Component } from 'react';
import { Switch, Route, Redirect,Link } from 'react-router-dom';
import routers from '../routers_messages';

export default class MessagesLayout extends Component {
    showContentRoute = (routes) => {
        var result = null;
        if (routes.length > 0) {
            result = routes.map((route, index) => {
                return (
                    <Route
                        key={index}
                        path={route.path}
                        exact={route.exact}
                        component={route.main}
                    />
                );
            });
        }
        return result;
    }

    render() {
        return (
            <div className="messages_list row">
                <div className="col-md-3">
                    <div className="box box-solid">
                        <div className="box-header with-border">
                            <h3 className="box-title">Folders</h3>
                            <div className="box-tools">
                                <button type="button" className="btn btn-box-tool" data-widget="collapse">
                                    <i className="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div className="box-body no-padding">
                            <ul className="nav nav-pills nav-stacked">
                                <li className="active">
                                    <a href="http://localhost:8000/admin/messages">
                                        <i className="fa fa-inbox"></i> Inbox
                                        <span className="label label-primary pull-right">3</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://localhost:8000/admin/messages/sent">
                                        <i className="fa fa-envelope-o"></i> Sent
                                        <span className="label label-default pull-right">0</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://localhost:8000/admin/messages/trash">
                                        <i className="fa fa-trash-o"></i> Trash
                                        <span className="label label-danger pull-right">0</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div className="col-md-9">
                    <Switch>
                        {this.showContentRoute(routers)}
                    </Switch>
                </div>
            </div>
        );
    }
}