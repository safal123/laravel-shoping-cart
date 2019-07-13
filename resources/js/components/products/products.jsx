import React, { Component } from 'react';
import { connect } from 'react-redux';

import { allProducts } from '../../actions/productAction';

class Products extends Component {

  componentWillMount() {
    this.props.allProducts();
  }
  render() {
    return (
      <div className="py-4 container">
        <div className="row">
          <div className="col-md-12">
            <div className="row">
              <div className="col-sm-3 mt-1">
                <div className="card">
                  <img className="card-img-top" src="/img/2.jpg" alt="Card image cap" />
                  <div className="card-body">
                    <hr />
                    <h5 className="card-title">Samsung S10 plus</h5>
                    <div className="row">
                      <div className="col-md-5">
                        AU <i className="fa fa-dollar"></i>12
                      </div>
                      <div className="col-md-7">
                        <button className="btn btn-sm btn-info">
                          <i className="fa fa-shopping-cart"></i>
                          Add to cart
                        </button>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <div className="col-sm-3 mt-1">
                <div className="card">
                  <img className="card-img-top" src="/img/2.jpg" alt="Card image cap" />
                  <div className="card-body">
                  </div>
                </div>
              </div>
              <div className="col-sm-3 mt-1">
                <div className="card">
                  <img className="card-img-top" src="/img/2.jpg" alt="Card image cap" />
                  <div className="card-body">
                  </div>
                </div>
              </div>
              <div className="col-sm-3 mt-1">
                <div className="card">
                  <img className="card-img-top" src="/img/2.jpg" alt="Card image cap" />
                  <div className="card-body">
                  </div>
                </div>
              </div>
              <div className="col-sm-3 mt-1">
                <div className="card">
                  <img className="card-img-top" src="/img/2.jpg" alt="Card image cap" />
                  <div className="card-body">
                  </div>
                </div>
              </div>
              <div className="col-sm-3 mt-1">
                <div className="card">
                  <img className="card-img-top" src="/img/2.jpg" alt="Card image cap" />
                  <div className="card-body">
                  </div>
                </div>
              </div>
              <div className="col-sm-3 mt-1">
                <div className="card">
                  <img className="card-img-top" src="/img/2.jpg" alt="Card image cap" />
                  <div className="card-body">
                  </div>
                </div>
              </div>
              <div className="col-sm-3 mt-1">
                <div className="card">
                  <img className="card-img-top" src="/img/2.jpg" alt="Card image cap" />
                  <div className="card-body">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

const mapStateToProps = state => ({
  products: state.products.products,
});

export default connect(null, { allProducts })(Products);
