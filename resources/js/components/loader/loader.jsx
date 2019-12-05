import React, { Component } from 'react';
import { Spinner } from 'reactstrap';

class Loader extends Component {
    render() {
        return (
            <div>
                <Spinner style={{
                    position: 'absolute',
                    height: '100px',
                    width: '100px',
                    top: '50%',
                    left: '50%',
                    marginLeft: '-50px',
                    marginTop: '-50px',
                    backgroundSize: '100%',
                    zIndex: '1000',
                }} />{' '}
            </div>
        );
    }
}

export default Loader;