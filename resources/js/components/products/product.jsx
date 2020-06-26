import React, { Component } from "react";
import { connect } from "react-redux";
import { Link } from "react-router-dom";

import { addToCart, removeFromCart } from "../../actions/cartAction";

class Product extends Component {
    constructor(props) {
        super(props);
        this.handleClick = this.handleClick.bind(this);
    }

    handleClick(product) {
        this.props.addToCart(product);
    }

    removeItemFromCart(product) {
        this.props.removeFromCart(product);
    }

    render() {
        const cartProductItems = this.props.cartItems.map(function(item) {
            return item["id"];
        });
        return (
            <div className="row">
                {this.props.products &&
                    this.props.products.map(product => (
                        <div
                            className="col-sm-12 col-md-6 col-lg-4"
                            key={product.id}
                        >
                            <div className="card">
                                <Link to={`/react/allProducts/${product.id}`}>
                                    <img
                                        className="card-img-top img-responsive"
                                        src="https://review.chinabrands.com/chinabrands/seo/image/20180710/fqffqfqfq.png"
                                        alt="Card image cap"
                                    />
                                </Link>
                                <div className="card-body">
                                    <h4 className="card-title">
                                        {product.name}
                                    </h4>
                                    <div className="row">
                                        <div className="col">
                                            <p className="btn btn-sm btn-amber-outline btn-block">
                                                AUD${product.price}
                                            </p>
                                        </div>
                                        {cartProductItems.includes(
                                            product.id
                                        ) ? (
                                            <div className="col">
                                                <div
                                                    className="btn-group btn-block"
                                                    role="group"
                                                >
                                                    {/* <Link
                                                        to="/react/cart"
                                                        className="btn btn-sm btn-success"
                                                    >
                                                        In cart
                                                    </Link> */}
                                                    <div
                                                        className="btn btn-sm btn-danger"
                                                        onClick={() => {
                                                            this.removeItemFromCart(
                                                                product
                                                            );
                                                        }}
                                                    >
                                                        Remove
                                                    </div>
                                                </div>
                                            </div>
                                        ) : (
                                            <div className="col">
                                                <button
                                                    className="btn btn-sm btn-success btn-block"
                                                    onClick={() => {
                                                        this.handleClick(
                                                            product
                                                        );
                                                    }}
                                                >
                                                    <i className="fa fa-shopping-cart"></i>
                                                    Buy
                                                </button>
                                            </div>
                                        )}
                                    </div>
                                </div>
                            </div>
                        </div>
                    ))}
            </div>
        );
    }
}

const mapStateToProps = state => ({
    cartItems: state.cart.items
});

const mapDispatchToProps = dispatch => {
    return {
        addToCart: product => {
            dispatch(addToCart(product));
        },
        removeFromCart: product => {
            dispatch(removeFromCart(product));
        }
    };
};

export default connect(mapStateToProps, mapDispatchToProps)(Product);
