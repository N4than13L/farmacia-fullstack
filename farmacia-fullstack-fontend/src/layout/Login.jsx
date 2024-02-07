import React from "react";
import { Global } from "../helpers/Global";
import { useState } from "react";

export const Login = () => {
  const [saved, setSaved] = useState("");

  const Login = async (e) => {
    // prevenir que se recargue la pagina
    e.preventDefault();

    // recoger los datos del formulario.
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    let login = {
      email: email,
      password: password,
    };

    const request = await fetch(Global.url + "login", {
      method: "POST",
      body: JSON.stringify(login),
      headers: {
        "Content-Type": "application/json; charset=utf-8",
      },
    });

    const data = await request.json();

    console.log(data);

    if (data.status == "success") {
      setSaved("saved");
      // persistir datos en el navegador en el navegador.
      localStorage.setItem("token", data.token);
      localStorage.setItem("user", JSON.stringify(data.user));

      setTimeout(() => {
        window.location.href = "/";
      }, 750);
    } else {
      setSaved("error");
    }
  };

  return (
    <>
      <h2 className="text-center">inicia seccion aquí </h2>

      <form className="container" onSubmit={Login}>
        <div className="mb-3">
          {saved == "saved" ? (
            <div
              class="alert alert-success alert-dismissible fade show container"
              role="alert"
            >
              Login exitoso Iniciando sesion &nbsp;
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
              ></button>
            </div>
          ) : (
            <div
              class="alert alert-danger alert-dismissible fade show container"
              role="alert"
            >
              Error al hacer login favor inserte los datos correctamente
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
              ></button>
            </div>
          )}
        </div>
        <div className="mb-3">
          <label htmlFor="exampleInputEmail1" className="form-label">
            Correo electronico
          </label>
          <input
            type="email"
            className="form-control"
            id="email"
            name="email"
            aria-describedby="emailHelp"
          />
        </div>
        <div className="mb-3">
          <label htmlFor="exampleInputPassword1" className="form-label">
            Contraseña
          </label>
          <input
            type="password"
            className="form-control"
            id="password"
            name="password"
          />
        </div>
        <section className="text-center">
          <button className="btn btn-success">
            <i class="fa-solid fa-right-to-bracket"></i>
            <input type="submit" value="Login" className="btn btn-success" />
          </button>
        </section>
      </form>
    </>
  );
};
