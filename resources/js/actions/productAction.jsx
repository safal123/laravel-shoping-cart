import axios from 'axios';
import * as actionType from '../actions/actionType';


export const allProducts = () => async dispatch => {
  const response = await axios.get("http://localhost:8000/products");
  //console.log(response.data);
  dispatch({
    type: actionType.ALL_PRODUCTS,
    payload: response.data
  });
};
