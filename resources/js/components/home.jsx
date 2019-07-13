import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';

import configureStore from '../store';
import Router from './router';

const store = configureStore();

export default class HomeComponent extends Component {
  render() {
    return (
      <Router />
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
