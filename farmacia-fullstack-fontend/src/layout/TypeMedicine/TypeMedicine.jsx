import React, { useState, useEffect } from "react";
import { Global } from "../../helpers/Global";

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
      {type_medicine?.map((type) => {
        return (
          <article className="card card-body p-4 mb-3" key={type.id}>
            <h5>
              <ins></ins>
            </h5>
            <strong>Nombre: </strong>
            <p> {type.name}</p>
          </article>
        );
      })}
    </div>
  );
};
