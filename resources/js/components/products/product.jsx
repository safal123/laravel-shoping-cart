import React, { Component } from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

import { addToCart, removeFromCart } from '../../actions/cartAction';

class Product extends Component {

    constructor(props) {
        super(props);
        this.handleClick = this.handleClick.bind(this);
        this.state = {
            inCart: false,
            cartId: [],
            products: this.props.cartItems
        }
    }

    componentDidMount() {
        // console.log(this.props.cartItems);
        // if (this.props.cartItems) {
        //     const cartProductItems = this.props.cartItems.map(function (item) {
        //         return item['id']
        //     });
        //     this.setState({
        //         cartId: cartProductItems
        //     })
        //     // cartProductItems.includes(product.id)
        // }

    }

    handleClick(product) {
        this.props.addToCart(product);
    }

    removeItemFromCart(product) {
        this.props.removeFromCart(product);
    }


    render() {
        const cartProductItems = this.props.cartItems.map(function (item) {
            return item['id']
        });
        console.log(cartProductItems);
        return (
            <div className="row" >
                {
                    this.props.products && this.props.products.map(product => (
                        <div className="col-md-4 mt-1" key={product.id}>
                            <div className="card">
                                <Link to={`/react/allProducts/${product.id}`}>
                                    <img
                                        className="card-img-top"
                                        src="https://review.chinabrands.com/chinabrands/seo/image/20180710/fqffqfqfq.png"
                                        alt="Card image cap" />
                                </Link>
                                <div className="card-body">
                                    <hr />
                                    <h5 className="card-title">{product.name}</h5>
                                    <div className="row flex">
                                        <div className="col-md-5">
                                            AUD {product.price.toFixed(2)}
                                        </div>
                                        <div className="col-md-7">
                                            {cartProductItems.includes(product.id) ?
                                                <div className="btn-group">
                                                    <Link to="/react/cart" className="btn btn-amber">
                                                        <i className="fa fa-check"></i>
                                                        view
                                                    </Link>
                                                    <div className="btn btn-amber"
                                                        onClick={
                                                            () => this.removeItemFromCart(product)
                                                        }
                                                    >
                                                        <i className="fa fa-remove"></i>
                                                    </div>
                                                </div> :
                                                <button className="btn btn-sm btn-success" onClick={() => { this.handleClick(product) }}>
                                                    <i className="fa fa-shopping-cart"></i> add to cart
                                                </button>

                                            }
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ))
                }
            </div>
        );
    }
}

const mapStateToProps = state => ({
    cartItems: state.cart.items
});

const mapDispatchToProps = (dispatch) => {
    return {
        addToCart: (product) => { dispatch(addToCart(product)) },
        removeFromCart: (product) => { dispatch(removeFromCart(product)) }
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Product);