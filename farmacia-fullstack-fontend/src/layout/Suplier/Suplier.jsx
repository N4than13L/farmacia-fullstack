import React, { useState, useEffect } from "react";
import { Global } from "../../helpers/Global.js";
import { Link } from "react-router-dom";

// supplier/index
export const Suplier = () => {
  // funcion para recoger valores del formulario.
  const [saved, setSaved] = useState("error");
  const [suplier, setPaciente] = useState([{}]);

  useEffect(() => {
    Suplier();
  }, []);

  let token = localStorage.getItem("token");

  const Suplier = async () => {
    const request = await fetch(Global.url + "supplier/index", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization: token,
      },
    });

    const data = await request.json();
    setPaciente(data.suplier);
  };

  return (
    <div className="container bg-body mt-3 rounded-3">
      <h1 className="text-center">Suplidor</h1>

      {/* accion de agregar */}
      <Link className="btn btn-success m-2" to="/add/supplier">
        <i className="fa-solid fa-plus"></i>
      </Link>

      {suplier?.map((supp) => {
        return (
          <article className="card card-body p-4 mb-3" key={supp.id}>
            <h5>
              <ins></ins>
            </h5>
            <strong>Id: </strong>
            <p> {supp.id}</p>

            <strong>Nombre: </strong>
            <p> {supp.name}</p>
            <strong>télefono: </strong>
            <p> {supp.phone}</p>
            <strong>direción: </strong>
            <p> {supp.address}</p>

            <strong>email: </strong>
            <p> {supp.email}</p>

            <strong>rnc: </strong>
            <p> {supp.rnc}</p>

            <strong>creado el: </strong>
            <p> {supp.created_at}</p>

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
