import React, { Component } from 'react';
import { BrowserRouter, Switch, Route } from 'react-router-dom';

import Header from './header';
import Landing from './landing';
import Products from './products/products';
import Cart from './cart';

class Router extends Component {
  render() {
    return (
      <BrowserRouter>
        <Header />
        <Switch>
          <Route path="/react" exact={true} component={Landing} />
          <Route path="/react/allProducts" exact={true} component={Products} />
          <Route path="/react/cart" exact={true} component={Cart} />
        </Switch>
      </BrowserRouter>
    );
  }
}

export default Router;
