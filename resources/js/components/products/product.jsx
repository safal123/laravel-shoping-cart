import React, { Component } from 'react';
import { connect } from 'react-redux';

import { addToCart } from '../../actions/cartAction';

class Product extends Component {

  constructor(props) {
    super(props);
    this.handleClick = this.handleClick.bind(this);
  }

  handleClick(product) {
    console.log(product);
    this.props.addToCart(product);
  }

  render() {
    return (
      <div className="row">
        { this.props.products && this.props.products.map(product => (
          <div className="col-md-4 mt-1" key={product.id}>
            <div className="card">
              <img className="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(81).jpg" alt="Card image cap" />
              <div className="card-body">
                <hr />
                <h5 className="card-title">{product.name}</h5>
                <div className="row">
                  <div className="col-md-5">
                    AUD {product.price.toFixed(2)}
                  </div>
                  <div className="col-md-7">
                    <button className="btn btn-sm btn-success" onClick={() => { this.handleClick(product) }}>
                      <i className="fa fa-shopping-cart"></i> add to cart
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>
    );
  }
}

// const mapDispatchToProps = (dispatch) => {
//   return {
//     addToCart: (id) => { dispatch(addToCart(id)) }
//   }
// }

export default connect(null, { addToCart })(Product);