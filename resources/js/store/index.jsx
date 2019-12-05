import { createStore, combineReducers, applyMiddleware } from "redux";
import reduxThunk from "redux-thunk";
import { composeWithDevTools } from "redux-devtools-extension";
import { reducer as formReducer } from "redux-form";
import { persistStore, persistReducer } from "redux-persist";
import storage from "redux-persist/lib/storage";

import productReducer from "../reducers/productReducer";
import cartReducer from "../reducers/cartReducer";
import authReducer from "../reducers/authReducer";

//combine reducers known as root reducers.
const rootReducer = combineReducers({
    products: productReducer,
    cart: cartReducer,
    form: formReducer,
    auth: authReducer
});

const persistConfig = {
    key: "root",
    storage,
    whitelist: ["auth", "cart"]
};

const persistedReducer = persistReducer(persistConfig, rootReducer);

export default () => {
    let store = createStore(
        persistedReducer,
        composeWithDevTools(applyMiddleware(reduxThunk))
    );
    let persistor = persistStore(store);
    return { store, persistor };
};
