import React from "react";
import { Link } from "react-router-dom";

export const Navbar = () => {
  return (
    <nav class="navbar navbar-expand-lg bg-info">
      <div class="container-fluid">
        <Link to="/" className="nav-link active" aria-current="page">
          <h6>Farmacia Los Mameyes</h6>
        </Link>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <Link to="/" className="nav-link active" aria-current="page">
                Home
              </Link>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Dropdown
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="#">
                    Action
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="#">
                    Another action
                  </a>
                </li>
                <li>
                  <hr class="dropdown-divider" />
                </li>
                <li>
                  <a class="dropdown-item" href="#">
                    Something else here
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Disabled</a>
            </li>
          </ul>
          <section class="d-flex" role="search">
            <Link to="/register" className="nav-link">
              Registro
            </Link>
            &nbsp;&nbsp;&nbsp;
          </section>
          <section class="d-flex" role="search">
            <Link to="/login" className="nav-link">
              Login
            </Link>
          </section>
        </div>
      </div>
    </nav>
  );
};
