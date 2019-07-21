import React from 'react'
import { Link } from 'react-router-dom';
import { connect } from 'react-redux';

import { cleartCart, removeFromCart } from '../actions/cartAction';

const cart = (props) => {

  // All products from the cart item
  const products = props.products;

  if (products.length > 0) {
    return (
      <div className="container">
        <div className="d-flex flex-row">
          <div className="p-2">
            <h1>Items on cart. Total Items : { props.totalItems }</h1>
          </div>
          <div className="p-2 justify-content-right">
            <button className="btn btn-danger ml-0" onClick={props.cleartCart}>
              Clear cart
            </button>
          </div>
        </div>
        
        <table id="cart" className="table table-hover table-condensed mt-2">
          <thead className="bg-info">
            <tr>
              <th style={{ width: "50%" }}>Product</th>
              <th style={{ width: "10%" }}>Price</th>
              <th style={{ width: "13%" }}>Quantity</th>
              <th style={{ width: "22%" }}>Subtotal</th>
              <th style={{ width: "5%" }}></th>
            </tr>
          </thead>
          <tbody>
            { products.map(product => (
              <tr key={product.id}>
                <td>
                  {product.name}
                </td>
                <td>
                  ${product.price.toFixed(2)}
                </td>
                <td>
                  <div className="row">
                    <i className="fa fa-minus btn btn-info" aria-hidden="true"></i>
                    <div className="mt-3">{product.quantity}</div>
                    <i className="fa fa-plus btn btn-info" aria-hidden="true"></i>
                  </div>
                  
                </td>
                <td>
                  ${(product.price.toFixed(2)) * product.quantity }
                </td>
                <td>
                  <button href="#" className="btn btn-danger" onClick={ () => props.removeFromCart(product) }>
                    <i className="fa fa-trash" aria-hidden="true"></i>
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
        <hr/>
        <div className="">
          <Link to="/react/allProducts" className="btn btn-success">
            <i className="fa fa-hand-o-left" aria-hidden="true"></i> &nbsp;
            Continue shopping
          </Link>
          Total Price: ${props.totalPrice.toFixed(2)}
        </div>
      </div>
    )
  }
  else {
    return (
      <div className="container mt-2">
        <div className="bg-danger">
          <h1>Your cart is empty.</h1>
        </div>
      </div>
    );
  }
}

const mapStateToProps = state => ({
  products: state.cart.items,
  totalPrice: state.cart.totalPrice,
  totalItems: state.cart.totalItems
});

export default connect(mapStateToProps, { cleartCart, removeFromCart })(cart);


