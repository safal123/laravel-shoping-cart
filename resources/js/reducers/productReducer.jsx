import * as actionType from '../actions/actionType';

// initial state
const initialState = {
  products: [],
}

// get all products
const productReducer = (state = initialState, action) => {
  switch (action.type) {
    case actionType.ALL_PRODUCTS:
      const item = action.payload
      return {
        ...state,
        products: action.payload
      }
    default:
      return state;
  }
}

export default productReducer;