import React, { Component } from 'react';
import { connect } from 'react-redux';
import axios from "axios";

import Loader from './loader';;
import { reset, reduxForm, Field } from 'redux-form';
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

  constructor(props) {
    super(props);
    this.state = {
      message: '',
      isLoading: false,
    }
  }


  componentDidMount() {
    const auth = window.localStorage.getItem('auth');
    if (auth) {
      this.props.history.push("/react");
    }
  }

  submitLoginForm(formValues, dispatch) {
    this.setState({ isLoading: true });
    const data = {
      email: formValues.email,
      password: formValues.password
    }
    axios.post("http://localhost:8000/api/login", data)
      .then(res => {
        dispatch(reset("loginForm"));
        const token = res.data.token
        window.localStorage.setItem("auth", token);
        this.setState({ isLoading: false });
        this.props.history.push("/react");
        console.log(res.data);
      }).
      catch((error) => {
        this.setState({
          message: error.response.data.error
        });
        dispatch(reset("loginForm"));
        this.setState({ isLoading: false });
        this.props.history.push("/react/login");
        console.log(error.response.data.error);
      });
  }
  render() {
    const { handleSubmit } = this.props;
    if (this.state.isLoading) {
      return <Loader />
    } else {
      return (
        <div className="container">
          <div className="row justify-content-center mt-2">
            <div className="col-lg-10">
              {this.state.message ?
                <div
                  className="alert alert-danger"
                  role="alert">
                  {this.state.message}
                </div>
                : ''}
              <div className="card">
                <div className="card-header d-flex justify-content-center bg-info">
                  Login Page
                </div>
                
                <div className="card-body">
                  <form onSubmit={handleSubmit(this.submitLoginForm.bind(this))}>
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
                    <div className="row bootom card-footer bg-info">
                      <button
                        type="submit"
                        disabled={this.props.invalid || this.props.submitting || this.props.pristine}
                        className="btn btn-success text-white form-con">
                        {this.props.submitting ?
                          <i className="fa fa-spinner fa-spin"></i>
                        : ''}
                        
                        Submit
                      </button>
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
}

Login = reduxForm({
  form: 'loginForm',
  destroyOnUnmount: false,
})(Login);

export default
  connect(null)(Login);
