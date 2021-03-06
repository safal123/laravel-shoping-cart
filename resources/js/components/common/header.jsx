import React, { Component } from "react";
import { Link } from "react-router-dom";
import { connect } from "react-redux";
import axios from "axios";
import { headers } from "../../axios/headers";

import {
    Collapse,
    Navbar,
    NavbarToggler,
    Nav,
    NavItem,
    NavLink,
} from "reactstrap";
import { logoutUser } from "../../actions/authAction";

class Header extends Component {
    constructor(props) {
        super(props);
        this.toggle = this.toggle.bind(this);
        this.state = {
            isOpen: false,
            isLogged: false,
        };
    }

    toggle() {
        this.setState({
            isOpen: !this.state.isOpen,
        });
    }

    logout() {
        if (localStorage.auth) {
            // const headers = {
            //     Accept: "application/json",
            //     Authorization: `Bearer ${localStorage.auth}`,
            // };
            axios
                .post(
                    "http://localhost:8000/api/logout",
                    {},
                    { headers: { ...headers } }
                )
                .then((response) => {
                    this.props.logoutUser();
                    localStorage.removeItem("auth");
                    this.props.history.push("/react/login");
                })
                .catch((err) => {
                    localStorage.removeItem("auth");
                    // if (err.response.status == 401) {
                    //     this.logoutAction();
                    // }
                    console.log(err.response)
                });
        } else {
            this.props.logoutUser();
            localStorage.removeItem("auth");
        }
    }

    logoutAction() {
        this.props.logoutUser();
        localStorage.removeItem("auth");
    }

    render() {
        const cartTotalItems = this.props.totalItems;
        return (
            <div>
                <Navbar className="" color="dark" dark expand="md">
                    <div className="container">
                        <NavbarToggler onClick={this.toggle} />
                        <Collapse isOpen={this.state.isOpen} navbar>
                            <Nav className="" navbar>
                                <NavItem>
                                    <Link
                                        to="/react/allProducts"
                                        className="nav-link"
                                    >
                                        All Products
                                    </Link>
                                </NavItem>
                                <NavItem>
                                    <NavLink href="/" className="nav-link disabled" disabled={true}>
                                        <i className="fa fa-react"></i>Laravel
                                    </NavLink>
                                </NavItem>
                            </Nav>
                            <Nav className="ml-auto" navbar>
                                <NavItem>
                                    <Link to="/react/cart" className="nav-link">
                                        <i className="fa fa-shopping-cart"></i>
                                        Cart
                                        <span
                                            className="text-light"
                                            style={{
                                                verticalAlign: "super",
                                                fontSize: "smaller",
                                            }}
                                        >
                                            ({cartTotalItems})
                                        </span>
                                    </Link>
                                </NavItem>
                                {this.props.auth ? (
                                    <React.Fragment>
                                        <NavItem>
                                            <div
                                                className="nav-link"
                                                onClick={() => this.logout()}
                                                style={{ cursor: "pointer" }}
                                            >
                                                <i className="fa fa-user"></i>
                                                &nbsp;Logout
                                            </div>
                                        </NavItem>
                                        <NavItem>
                                            <Link
                                                to="/react/account"
                                                className="nav-link"
                                            >
                                                <i className="fa fa-book"></i>{" "}
                                                Account
                                            </Link>
                                        </NavItem>
                                    </React.Fragment>
                                ) : (
                                    <React.Fragment>
                                        <NavItem>
                                            <Link
                                                to="/react/login"
                                                className="nav-link"
                                            >
                                                <i className="fa fa-user"></i>{" "}
                                                Login
                                            </Link>
                                        </NavItem>
                                        <NavItem>
                                            <Link
                                                to="/react/register"
                                                className="nav-link"
                                            >
                                                <i className="fa fa-share"></i>{" "}
                                                Register
                                            </Link>
                                        </NavItem>
                                    </React.Fragment>
                                )}
                            </Nav>
                        </Collapse>
                    </div>
                </Navbar>
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    totalItems: state.cart.totalItems,
    auth: state.auth.isAuthenticated,
    user: state.auth.authUser,
});

const mapDispatchToProps = (dispatch) => {
    return {
        logoutUser: () => {
            dispatch(logoutUser());
        },
    };
};

export default connect(mapStateToProps, mapDispatchToProps)(Header);
