import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { connect } from 'react-redux';
import axios from 'axios';

import {
  Collapse,
  Navbar,
  NavbarToggler,
  Nav,
  NavItem,
  NavLink,
} from 'reactstrap';
import { logoutUser } from '../actions/authAction';

class Header extends Component {

  constructor(props) {
    super(props);
    this.toggle = this.toggle.bind(this);
    this.state = {
      isOpen: false,
    };
  }

  componentDidMount() {
    if (!this.props.auth) {
      window.localStorage.removeItem('auth');
    }
  }

  toggle() {
    this.setState({
      isOpen: !this.state.isOpen
    });
  }

  logout() {
    const token = window.localStorage.getItem('auth');
    if (token) {
      const headers = {
        Accept: "application/json",
        Authorization: `Bearer ${token}`
      };
      axios.post("http://localhost:8000/api/logout", {},
        { headers: { ...headers } }).then(() => {
          this.props.logoutUser();
        })
    }
  }

  render() {
    const cartTotalItems = this.props.totalItems;
    return (
      <div>
        <Navbar className="" color="dark" dark expand="md">
          <div className="container">
            <Link to="/react" className="navbar-brand">
              <i className="fa fa-home"></i>Shop
            </Link>
            <NavbarToggler onClick={this.toggle} />
            <Collapse isOpen={this.state.isOpen} navbar>
              <Nav className="" navbar>
                <NavItem>
                  <Link to="/react/allProducts" className="nav-link">All Products</Link>
                </NavItem>
                <NavItem>
                  <NavLink href="/" className="nav-link">
                    <i className="fa fa-react"></i>Laravel
                  </NavLink>
                </NavItem>
              </Nav>
              <Nav className="ml-auto" navbar>
                <NavItem>
                  <Link to="/react/cart" className="nav-link">
                    <i className="fa fa-shopping-cart"></i>
                    Cart
                    <span className="text-light"
                      style={{
                        verticalAlign: "super",
                        fontSize: "smaller"
                      }}>
                      ({cartTotalItems})
                    </span>
                  </Link>
                </NavItem>
                {this.props.auth ?
                  <React.Fragment>
                    <NavItem>
                      <div
                        className="nav-link"
                        onClick={() => this.logout()}
                        style={{ cursor: "pointer" }}>
                        <i className="fa fa-user"></i>&nbsp;Logout
                      </div>
                    </NavItem>
                    <NavItem>
                      <Link to="/react/account" className="nav-link">
                        <i className="fa fa-book"></i> Account
                      </Link>
                    </NavItem>
                  </React.Fragment>
                  :
                  <React.Fragment>
                    <NavItem>
                      <Link to="/react/login" className="nav-link">
                        <i className="fa fa-user"></i> Login
                      </Link>
                    </NavItem>
                    <NavItem>
                      <NavLink href="#">
                        <i className="fa fa-share"></i> Register
                  </NavLink>
                    </NavItem>
                  </React.Fragment>
                }
              </Nav>
            </Collapse>
          </div>
        </Navbar>
      </div>
    )
  }
}

const mapStateToProps = state => ({
  totalItems: state.cart.totalItems,
  auth: state.auth.isAuthenticated,
  user: state.auth.authUser
});

const mapDispatchToProps = (dispatch) => {
  return {
    logoutUser: () => { dispatch(logoutUser()) }
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(Header);