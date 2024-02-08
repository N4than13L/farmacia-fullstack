import React from "react";
import { Global } from "../../helpers/Global";
import { UseForm } from "../../hooks/UseForm.js";
import { Link } from "react-router-dom";
import { useState } from "react";

export const User = () => {
  const [saved, setSaved] = useState("");
  const { changed, form } = UseForm({});

  // sacar datos de la session.
  var user = JSON.parse(localStorage.getItem("user"));

  // sacar id de usuario para actualizar
  var user_id = user.id;
  // console.log(user_id);

  const Update = async (e) => {
    // prevenir que se recargue la pagina
    e.preventDefault();

    // recoger los datos del formulario.
    let nombre = document.getElementById("nombre").value;
    let apellido = document.getElementById("apellido").value;
    let email = document.getElementById("email").value;

    // recoger valores del token.
    var token = localStorage.getItem("token");

    let newUser = {
      name: nombre,
      surname: apellido,
      email: email,
    };

    // console.log(newUser);
    const request = await fetch(Global.url + "user/update", {
      method: "POST",
      body: JSON.stringify(newUser),
      headers: {
        Authorization: token,
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
      <h2 className="text-center">Actualiza tus datos aquí </h2>
      <div className="mb-3">
        {saved == "saved" ? (
          <div
            class="alert alert-success alert-dismissible fade show container"
            role="alert"
          >
            Usuario Actualizado con exito
            <button
              type="button"
              className="btn-close"
              data-bs-dismiss="alert"
              aria-label="Close"
            ></button>
          </div>
        ) : (
          <div
            className="alert alert-danger alert-dismissible fade show container"
            role="alert"
          >
            Error al actualizar el usuario Favor inserte datos correctamente
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="alert"
              aria-label="Close"
            ></button>
          </div>
        )}
      </div>
      <form className="container mb-4 rounded-3 bg-body" onSubmit={Update}>
        {/* alerta si si envio el usuario */}
        <br />
        <div className="mb-3">
          <label htmlFor="exampleInputEmail1" className="form-label">
            Nombre
          </label>
          <input
            type="text"
            className="form-control"
            name="name"
            id="nombre"
            defaultValue={user.name}
            aria-describedby="emailHelp"
          />
        </div>

        <div className="mb-3">
          <label htmlFor="exampleInputEmail1" className="form-label">
            Apellido
          </label>
          <input
            type="text"
            className="form-control"
            id="apellido"
            name="surname"
            defaultValue={user.surname}
            aria-describedby="emailHelp"
          />
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
            defaultValue={user.email}
            aria-describedby="emailHelp"
          />
        </div>

        <section className="text-center">
          <button className="btn btn-success">
            <input
              type="submit"
              value="Actualizar"
              className="btn btn-success"
            />
          </button>
        </section>
        <br />
      </form>
    </>
  );
};
