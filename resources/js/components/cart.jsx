import React from 'react'
import { connect } from 'react-redux';

const cart = (props) => {
  const products = props.products
  if (products.length > 0) {
    return (
      <div className="container">
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
            {products.map(product => (
              <tr key={product.id}>
                <td>
                  {product.name}
                </td>
                <td>$1.99</td>
                <td>
                </td>
                <td>
                  1.99
                    </td>
                <td>
                  <a href="#" className="btn btn-danger">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
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
});

export default connect(mapStateToProps)(cart);


