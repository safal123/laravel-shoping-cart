import React, { Component } from 'react';
import { connect } from 'react-redux';

import { allProducts } from '../../actions/productAction';
import Loader from '../loader';
import Pagination from '../pagination';
import Product from './product';

class Products extends Component {

  componentDidMount() {
    this.props.allProducts();
  }
  render() {
    const products = this.props.products.data;
    //const links = this.props.products.links;
    if (!products) {
      return <Loader />
    }
    else {
      return (
        <div className="py-4 container">
          <div className="row">
            <div className="col-md-12">
              <div className="d-flex p-2 bg-info justify-content-center">
                <h1>All Products</h1>
              </div>
              
              <Product products={products}/>
              <Pagination
                links={this.props.products.links}
                meta={this.props.products.meta}/>
            </div>
          </div>
        </div>
      );
    }
  }
}

const mapStateToProps = state => ({
  products: state.products.products,
});

export default connect(mapStateToProps, { allProducts })(Products);
