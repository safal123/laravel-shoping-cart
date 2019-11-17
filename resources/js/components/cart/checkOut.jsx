import React, { useState } from 'react'
import { connect } from 'react-redux';
import StripeCheckout from 'react-stripe-checkout';
import axios from 'axios';

import { logoutUser } from '../../actions/authAction';
import { clearCart } from '../../actions/cartAction';
import Loader from '../loader';

const iconContainer = {
    marginBottom: '20px',
    padding: '7px 0',
    fontSize: '24px'
};

const checkOut = (props) => {
    const [loading, setLoading] = useState('false');

    async function handleToken(token, addresses) {
        setLoading('true');
        const headers = {
            Accept: "application/json",
            Authorization: `Bearer ${localStorage.auth}`
        };
        await axios.post('http://localhost:8000/api/checkout', token,
            { headers: { ...headers } })
            .then(res => {
                props.clearCart();
                window.location = "/react/allProducts";
                setLoading('false');
            }).
            catch((error) => {
                const resStatus = error.response.status;
                if (resStatus === 401) {
                    props.logoutUser();
                    localStorage.removeItem('auth');
                    setLoading('false');
                    window.location = "/react/login";
                }
            });

    }

    function onSubmit(e) {
        e.preventDefault();
    }

    const cartItems = props.cartItems;

    if (loading === 'true') {

        return <Loader />

    } else {
        return (
            <div className="container mt-2">
                <div className="row">
                    <div className="col-12 col-md-12 col-lg-8">
                        <div className="card mb-2">
                            <div className="card-header">
                                Billing details
                            </div>
                            <div className="card-body">
                                <form onSubmit={onSubmit}>
                                    <label htmlFor="full-name">
                                        <i className="fa fa-user"></i> Full name
                                    </label>
                                    <div className="form-group">
                                        <input type="text"
                                            className="form-control"
                                            placeholder="Full name"
                                        />
                                    </div>
                                    <label htmlFor="email">
                                        <i className="fa fa-envelope"></i> Email Address
                                    </label>
                                    <div className="form-group">
                                        <input type="email"
                                            className="form-control"
                                            placeholder="Email Address"
                                        />
                                    </div>
                                    <label htmlFor="address">
                                        <i className="fa fa-institution"></i> Address
                                    </label>
                                    <div className="form-group">
                                        <input type="text"
                                            className="form-control"
                                            placeholder="Full Address"
                                        />
                                    </div>
                                    <hr />
                                    <h3>Payment</h3>
                                    <label name="fname">Accepted Cards</label>
                                    <div style={iconContainer}>
                                        <i className="fa fa-cc-visa" style={{ color: 'navy' }}></i> &nbsp;
                                        <i className="fa fa-cc-amex" style={{ color: 'blue' }}></i>&nbsp;
                                        <i className="fa fa-cc-mastercard" style={{ color: 'red' }}></i> &nbsp;
                                        <i className="fa fa-cc-discover" style={{ color: 'orange' }}></i> &nbsp;
                                    </div>

                                    {/* <input type="submit" value="Continue to checkout" className="btn btn-info"></input> */}
                                    <StripeCheckout
                                        token={handleToken}
                                        stripeKey="pk_test_JkAIcCpg8ZNjJjl23c6oNQna"
                                    // name="Three Comma Co."
                                    // description="Big Data Stuff"
                                    // shippingAddress
                                    // billingAddress
                                    // allowRememberMe={false}
                                    >
                                        <button className="btn btn-primary">
                                            Pay now
                                        </button>

                                    </StripeCheckout>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div className="col-12 col-md-12 col-lg-4">
                        <div className="card mb-2">
                            <div className="card-header">
                                <h4>Cart <span className="price"><i className="fa fa-shopping-cart"></i> <b>{cartItems.length}</b></span></h4>
                            </div>
                            <div className="card-body">

                                <table className="table table-hover">
                                    <tbody>
                                        {cartItems.map((item) =>
                                            <tr key={item.id}>
                                                <td>
                                                    <p>
                                                        <a href="#">{item.name}</a>

                                                    </p>
                                                </td>
                                                <td>
                                                    <span className="price">${item.price}</span>
                                                </td>

                                            </tr>
                                        )}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td><p>Total <span className="price"><b>${props.totalPrice}</b></span></p></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

const mapStateToProps = state => ({
    cartItems: state.cart.items,
    totalPrice: state.cart.totalPrice
});


export default connect(mapStateToProps, { logoutUser, clearCart })(checkOut);
