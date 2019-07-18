import * as actionType from '../actions/actionType';

const initialState = {
  items: [],
  totalItems: 0,
  totalPrice: 0,
}

const cartReducer = (state = initialState, action) => {
  switch (action.type) {
    case actionType.ADD_TO_CART:
      const itemCount = state.totalItems + 1;
      const priceSum = state.totalPrice + action.payload.price
      return {
        ...state,
        items: [...state.items, action.payload],
        totalItems: itemCount,
        totalPrice: priceSum,
      }

    default:
      return state;
  }
}

export default cartReducer;