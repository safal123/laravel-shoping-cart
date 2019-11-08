import axios from 'axios';
import * as actionType from '../actions/actionType';


export const allProducts = (page) => async dispatch => {
    const productsApi = 'http://localhost:8000/api/products';
    const response = await axios.get(productsApi + `?page=${page}`);
    dispatch({
        type: actionType.ALL_PRODUCTS,
        payload: response.data
    });
};
