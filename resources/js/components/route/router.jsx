import React, { Component, Fragment, Suspense } from "react";
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";
import { connect } from "react-redux";

import Header from "../common/header";
import Landing from "../common/landing";
//import Products from "../products/products";
import Cart from "../cart/cart";
import ProductDetail from "../products/productDetail";
import Login from "../user/Login";
import Register from "../user/register";
import Account from "../user/Account";
import NotFound from "./NotFound";
import PrivateRoute from "./PrivateRoute";
import Checkout from "../cart/checkOut";
import Loader from "../loader/loader";

const Products = React.lazy(() => import("../products/products")); // Lazy-loaded

class RouterPage extends Component {
    constructor(props) {
        super(props);
    }
    render() {
        const authState = this.props.auth;
        return (
            <Router>
                <Fragment>
                    <Header />
                    <div className="container">
                        <Switch>
                            <Suspense fallback={<Loader />}>
                                <Route
                                    path="/react"
                                    exact={true}
                                    component={Landing}
                                />
                                <Route
                                    path="/react/allProducts"
                                    exact={true}
                                    component={Products}
                                />
                                <Route
                                    path="/react/cart"
                                    exact={true}
                                    component={Cart}
                                />
                                {/* // \d+ is the regex for only integer params, //
                                // \w+ is for the string routes // [a-z]+ for
                                the // string can also be used for safe */}
                                <Route
                                    path="/react/allProducts/:id(\d+)"
                                    exact={true}
                                    component={ProductDetail}
                                />
                                <Route
                                    path="/react/login"
                                    exact={true}
                                    component={Login}
                                />
                                <Route
                                    path="/react/register"
                                    exact={true}
                                    component={Register}
                                />
                                <PrivateRoute
                                    path="/react/check-out"
                                    exact={true}
                                    component={Checkout}
                                    auth={authState}
                                />
                                <PrivateRoute
                                    path="/react/account"
                                    exact={true}
                                    component={Account}
                                    auth={authState}
                                />
                            </Suspense>
                            <Route path="" component={NotFound} />
                        </Switch>
                    </div>
                </Fragment>
            </Router>
        );
    }
}

const mapStateToProps = state => ({
    auth: state.auth.isAuthenticated
});

export default connect(mapStateToProps)(RouterPage);
