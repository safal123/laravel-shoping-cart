import axios from "axios";
import * as actionType from "../actions/actionType";

export const allProducts = page => async dispatch => {
    const productsApi = "http://localhost:8001/api/products";
    await axios
        .get(productsApi + `?page=${page}`)
        .then(response => {
            dispatch({
                type: actionType.ALL_PRODUCTS,
                payload: response.data
            });
        })
        .catch(error => {
            console.log(error.response);
        });
};
