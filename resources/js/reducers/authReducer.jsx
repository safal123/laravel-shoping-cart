import * as actionType from '../actions/actionType';

const initialState = {
  isAuthenticated: false,
  authUser: []
};

const authReducer = (state = initialState, action) => {
  switch (action.type) {
    case actionType.LOGIN:
      return {
        ...state,
        authUser: action.payload,
        isAuthenticated: true
      }
    
    case actionType.LOGOUT:
      window.localStorage.removeItem('auth');
      return {
        ...initialState
      }
    
    default:
      return state;
  }
}

export default authReducer;