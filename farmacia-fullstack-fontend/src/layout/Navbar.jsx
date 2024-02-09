import React from "react";
import { Link } from "react-router-dom";
import { useState, useEffect } from "react";

export const Navbar = () => {
  const [perfil, setPerfil] = useState(false);
  const [usuario, setUsuario] = useState("");

  const profile = () => {
    return JSON.parse(localStorage.getItem("user"));
  };

  useEffect(() => {
    setUsuario(profile);
    setPerfil(true);
  }, []);

  const logout = () => {
    // redireccion
    setTimeout(() => {
      window.location.href = "/";
    }, 100);

    // limpiar datos de sesion.
    localStorage.clear();
  };

  return (
    <nav
      className="navbar navbar-expand-lg"
      style={{ backgroundColor: "rgb(77, 130, 214)" }}
    >
      <div className="container-fluid">
        <Link to="/" className="nav-link active" aria-current="page">
          <h3>Farmacia Los Mameyes</h3>
        </Link>
        <button
          className="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span className="navbar-toggler-icon"></span>
        </button>
        <div className="collapse navbar-collapse" id="navbarSupportedContent">
          {!!setPerfil && usuario != null ? (
            <>
              <ul className="navbar-nav me-auto mb-lg-0">
                <li className="nav-item">
                  <Link to="/" className="nav-link active" aria-current="page">
                    <i className="fa-solid fa-house"></i>&nbsp;Inicio
                  </Link>
                </li>

                <li className="nav-item">
                  <Link
                    to="/client"
                    className="nav-link active"
                    aria-current="page"
                  >
                    <i className="fa-brands fa-intercom"></i>&nbsp;clientes
                  </Link>
                </li>

                <li className="nav-item">
                  <Link
                    to="/bill"
                    className="nav-link active"
                    aria-current="page"
                  >
                    <i className="fa-solid fa-file-invoice"></i>&nbsp;factura
                  </Link>
                </li>

                <li className="nav-item">
                  <Link
                    to="/suplier"
                    className="nav-link active"
                    aria-current="page"
                  >
                    <i className="fa-solid fa-truck-field"></i>&nbsp;Suplidores
                  </Link>
                </li>

                {/* medicamentos */}
                <strong className="nav-item dropdown">
                  <a
                    className="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    <i className="fa-solid fa-syringe"></i> Medicamentos
                  </a>
                  <ul className="dropdown-menu" id="drop">
                    <li>
                      <Link className="dropdown-item" to="/medicine">
                        <i className="fa-solid fa-syringe"></i>
                        &nbsp;Medicamentos
                      </Link>
                    </li>

                    <li>
                      <Link className="dropdown-item" to="/typemedicine">
                        <i className="fa-solid fa-rectangle-list"></i>&nbsp;Tipo
                        de medicamentos
                      </Link>
                    </li>

                    <li>
                      <Link className="dropdown-item" to="/seceffects">
                        <i className="fa-solid fa-clipboard-list"></i>{" "}
                        &nbsp;Efectos secundarios
                      </Link>
                    </li>
                  </ul>
                </strong>
              </ul>
              <strong className="nav-item dropdown">
                <a
                  className="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  {!!setPerfil && usuario != null ? (
                    <p>
                      <i className="fa-solid fa-user"></i>&nbsp;{usuario.name}
                      {usuario.surname}
                    </p>
                  ) : (
                    <p></p>
                  )}
                </a>
                <ul className="dropdown-menu" id="drop">
                  <li>
                    <Link className="dropdown-item" to="/user/profile">
                      <i className="fa-solid fa-user"></i>&nbsp;Perfil
                    </Link>
                  </li>

                  <li>
                    <Link className="dropdown-item" to="/user/settings">
                      <i className="fa-solid fa-gear"></i>&nbsp;Configuración
                    </Link>
                  </li>

                  <li>
                    <button onClick={logout} className="dropdown-item" href="#">
                      <i className="fa-solid fa-right-from-bracket"></i>
                      &nbsp;Cerrar sesion
                    </button>
                  </li>
                </ul>
              </strong>
            </>
          ) : (
            <>
              <section className="d-flex" role="search">
                <Link to="/register" className="nav-link">
                  <i className="fa-solid fa-address-card"></i>Registro
                </Link>
                &nbsp;&nbsp;&nbsp;
              </section>
              <section className="d-flex" role="search">
                <Link to="/login" className="nav-link">
                  <i className="fa-solid fa-right-to-bracket"></i>Login
                </Link>
              </section>
            </>
          )}
        </div>
      </div>
    </nav>
  );
};
