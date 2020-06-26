import React, { useState, useEffect, useRef } from "react";
import { connect } from "react-redux";
import StripeCheckout from "react-stripe-checkout";
import axios from "axios";

import { logoutUser } from "../../actions/authAction";
import { clearCart } from "../../actions/cartAction";
import Loader from "../loader/loader";

const iconContainer = {
    marginBottom: "20px",
    padding: "7px 0",
    fontSize: "24px"
};

const CheckOut = props => {
    const [loading, setLoading] = useState(false);
    const [name, setName] = useState("");
    const [email, setEmail] = useState("");
    const [address, setAddress] = useState("");

    const isMounted = useRef(null);

    useEffect(() => {
        isMounted.current = true;
        return () => {
            isMounted.current = false;
        };
    }, []);

    function handleToken(token) {
        setLoading(true);
        const headers = {
            Accept: "application/json",
            Authorization: `Bearer ${localStorage.auth}`
        };
        const data = {
            amount: props.totalPrice,
            name,
            email,
            address
        };
        axios
            .post(
                "http://localhost:8000/api/checkout",
                { token, data },
                {
                    headers: { ...headers }
                }
            )
            .then(res => {
                console.log(res.data);
                if (res.status == 200) {
                    setLoading("false");
                    props.clearCart();
                    props.history.push("/react/allProducts");
                }
            })
            .catch(error => {
                if (error && error.response.status === 401) {
                    setLoading(false);
                    props.logoutUser();
                    localStorage.removeItem("auth");
                    props.history.push("/react/login");
                }
            })
            .finally(() => {
                if (isMounted.current) {
                    setLoading(false);
                }
            });
    }

    function handleSubmit(e) {
        e.preventDefault();
        handleToken();
    }

    const { cartItems } = props;

    const totalAmountInCart = props.totalPrice;

    if (loading === "true") {
        return <Loader />;
    } else {
        return (
            <div className="container mt-2">
                <div className="row">
                    <div className="col-12 col-md-12 col-lg-8">
                        <div className="card mb-2">
                            <div className="card-header">Billing details</div>
                            <div className="card-body">
                                <form onSubmit={handleSubmit}>
                                    <label htmlFor="full-name">
                                        <i className="fa fa-user"></i> Full name
                                    </label>
                                    <div className="form-group">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Full name"
                                            onChange={e =>
                                                setName(e.target.value)
                                            }
                                        />
                                    </div>
                                    <label htmlFor="email">
                                        <i className="fa fa-envelope"></i> Email
                                        Address
                                    </label>
                                    <div className="form-group">
                                        <input
                                            type="email"
                                            className="form-control"
                                            placeholder="Email Address"
                                            onChange={e =>
                                                setEmail(e.target.value)
                                            }
                                        />
                                    </div>
                                    <label htmlFor="address">
                                        <i className="fa fa-institution"></i>{" "}
                                        Address
                                    </label>
                                    <div className="form-group">
                                        <input
                                            type="text"
                                            className="form-control"
                                            placeholder="Address"
                                            onChange={e =>
                                                setAddress(e.target.value)
                                            }
                                        />
                                    </div>
                                    <hr />
                                    <h3>Payment</h3>
                                    <label name="fname">Accepted Cards</label>
                                    <div style={iconContainer}>
                                        <i
                                            className="fa fa-cc-visa"
                                            style={{ color: "navy" }}
                                        ></i>{" "}
                                        &nbsp;
                                        <i
                                            className="fa fa-cc-amex"
                                            style={{ color: "blue" }}
                                        ></i>
                                        &nbsp;
                                        <i
                                            className="fa fa-cc-mastercard"
                                            style={{ color: "red" }}
                                        ></i>{" "}
                                        &nbsp;
                                        <i
                                            className="fa fa-cc-discover"
                                            style={{ color: "orange" }}
                                        ></i>{" "}
                                        &nbsp;
                                    </div>
                                    <StripeCheckout
                                        token={handleToken}
                                        stripeKey="pk_test_JkAIcCpg8ZNjJjl23c6oNQna"
                                        amount={totalAmountInCart * 100}
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
                                <h4>
                                    Cart{" "}
                                    <span className="price">
                                        <i className="fa fa-shopping-cart"></i>{" "}
                                        <b>{cartItems.length}</b>
                                    </span>
                                </h4>
                            </div>
                            <div className="card-body">
                                <table className="table table-hover">
                                    <tbody>
                                        {cartItems.map(item => (
                                            <tr key={item.id}>
                                                <td>
                                                    <p>
                                                        <a href="#">
                                                            {item.name}
                                                        </a>
                                                    </p>
                                                </td>
                                                <td>
                                                    <span className="price">
                                                        ${item.price}
                                                    </span>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <p>
                                                    Total{" "}
                                                    <span className="price">
                                                        <b>
                                                            ${props.totalPrice}
                                                        </b>
                                                    </span>
                                                </p>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
};

const mapStateToProps = state => ({
    cartItems: state.cart.items,
    totalPrice: state.cart.totalPrice,
    isAuthenticated: state.auth.isAuthenticated
});

export default connect(mapStateToProps, { logoutUser, clearCart })(CheckOut);
