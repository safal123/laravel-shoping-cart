import * as actionType from '../actions/actionType';

const initialState = {
  items: [],
  totalItems: 0,
  totalPrice: 0,
}

const cartReducer = (state = initialState, action) => {
  switch (action.type) {
    //add item to cart
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

    // clear item from cart
    case actionType.CLEAR_CART:
      return {
        ...initialState
      }
    
    // remove an item from cart
    case actionType.REMOVE_FROM_CART:
      let itemToRemove = state.items.find(item => item.id === action.payload.id);
      let new_items = state.items.filter(item => action.payload.id !== item.id);
      let newTotalPrice = state.totalPrice - (itemToRemove.price * itemToRemove.quantity);
      let newTotalItemCount = state.totalItems - itemToRemove.quantity;
      if (newTotalPrice < 0) {
        newTotalPrice = 0;
      }
      return {
        ...state,
        items: new_items,
        totalPrice: newTotalPrice,
        totalItems: newTotalItemCount
      }

    default:
      return state;
  }
}

export default cartReducer;