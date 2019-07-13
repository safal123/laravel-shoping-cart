import React, { Component } from 'react';
import { BrowserRouter, Switch, Route } from 'react-router-dom';

import Header from './header';
import Landing from './landing';
import Products from './products/products';

class Router extends Component {
  render() {
    return (
      <BrowserRouter>
        <Header />
        <Switch>
          <Route path="/react" exact={true} component={Landing} />
          <Route path="/react/allProducts" exact={true} component={Products} />
        </Switch>
      </BrowserRouter>
    );
  }
}

export default Router;
