import React, { Component, Fragment } from 'react';

export default class FormErrors extends Component {
    render() {
        var { formErrors } = this.props;
        var isError = false;
        Object.keys(formErrors).map((fieldName, i) => {
            if (formErrors[fieldName].length > 0) {
                isError = true;
            }
        })

        if(!isError){
            return(<div></div>);
        }
        return (
            <div className="alert alert-danger">
                <div className='formErrors'>
                    {Object.keys(formErrors).map((fieldName, i) => {
                        if (formErrors[fieldName].length > 0) {
                            return (
                                <p key={i}>{fieldName} {formErrors[fieldName]}</p>
                            )
                        } else {
                            return '';
                        }
                    })}
                </div>
            </div>
        );
    }
}
