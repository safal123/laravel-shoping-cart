import * as actionType from '../actions/actionType';

const initialState = {
  items: [],
  totalItems: 0,
  totalPrice: 0,
}

const cartReducer = (state = initialState, action) => {
  switch (action.type) {
    case actionType.ADD_TO_CART:
      // count the item on cart
      const itemCount = state.totalItems + 1;
      // add the total price
      const priceSum = state.totalPrice + action.payload.price;
      // find the item added on the cart
      let addedItem = state.items.find(item => item.id === action.payload.id);
      if (addedItem) {
        addedItem.quantity +=1;
        return {
          ...state,
          items: state.items,
          totalItems: itemCount,
          totalPrice: priceSum,
        }
      }
      else {
        action.payload.quantity = 0;
        action.payload.quantity += 1;
        const items = [...state.items, action.payload];
        const distItems = [...new Set(items)];
        return {
          ...state,
          items: distItems,
          totalItems: itemCount,
          totalPrice: priceSum,
        }
      }

    default:
      return state;
  }
}

export default cartReducer;