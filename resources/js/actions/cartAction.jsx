import * as actionType from '../actions/actionType';

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

export const cleartCart = () => {
  return {
    type: actionType.CLEAR_CART
  }
}