import React, { useState, useEffect } from "react";
import { Global } from "../../helpers/Global";
import { Link } from "react-router-dom";

export const Medicine = () => {
  // funcion para recoger valores del formulario.
  const [saved, setSaved] = useState("error");
  const [medicine, setPaciente] = useState([{}]);

  useEffect(() => {
    Medicine();
  });

  let token = localStorage.getItem("token");

  const Medicine = async () => {
    const request = await fetch(Global.url + "mediccine/index", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization: token,
      },
    });

    const data = await request.json();
    if (data.status == "success") {
      setPaciente(data.medicine);
    }
  };

  return (
    <div className="container bg-body mt-3 rounded-3">
      <h1 className="text-center">Medicamentos</h1>

      {/* accion de agregar */}
      <Link className="btn btn-success m-2" to="/add/medicine">
        <i className="fa-solid fa-plus"></i>
      </Link>

      {medicine?.map((med) => {
        return (
          <article className="card card-body p-4 mb-3" key={med.id}>
            <h5>
              <ins></ins>
            </h5>
            <strong>Nombre: </strong>
            <p> {med.name}</p>

            <strong>credao el : </strong>
            <p> {med.created_at}</p>

            {/* acciones de eliminar y editar */}
            <Link className="btn btn-warning m-2 btn-sm" to="/">
              <i className="fa-solid fa-pen-to-square"></i>
            </Link>

            <Link className="btn btn-danger m-2 btn-sm" to="/">
              <i className="fa-solid fa-trash"></i>
            </Link>
          </article>
        );
      })}
    </div>
  );
};
