import React from 'react'

const  account = () => {
  return (
    <div className="" style={{ padding: "20px"}}>
      <div className="row mt-2">
        <div className="col-md-4">
          <div className="bg-dark" id="sidebar-wrapper">
            <div className="list-group">
              <a href="#" className="list-group-item list-group-item-action bg-dark text-white">Dashboard</a>
              <a href="#" className="list-group-item list-group-item-action bg-dark text-white">Profile</a>
              <a href="#" className="list-group-item list-group-item-action bg-dark text-white">Order</a>
              <a href="#" className="list-group-item list-group-item-action bg-dark text-white">Change Password</a>
              <a href="#" className="list-group-item list-group-item-action bg-dark text-white">Payment Method</a>
            </div>
          </div>
        </div>
        <div className="col-md-8  border border-danger">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
        </div>
      </div>
    </div>
  )
}

export default account;
