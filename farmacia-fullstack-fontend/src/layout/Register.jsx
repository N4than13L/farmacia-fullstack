import React from "react";
import { Global } from "../helpers/Global";
import { UseForm } from "../hooks/UseForm";

import { useState } from "react";
export const Register = () => {
  const [saved, setSaved] = useState("error");

  const RegisterUser = async (e) => {
    // prevenir que se recargue la pagina
    e.preventDefault();

    // datos de los hooks

    // recoger los datos del formulario.
    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellido").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    // var newUser = {
    //   json: [
    //     { name: nombre },
    //     { surname: apellido },
    //     { email: email },
    //     { password: password },
    //   ],
    // };

    let newUser = {
      name: nombre,
      surname: apellido,
      email: email,
      password: password,
    };

    console.log(newUser);

    const request = await fetch(Global.url + "register", {
      method: "POST",
      body: newUser,
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json; charset=utf-8",
      },
    });

    const data = await request.json();
    console.log(data);
    if (data.status == "success") {
      setSaved("saved");
    } else {
      setSaved("error");
    }
  };

  return (
    <>
      <h2 className="text-center">Registrate aquí </h2>
      <div className="mb-3">
        {saved == "saved" ? (
          <strong className="alert alert-success">
            Usuario guardado exitosamente
          </strong>
        ) : (
          ""
        )}
        {saved == "error" ? (
          <strong className="alert alert-danger">Error al registrar</strong>
        ) : (
          ""
        )}
      </div>
      <form className="container" onSubmit={RegisterUser}>
        {/* alerta si si envio el usuario */}

        <div className="mb-3">
          <label for="exampleInputEmail1" className="form-label">
            Nombre
          </label>
          <input
            type="text"
            className="form-control"
            id="nombre"
            aria-describedby="emailHelp"
          />
        </div>

        <div className="mb-3">
          <label for="exampleInputEmail1" className="form-label">
            Apellido
          </label>
          <input
            type="text"
            className="form-control"
            id="apellido"
            aria-describedby="emailHelp"
          />
        </div>

        <div className="mb-3">
          <label for="exampleInputEmail1" className="form-label">
            Correo electronico
          </label>
          <input
            type="email"
            className="form-control"
            id="email"
            aria-describedby="emailHelp"
          />
        </div>
        <div className="mb-3">
          <label for="exampleInputPassword1" className="form-label">
            Contraseña
          </label>
          <input type="password" className="form-control" id="password" />
        </div>

        <section className="text-center">
          <input
            type="submit"
            value="Registrarte"
            className="btn btn-success"
          />
        </section>
      </form>
    </>
  );
};
