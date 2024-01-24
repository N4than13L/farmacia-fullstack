import React from "react";
import { Link } from "react-router-dom";

export const Navbar = () => {
  return (
    <nav className="navbar navbar-expand-lg bg-info">
      <div className="container-fluid">
        <Link className="navbar-brand" to="/">
          Farmacia los medicamentos
        </Link>
        <button
          className="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span className="navbar-toggler-icon"></span>
        </button>
        <Link to="/" className="nav-link active" aria-current="page">
          Home
        </Link>
        <div className="collapse navbar-collapse" id="navbarNav"></div>
        <section class="d-flex" role="search">
          <ul className="navbar-nav">
            <li className="nav-item"></li>
            <li className="nav-item">
              <Link to="/register" className="nav-link">
                Registro
              </Link>
            </li>
            <li className="nav-item">
              <Link to="/login" className="nav-link">
                Login
              </Link>
            </li>
          </ul>
        </section>
      </div>
    </nav>
  );
};
