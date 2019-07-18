import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { connect } from 'react-redux';

import {
  Collapse,
  Navbar,
  NavbarToggler,
  NavbarBrand,
  Nav,
  NavItem,
  NavLink,
} from 'reactstrap';

class Header extends Component {

  constructor(props) {
    super(props);

    this.toggle = this.toggle.bind(this);
    this.state = {
      isOpen: false
    };
  }
  toggle() {
    this.setState({
      isOpen: !this.state.isOpen
    });
  }

  render() {
    const cartTotalItems = this.props.totalItems;
    return (
      <div>
        <Navbar className="" color="dark" dark expand="md">
          <div className="container">
            <Link to="/react" className="navbar-brand">
              <i className="fa fa-home"></i> Shop
            </Link>
            <NavbarToggler onClick={this.toggle} />
            <Collapse isOpen={this.state.isOpen} navbar>
              <Nav className="" navbar>
                <NavItem>
                  <Link to="/react/allProducts" className="nav-link">All Products</Link>
                </NavItem>
                <NavItem>
                  <NavLink href="/">
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
                <NavItem>
                  <NavLink href="#">
                    <i className="fa fa-user"></i> Login
                  </NavLink>
                </NavItem>
                <NavItem>
                  <NavLink href="#">
                    <i className="fa fa-share"></i> Register
                  </NavLink>
                </NavItem>
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
});


export default connect(mapStateToProps)(Header);