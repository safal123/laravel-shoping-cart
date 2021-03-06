import React, { Component, Fragment } from "react";
import ReactDOM from "react-dom";
import { Provider } from "react-redux";
import { PersistGate } from "redux-persist/integration/react";

import configureStore from "../store";
import RouterPage from "./route/Router";
import Footer from "./common/Footer";
import Loader from "./loader/loader";

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
            <Fragment>
                <div style={{ minHeight: "80vh" }}>
                    <RouterPage />
                </div>
                <Footer />
            </Fragment>
        );
    }
}

if (document.getElementById("root")) {
    ReactDOM.render(
        <Provider store={store}>
            <PersistGate loading={<Loader />} persistor={persistor}>
                <HomeComponent />
            </PersistGate>
        </Provider>,
        document.getElementById("root")
    );
}
