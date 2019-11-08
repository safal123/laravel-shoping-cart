import React, { Component } from 'react';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import { connect } from 'react-redux';

import Header from './header';
import Landing from './landing';
import Products from './products/products';
import Cart from './cart/cart';
import ProductDetail from './products/productDetail';
import Login from './login';
import Register from './register';
import Account from './account';
import NotFound from './notFound';
import PrivateRoute from './privateRoute';



class RouterPage extends Component {
    constructor(props) {
        super(props);
        this.state = {
            auth: false
        };
    }
    checkAuth() {
        const checkAuth = this.props.auth == true ? true : false;
        this.setState = {
            auth: checkAuth
        }
    }
    render() {
        const authState = this.props.auth;
        return (
            <Router >
                <div>
                    <Header />
                    <Switch >
                        <Route path="/react" exact={true} component={Landing} />
                        <Route path="/react/allProducts" exact={true} component={Products} />
                        <Route path="/react/cart" exact={true} component={Cart} />
                        // \d+ is the regex for only integer params,
                        // \w+ is for the string routes
                        // [a-z]+ for the string can also be used for safe
                        <Route path="/react/allProducts/:id(\d+)" exact={true} component={ProductDetail} />
                        <Route path="/react/login" exact={true} component={Login} />
                        <Route path="/react/register" exact={true} component={Register} />
                        <PrivateRoute
                            path="/react/account"
                            exact={true}
                            component={Account}
                            auth={authState}
                        />
                        <Route path="" component={NotFound} />
                    </Switch>
                </div>
            </Router>
        );
    }
}

const mapStateToProps = state => ({
    auth: state.auth.isAuthenticated,
});

export default connect(mapStateToProps)(RouterPage);
