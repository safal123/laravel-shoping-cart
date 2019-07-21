import React from 'react'
import { connect } from 'react-redux';

const cart = (props) => {

  // All products from the cart item
  const products = props.products;

  if (products.length > 0) {
    return (
      <div className="container">
        <h1>Items on cart. Total Items : { props.totalItems }</h1>
        <table id="cart" className="table table-hover table-condensed mt-2">
          <thead className="bg-info">
            <tr>
              <th style={{ width: "50%" }}>Product</th>
              <th style={{ width: "10%" }}>Price</th>
              <th style={{ width: "8%" }}>Quantity</th>
              <th style={{ width: "22%" }} className="text-center">Subtotal</th>
              <th style={{ width: "10%" }}></th>
            </tr>
          </thead>
          <tbody>
            { products.map(product => (
              <tr key={product.id}>
                <td>
                  {product.name}
                </td>
                <td>${product.price.toFixed(2)}</td>
                <td>
                  {product.quantity}
                </td>
                <td>
                  ${(product.price.toFixed(2)) * 1 }
                </td>
                <td>
                  <a href="#" className="btn btn-danger">
                    <i className="fa fa-trash" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
        <div>
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

export default connect(mapStateToProps)(cart);


