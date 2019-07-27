import React, { Component } from 'react';
import { connect } from 'react-redux';

import { reduxForm, Field } from 'redux-form';
import { required, email, minValue } from '../validation';

const renderInput = ({ input, meta, label, ...other }) =>
  <div className="form-group">
    <label>{label}</label>
    <input {...input} {...other} />
    {meta.error &&
      meta.touched &&
      <span className="error-message">
        {meta.error}
      </span>
    }
  </div>

class Login extends Component {
  render() {
    const { handleSubmit } = this.props;
    return (
      <div className="container">
        <div className="row justify-content-center mt-2">
          <div className="col-lg-10">
            <div className="card">
              <div className="card-header d-flex justify-content-center">
                Login Page
              </div>
              <div className="card-body">
                <form onSubmit={handleSubmit}>
                  <Field
                    name="email"
                    label="Email"
                    type="email"
                    component={renderInput}
                    className="form-control"
                    validate={[required, email]} />
                  <Field
                    name="password"
                    label="Password"
                    component={renderInput}
                    className="form-control"
                    type="password"
                    validate={[required, minValue(5)]} />
                  <div className="row bootom card-footer">
                    <button
                      type="submit"
                      disabled={this.props.invalid || this.props.submitting || this.props.pristine}
                      className="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

Login = reduxForm({
  form: 'loginForm',
  destroyOnUnmount: false,
})(Login);

export default
  connect(null)(Login);
