import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';

import configureStore from '../store';
import Router from './router';
import Footer from './footer';


const store = configureStore();

export default class HomeComponent extends Component {
  render() {
    return (
      <div>
        <div style={{ minHeight: "100vh" }}>
          <Router />
        </div>
        <Footer />
      </div>
    );
  }
}

if (document.getElementById('root')) {
  ReactDOM.render(
    <Provider store={store}>
      <HomeComponent />
    </Provider>,
    document.getElementById('root'));
}
