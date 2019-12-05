import * as actionType from "./actionType";

export const loginUser = user => ({
    type: actionType.LOGIN,
    payload: user
});

export const logoutUser = () => ({
    type: actionType.LOGOUT,
    payload: null
});
