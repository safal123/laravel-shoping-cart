import React, { Component } from "react";
import { connect } from "react-redux";

import { allProducts } from "../../actions/productAction";
import Loader from "../loader/loader";
import Pagination from "./pagination";
import Product from "./product";

class Products extends Component {
    constructor() {
        super();
    }
    componentDidMount() {
        this.props.allProducts();
    }

    render() {
        const products = this.props.products.data;
        // if (!products) {
        //     return <Loader />;
        // } else {
        return (
            <div className="" style={{ padding: "20px" }}>
                <Product products={products} />
                <Pagination
                    links={this.props.products.links}
                    meta={this.props.products.meta}
                />
            </div>
        );
        //}
    }
}

const mapStateToProps = state => ({
    products: state.products.products
});

export default connect(mapStateToProps, { allProducts })(Products);
