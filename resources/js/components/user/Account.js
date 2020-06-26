import React from "react";

import { connect } from "react-redux";
import { Redirect } from "react-router-dom";

const Account = props => {
    if (!props.isAuthenticated) {
        <Redirect to="/login" />;
    }
    return (
        <div className="" style={{ padding: "20px" }}>
            <div className="row mt-2">
                <div className="col-md-4">
                    <div className="bg-dark" id="sidebar-wrapper">
                        <div className="list-group">
                            <a
                                href="#"
                                className="list-group-item list-group-item-action bg-dark text-white"
                            >
                                Dashboard
                            </a>
                            <a
                                href="#"
                                className="list-group-item list-group-item-action bg-dark text-white"
                            >
                                Profile
                            </a>
                            <a
                                href="#"
                                className="list-group-item list-group-item-action bg-dark text-white"
                            >
                                Order
                            </a>
                            <a
                                href="#"
                                className="list-group-item list-group-item-action bg-dark text-white"
                            >
                                Change Password
                            </a>
                            <a
                                href="#"
                                className="list-group-item list-group-item-action bg-dark text-white"
                            >
                                Payment Method
                            </a>
                        </div>
                    </div>
                </div>
                <div className="col-md-8  border border-danger">
                    Name: {props.user.name}
                </div>
            </div>
        </div>
    );
};

const mapStateToProps = state => ({
    user: state.auth.authUser,
    isAuthenticated: state.auth.isAuthenticated
});

export default connect(mapStateToProps)(Account);
