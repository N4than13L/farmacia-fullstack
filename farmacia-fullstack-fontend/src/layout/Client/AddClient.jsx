import React from "react";
import { Global } from "../../helpers/Global.js";
import { useState } from "react";

export const AddClient = () => {
  const [saved, setSaved] = useState("");

  const addClient = async (e) => {
    // prevenir que se recargue la pagina
    e.preventDefault();

    // recoger los datos del formulario.
    let fullname = document.getElementById("name").value;
    let address = document.getElementById("address").value;
    let phone = document.getElementById("phone").value;

    let client = {
      fullname: fullname,
      address: address,
      phone: phone,
    };

    var token = localStorage.getItem("token");

    const request = await fetch(Global.url + "clients/save", {
      method: "POST",
      body: JSON.stringify(client),
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
      <h2 className="text-center">Agrega clientes </h2>
      <div className="mb-3">
        {saved == "saved" ? (
          <div
            class="alert alert-success alert-dismissible fade show container"
            role="alert"
          >
            Cliente registrado con éxito
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
            Error al registrar
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="alert"
              aria-label="Close"
            ></button>
          </div>
        )}
      </div>
      <form className="container mb-4 rounded-3 bg-body" onSubmit={addClient}>
        {/* alerta si si envio el usuario */}
        <br />
        <div className="mb-3">
          <label htmlFor="exampleInputEmail1" className="form-label">
            Nombre completo
          </label>
          <input
            type="text"
            className="form-control"
            name="name"
            id="name"
            aria-describedby="emailHelp"
          />
        </div>

        <div className="mb-3">
          <label htmlFor="exampleInputEmail1" className="form-label">
            Direccion
          </label>
          <input
            type="text"
            className="form-control"
            name="address"
            id="address"
            aria-describedby="emailHelp"
          />
        </div>

        <div className="mb-3">
          <label htmlFor="exampleInputEmail1" className="form-label">
            phone
          </label>
          <input
            type="text"
            className="form-control"
            name="phone"
            id="phone"
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
