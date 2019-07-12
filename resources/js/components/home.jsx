import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import Router from './router';
import { Button } from 'reactstrap'

export default class HomeComponent extends Component {
    render() {
        return (
          <Router />
        );
    }
}

if (document.getElementById('root')) {
  ReactDOM.render(<HomeComponent />, document.getElementById('root'));
}
