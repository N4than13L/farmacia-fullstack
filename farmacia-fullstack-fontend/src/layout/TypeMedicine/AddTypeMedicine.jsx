import React from "react";
import { Global } from "../../helpers/Global.js";
import { useState } from "react";

export const AddTypeMedicine = () => {
  const [saved, setSaved] = useState("");

  const addTypeMedicine = async (e) => {
    // prevenir que se recargue la pagina
    e.preventDefault();

    // recoger los datos del formulario.
    let nombre = document.getElementById("nombre").value;

    let typemedicine = {
      name: nombre,
    };

    var token = localStorage.getItem("token");

    const request = await fetch(Global.url + "typemedicine/save", {
      method: "POST",
      body: JSON.stringify(typemedicine),
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
      <h2 className="text-center">Agrega el tipo de medicamentos</h2>
      <div className="mb-3">
        {saved == "saved" ? (
          <div
            class="alert alert-success alert-dismissible fade show container"
            role="alert"
          >
            tipo de medicamento registrado con éxito
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
            error al registrar
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="alert"
              aria-label="Close"
            ></button>
          </div>
        )}
      </div>
      <form
        className="container mb-4 rounded-3 bg-body"
        onSubmit={addTypeMedicine}
      >
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
            aria-describedby="emailHelp"
          />
        </div>

        <section className="text-center">
          <button className="btn btn-success">
            <i className="fa-solid fa-floppy-disk"></i>
            <input type="submit" value="Guardar" className="btn btn-success" />
          </button>
        </section>
        <br />
      </form>
    </>
  );
};
