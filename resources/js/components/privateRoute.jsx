import React from 'react';
import { Redirect, Route } from 'react-router-dom';

const PrivateRoute = ({ component: Component, auth: Auth, ...rest }) => (
    <Route {...rest} render={(props) => (
        Auth === true
            ? <Component {...props} />
            : <Redirect to='/react/login' />
    )} />
)

export default PrivateRoute;