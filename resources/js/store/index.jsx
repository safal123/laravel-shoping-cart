import { createStore, combineReducers, applyMiddleware } from 'redux';
import reduxThunk from 'redux-thunk';
import { composeWithDevTools } from 'redux-devtools-extension';
import { reducer as formReducer } from 'redux-form';

import productReducer from '../reducers/productReducer';
import cartReducer from '../reducers/cartReducer';

//combine reducers known as root reducers.
const rootReducer = combineReducers({
  products: productReducer,
  cart: cartReducer,
  form: formReducer
});

export default () => {
  const store = createStore(
    rootReducer,
    composeWithDevTools(
      applyMiddleware(reduxThunk)
    )
  );
  return store;
};