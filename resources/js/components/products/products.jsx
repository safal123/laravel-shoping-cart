import React, { Component } from "react";
import { connect } from "react-redux";

import { allProducts } from "../../actions/productAction";
import Loader from "../loader/loader";
import Pagination from "./pagination";
import Product from "./product";

class Products extends Component {
    constructor() {
        super();
        this.state = {
            btnText: "Show list",
            gridView: true
        };
        this.changeView = this.changeView.bind(this);
    }
    componentDidMount() {
        this.props.allProducts();
    }
    changeView() {
        this.setState({ gridView: !this.state.gridView }, () => {
            if (this.state.gridView) {
                this.setState({ btnText: "Show List" });
            } else {
                this.setState({ btnText: "Show Grid" });
            }
        });
    }

    render() {
        const products = this.props.products.data;
        const { gridView } = this.state;
        if (!products) {
            return <Loader />;
        } else {
            return (
                <div className="" style={{ padding: "20px" }}>
                    <div className="row">
                        <div className="col-md-12">
                            <div className="row">
                                <div className="col-md-12 mt-0 mb-1">
                                    {/* <i class="fa fa-list"></i>List
                                    <i class="fa fa-th"></i>Grid */}
                                    <button
                                        className="btn btn-sm btn-info"
                                        onClick={() => this.changeView()}
                                    >
                                        {this.state.btnText}
                                    </button>
                                </div>
                            </div>

                            <Product products={products} gridView={gridView} />
                            <Pagination
                                links={this.props.products.links}
                                meta={this.props.products.meta}
                            />
                        </div>
                    </div>
                </div>
            );
        }
    }
}

const mapStateToProps = state => ({
    products: state.products.products
});

export default connect(mapStateToProps, { allProducts })(Products);
