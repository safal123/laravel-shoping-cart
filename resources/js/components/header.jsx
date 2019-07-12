import React, { Component } from 'react';
import { Link } from 'react-router-dom';

import {
  Collapse,
  Navbar,
  NavbarToggler,
  NavbarBrand,
  Nav,
  NavItem,
  NavLink,
  // UncontrolledDropdown,
  // DropdownToggle,
  // DropdownMenu,
  // DropdownItem
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
    return (
      <div>
        <Navbar className="" color="dark" dark expand="md">
          <div className="container">
            <Link to="/react" className="navbar-brand">
              <i className="fa fa-home"></i> Shop
            </Link>
            {/* <NavbarBrand href="/react">Shop</NavbarBrand> */}
            <NavbarToggler onClick={this.toggle} />
            <Collapse isOpen={this.state.isOpen} navbar>
              <Nav className="" navbar>
                <NavItem>
                  <Link to="/react/allProducts" className="nav-link">All Products</Link>
                  {/* <NavLink href="#">All Products</NavLink> */}
                </NavItem>
                <NavItem>
                  <NavLink href="/">
                    <i className="fa fa-react"></i>Laravel
                  </NavLink>
                </NavItem>
                {/* <UncontrolledDropdown nav inNavbar>
                <DropdownToggle nav caret>
                  Options
                </DropdownToggle>
                <DropdownMenu right>
                  <DropdownItem>
                    Option 1
                  </DropdownItem>
                  <DropdownItem>
                    Option 2
                  </DropdownItem>
                  <DropdownItem divider />
                  <DropdownItem>
                    Reset
                  </DropdownItem>
                </DropdownMenu>
              </UncontrolledDropdown> */}
              </Nav>
              <Nav className="ml-auto" navbar>
                <NavItem>
                  <NavLink href="#">
                    <i className="fa fa-shopping-cart"></i> Cart
                  </NavLink>
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

export default Header;