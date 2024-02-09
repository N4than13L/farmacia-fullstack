import React, { useState, useEffect } from "react";
import { Global } from "../../helpers/Global.js";

export const SecEffects = () => {
  // funcion para recoger valores del formulario.
  const [saved, setSaved] = useState("error");
  const [secondary_effects, setPaciente] = useState([{}]);

  useEffect(() => {
    seceffects();
  });

  let token = localStorage.getItem("token");

  const seceffects = async () => {
    const request = await fetch(Global.url + "seceffects/index", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization: token,
      },
    });

    const data = await request.json();
    // console.log(data);
    setPaciente(data.secondary_effects);
  };

  return (
    <div className="container bg-body mt-3 rounded-3 mb-3">
      <h1 className="text-center">Efectos secundarios</h1>
      {secondary_effects?.map((pac) => {
        return (
          <article className="card card-body p-4 mb-3" key={pac.id}>
            <h5>
              <ins></ins>
            </h5>
            <strong>Nombre: </strong>
            <p> {pac.name}</p>
          </article>
        );
      })}
    </div>
  );
};
