import React, { Component } from "react";
import { Redirect } from "react-router-dom";

import { connect } from "react-redux";
import axios from "axios";

import { required, email, minValue } from "../../validation";
import { loginUser } from "../../actions/authAction";

class Login extends Component {
    constructor(props) {
        super(props);

        this.state = {
            message: "",
            email: "",
            password: "",
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleChange(e) {
        this.setState({ [e.target.id]: e.target.value });
    }

    handleSubmit(event) {
        event.preventDefault();
        const data = {
            email: this.state.email,
            password: this.state.password,
        };

        axios
            .post("http://localhost:8000/api/login", data)
            .then((res) => {
                this.setState({
                    password: "",
                    email: "",
                });
                const token = res.data.token;
                window.localStorage.setItem("auth", token);
                this.props.loginUser(res.data.user);
                console.log(res.data);
            })
            .catch((error) => {
                this.setState({
                    message: error.response.data.error,
                });
                this.setState({
                    password: "",
                    email: "",
                });
            });
    }

    render() {
        const { isAuthenticated } = this.props;
        if (isAuthenticated) {
            return <Redirect to="/react" />;
        }
        return (
            <div className="card mt-2">
                <div className="card-header d-flex justify-content-center bg-info">
                    Login
                </div>
                <div className="card-body">
                    {this.state.message ? (
                        <div className="alert alert-danger" role="alert">
                            {this.state.message}
                        </div>
                    ) : (
                        ""
                    )}
                    <form onSubmit={this.handleSubmit}>
                        <div className="form-group">
                            <label htmlFor="email">Email</label>
                            <input
                                type="email"
                                className="form-control"
                                name="email"
                                id="email"
                                value={this.state.email}
                                onChange={this.handleChange}
                                aria-describedby="emailHelpId"
                                placeholder="Email address"
                            />
                        </div>
                        <div className="form-group">
                            <label htmlFor="password">Password</label>
                            <input
                                type="password"
                                className="form-control"
                                name="password"
                                id="password"
                                value={this.state.password}
                                onChange={this.handleChange}
                                placeholder="Password"
                            />
                        </div>
                        <button type="submit" className="btn btn-primary">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    isAuthenticated: state.auth.isAuthenticated,
});

export default connect(mapStateToProps, { loginUser })(Login);
