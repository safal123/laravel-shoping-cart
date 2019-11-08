import React, { Component } from 'react';
import axios from 'axios';

class Register extends Component {

    constructor(props) {
        super(props);
        this.state = {
            name: "",
            email: '',
            password: '',
            rePassword: '',
            errors: '',
            message: '',
            isLogged: false
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    componentDidMount() {
        const auth = window.localStorage.getItem('auth');
        if (auth) {
            this.props.history.push("/react");
        }
    }

    handleChange(e) {
        this.setState({ [e.target.id]: e.target.value });
    }

    handleSubmit(event) {
        event.preventDefault();
        const data = {
            name: this.state.name,
            email: this.state.email,
            password: this.state.password
        };
        axios.post("http://localhost:8000/api/register", data).
            then(res => {
                this.setState({
                    name: '',
                    password: '',
                    email: '',
                    rePassword: ''
                })
                this.setState({
                    errors: ''
                });
                console.log(res.data);
            }).catch(error => {
                console.log(error.response.data.message);
                this.setState({
                    message: error.response.data.message
                });
                this.setState({
                    errors: error.response.data.errors
                });
                console.log(this.state.errors);
            })
    }

    render() {
        return (
            <div className="container">
                <div className="card">
                    <div className="card-header d-flex justify-content-center bg-info">
                        Register
                    </div>
                    {this.state.message ?
                        <div className="alert alert-danger m-2 p-4 " role="alert">
                            {this.state.message}
                        </div> : ''
                    }
                    <div className="card-body">
                        <form onSubmit={this.handleSubmit}>
                            <div className="form-group">
                                <label>Full Name</label>
                                <input
                                    type="text"
                                    id="name"
                                    value={this.state.name}
                                    onChange={this.handleChange}
                                    className="form-control"
                                    placeholder="Full name" />
                                {this.state.errors ?
                                    <span className="text-danger">
                                        {this.state.errors.name}
                                    </span> :
                                    ''}
                            </div>
                            <div className="form-group">
                                <label>Email</label>
                                <input
                                    id="email"
                                    value={this.state.email}
                                    onChange={this.handleChange}
                                    type="email"
                                    placeholder="Email address"
                                    className="form-control" />
                                {this.state.errors ?
                                    <span className="text-danger">
                                        {this.state.errors.email}
                                    </span> :
                                    ''}
                            </div>
                            <div className="form-group">
                                <label>Password</label>
                                <input
                                    value={this.state.password}
                                    onChange={this.handleChange}
                                    id="password"
                                    type="password"
                                    placeholder="Password"
                                    className="form-control" />
                                {this.state.errors ?
                                    <span className="text-danger">
                                        {this.state.errors.password}
                                    </span> :
                                    ''}
                            </div>
                            {/* <div className="form-group">
                                <label>Re-password</label>
                                <input
                                    id="rePassword"
                                    value={this.state.rePassword}
                                    onChange={this.handleChange}
                                    type="password"
                                    placeholder="Re Password"
                                    className="form-control" />
                            </div> */}
                            <input type="submit" className="btn btn-primary" value="Register" />
                        </form>
                    </div>
                </div>
            </div>
        );
    }
}

export default Register;