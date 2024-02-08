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
      class="navbar navbar-expand-lg"
      style={{ backgroundColor: "rgb(77, 130, 214)" }}
    >
      <div class="container-fluid">
        <Link to="/" className="nav-link active" aria-current="page">
          <strong>Farmacia Los Mameyes</strong>
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
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          {!!setPerfil && usuario != null ? (
            <>
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <Link to="/" className="nav-link active" aria-current="page">
                    <i class="fa-solid fa-house"></i>&nbsp;Inicio
                  </Link>
                </li>

                <li class="nav-item">
                  <Link
                    to="/client"
                    className="nav-link active"
                    aria-current="page"
                  >
                    <i class="fa-brands fa-intercom"></i>&nbsp;clientes
                  </Link>
                </li>

                <li class="nav-item">
                  <Link
                    to="/bill"
                    className="nav-link active"
                    aria-current="page"
                  >
                    <i class="fa-solid fa-file-invoice"></i>&nbsp;factura
                  </Link>
                </li>

                <li class="nav-item">
                  <Link
                    to="/suplier"
                    className="nav-link active"
                    aria-current="page"
                  >
                    <i class="fa-solid fa-truck-field"></i>&nbsp;Suplidores
                  </Link>
                </li>

                <li class="nav-item">
                  <Link
                    to="/medicine"
                    className="nav-link active"
                    aria-current="page"
                  >
                    <i class="fa-solid fa-syringe"></i>&nbsp;medicamentos
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
                    {!!setPerfil && usuario != null ? (
                      <p>
                        <i class="fa-solid fa-user"></i>&nbsp;{usuario.name}{" "}
                        {usuario.surname}
                      </p>
                    ) : (
                      <p></p>
                    )}
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <Link class="dropdown-item" to="/user/profile">
                        <i class="fa-solid fa-user"></i>&nbsp;Perfil
                      </Link>
                    </li>

                    <li>
                      <Link class="dropdown-item" to="/user/settings">
                        <i class="fa-solid fa-gear"></i>&nbsp;Configuración
                      </Link>
                    </li>

                    <li>
                      <button onClick={logout} class="dropdown-item" href="#">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        &nbsp;Cerrar sesion
                      </button>
                    </li>
                  </ul>
                </li>
              </ul>
            </>
          ) : (
            <>
              <section class="d-flex m-2" role="search">
                <Link to="/register" className="nav-link">
                  <i class="fa-solid fa-address-card"></i>Registro
                </Link>
                &nbsp;&nbsp;&nbsp;
              </section>
              <section class="d-flex m-2" role="search">
                <Link to="/login" className="nav-link">
                  <i class="fa-solid fa-right-to-bracket"></i>Login
                </Link>
              </section>
            </>
          )}
        </div>
      </div>
    </nav>
  );
};
