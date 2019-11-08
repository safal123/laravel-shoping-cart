import React from 'react'
import { Link } from 'react-router-dom';
import { connect } from 'react-redux';

import {
    removeFromCart,
    clearCart,
    increaseItem,
    decreaseItem
} from '../../actions/cartAction';
import CartEmpty from './cartEmpty';

const cart = (props) => {

    // All products from the cart item
    const products = props.products;

    const removeItemFromCart = (product) => {
        props.removeFromCart(product);
    }

    const clearCartItems = () => {
        props.clearCart();
    }

    if (products.length > 0) {
        return (
            <div className="" style={{ padding: "20px" }}>
                <div className="d-flex flex-row  mt-2 justify-content-center">
                    <h1>Items on cart:{props.totalItems} items</h1>
                </div>
                <table id="cart" className="table table-hover table-condensed mt-2 table-responsive">
                    <thead className="">
                        <tr>
                            <th style={{ width: "50%" }}>Product</th>
                            <th style={{ width: "10%" }}>Price</th>
                            <th style={{ width: "13%" }}>Quantity</th>
                            <th style={{ width: "22%" }}>Subtotal</th>
                            <th style={{ width: "5%" }}></th>
                        </tr>
                    </thead>
                    <tbody>
                        {products.map(product => (
                            <tr key={product.id}>
                                <td>
                                    {product.name}
                                </td>
                                <td>
                                    ${product.price.toFixed(2)}
                                </td>
                                <td>
                                    <div className="btn-group">
                                        <div className="text-dark btn btn-sm btn-outline-light" onClick={() => props.decreaseItem(product)}>
                                            <i className="fa fa-minus" aria-hidden="true"></i>
                                        </div>
                                        <div className="text-dark btn btn-sm btn-outline-light" onClick={() => props.increaseItem(product)}>
                                            <i className="fa fa-plus" aria-hidden="true"></i>
                                        </div>
                                        <div className="text-dark btn btn-sm btn-outline-light">{product.quantity}</div>
                                    </div>
                                </td>
                                <td>
                                    ${((product.price.toFixed(2)) * product.quantity).toFixed(2)}
                                </td>
                                <td>
                                    <button className="btn btn-danger"
                                        onClick={() => removeItemFromCart(product)}>
                                        <i className="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        ))}
                        <tr className="">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td className="">
                                <h5>Total Price: ${props.totalPrice.toFixed(2)}</h5>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div className="btn-btn-group">
                    <Link to="/react/allProducts" className="btn btn-success">
                        <i className="fa fa-hand-o-left" aria-hidden="true"></i> &nbsp;
                        Continue shopping
                    </Link>
                    <div className="btn btn-danger"
                        onClick={() => clearCartItems()}>
                        <i className="fa fa-trash" aria-hidden="true"></i> Clear Cart
                    </div>
                    <div className="btn btn-info">
                        <i className="fa fa-shopping-bag" aria-hidden="true"></i> Check Out
                    </div>
                </div>
            </div>
        )
    }
    else {
        return (
            <CartEmpty />
        );
    }
}

const mapStateToProps = state => ({
    products: state.cart.items,
    totalPrice: state.cart.totalPrice,
    totalItems: state.cart.totalItems,
});

const mapDispatchToProps = (dispatch) => {
    return {
        removeFromCart: (product) => { dispatch(removeFromCart(product)) },
        clearCart: () => { dispatch(clearCart()) },
        increaseItem: (product) => { dispatch(increaseItem(product)) },
        decreaseItem: (product) => { dispatch(decreaseItem(product)) }
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(cart);


