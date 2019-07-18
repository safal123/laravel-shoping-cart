import React, { Component } from 'react';
import { connect } from 'react-redux';

import { Spinner } from 'react-bootstrap';
import Pagination from "react-js-pagination";
import { allProducts } from '../actions/productAction';

class Paginate extends Component {
  constructor(props) {
    super(props);
    this.handlePageChange = this.handlePageChange.bind(this);
  }

  handlePageChange(pageNumber) {
    this.props.allProducts(pageNumber);
  }

  render() {
    if (!this.props.links && !this.props.meta) {
      return (
        <div className="text-center mt-2">
          <Spinner animation="border" role="status">
            <span className="sr-only">Loading...</span>
          </Spinner>
        </div>
      );
    }
    return (
      <div className="d-flex justify-content-center mt-4">
        <Pagination
          activePage={this.props.meta.current_page}
          itemsCountPerPage={this.props.meta.per_page}
          totalItemsCount={this.props.meta.total}
          pageRangeDisplayed={5}
          onChange={this.handlePageChange}
          itemClass='page-item mt-2'
          activeLinkClass='bg-dark text-white'
          linkClass='page-link'
        />
      </div>
    );
  }
}


export default connect(null, { allProducts })(Paginate);