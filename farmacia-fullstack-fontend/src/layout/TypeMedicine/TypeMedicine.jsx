import React, { useState, useEffect } from "react";
import { Global } from "../../helpers/Global";
import { Link } from "react-router-dom";

export const TypeMedicine = () => {
  // funcion para recoger valores del formulario.
  const [saved, setSaved] = useState("error");
  const [type_medicine, setPaciente] = useState([{}]);

  useEffect(() => {
    typemedicine();
  });

  let token = localStorage.getItem("token");

  const typemedicine = async () => {
    const request = await fetch(Global.url + "typemedicine/index", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization: token,
      },
    });

    const data = await request.json();
    // console.log(data);
    setPaciente(data.type_medicine);
  };

  return (
    <div className="container bg-body mt-3 rounded-3">
      <h1 className="text-center">Tipo de medicinas</h1>

      {/* accion de agregar */}
      <Link className="btn btn-success m-2" to="/add/typemedicine">
        <i className="fa-solid fa-plus"></i>
      </Link>

      {type_medicine?.map((type) => {
        return (
          <article className="card card-body p-4 mb-3" key={type.id}>
            <h5>
              <ins></ins>
            </h5>
            <strong>Nombre: </strong>
            <p> {type.name}</p>

            <strong>Creado el: </strong>
            <p> {type.created_at}</p>

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
