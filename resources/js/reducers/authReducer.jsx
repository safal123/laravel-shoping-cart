import * as actionType from "../actions/actionType";

const initialState = {
    isAuthenticated: false,
    authUser: []
};

const authReducer = (state = initialState, action) => {
    switch (action.type) {
        case actionType.LOGIN:
            const token = localStorage.getItem("auth");
            return {
                ...state,
                authUser: action.payload,
                isAuthenticated: token ? true : false
            };

        case actionType.LOGOUT:
            localStorage.removeItem("auth");
            return {
                ...initialState
            };
        default:
            return state;
    }
};

export default authReducer;
