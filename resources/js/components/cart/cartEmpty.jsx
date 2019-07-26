import React from 'react'
import { Link } from 'react-router-dom';

function cartEmpty() {
  return (
    <div className="container mt-2">
      <div className="card">
        <div className="card-header">
          <i className="fa fa-cart-plus fa-10x"></i> Your cart is empty.
        </div>
        <div className="card-body">
          <Link to="/react/allProducts" className="btn btn-primary">
            <i className="fa fa-hand-o-left" aria-hidden="true"></i> &nbsp;
            Continue shopping
          </Link>
          <hr/>
        </div>
      </div>
    </div>
  )
}

export default cartEmpty;
