import * as actionType from '../actions/actionType';
import * as stringType from '../strings';

export const addToCart = (product) => {
    return {
      type: actionType.ADD_TO_CART,
      payload: product
    }
}

export const removeFromCart = (product) => {
  return {
    type: actionType.REMOVE_FROM_CART,
    payload: product
  }
}

export const clearCart = () => {
  const message = stringType.YOUR_CART_IS_CLEARED;
  return  {
    type: actionType.CLEAR_CART,
    payload: message
  }
}

export const increaseItem = (product) => {
  return {
    type: actionType.INCREASE_ITEM,
    payload: product
  }
}

export const decreaseItem = (product) => {
  return {
    type: actionType.DECREASE_ITEM,
    payload: product
  }
}