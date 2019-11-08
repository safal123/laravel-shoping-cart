import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { PersistGate } from 'redux-persist/integration/react'

import configureStore from '../store';
import RouterPage from './router';
import Footer from './footer';
import Loader from './loader';


const { store, persistor } = configureStore();

export default class HomeComponent extends Component {
    constructor(props) {
        super();
        this.state = {
            isLoggedIn: false,
            user: {}
        };
    }

    render() {
        return (
            <div>
                <div style={{ minHeight: "80vh" }}>
                    <RouterPage />
                </div>
                <Footer />
            </div>
        );
    }
}

if (document.getElementById('root')) {
    ReactDOM.render(
        <Provider store={store}>
            <PersistGate loading={<Loader />} persistor={persistor}>
                <HomeComponent />
            </PersistGate>
        </Provider >,
        document.getElementById('root')
    );
}
