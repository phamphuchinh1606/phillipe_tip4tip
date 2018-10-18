import React, {Component} from 'react';

export default class Footer extends Component {
    render(){
        return(
            <footer className="main-footer">
                {/* To the right  */}
                <div className="pull-right hidden-xs">
                </div>
                {/* Default to the left */}
                <strong>Copyright © 2018 <a href="/">Tip4Tips</a>.</strong> All rights reserved.
            </footer>
        );
    }
}