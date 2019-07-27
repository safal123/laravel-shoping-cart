import React, { Component } from 'react';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';

import Header from './header';
import Landing from './landing';
import Products from './products/products';
import Cart from './cart/cart';
import ProductDetail from './products/productDetail';
import Login from './login';
import NotFound from './notFound';

class RouterPage extends Component {
  render() {
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
            <Route path="" component={NotFound} />
          </Switch>
        </div>
      </Router>
    );
  }
}

export default RouterPage;
