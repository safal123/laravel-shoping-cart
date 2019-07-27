import React from 'react';
import { connect } from 'react-redux';

const productDetail = (props) => {
  return (
    <div className="container">
      <h1>Hello i am product detail: { props.match.params.id }</h1>
    </div>
  )
}

export default connect(null)(productDetail);
