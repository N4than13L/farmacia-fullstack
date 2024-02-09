import React, { useState, useEffect } from "react";
import { Global } from "../../helpers/Global";

export const Client = () => {
  // funcion para recoger valores del formulario.
  const [saved, setSaved] = useState("error");
  const [client, setPaciente] = useState([{}]);

  useEffect(() => {
    Client();
  });

  let token = localStorage.getItem("token");

  const Client = async () => {
    const request = await fetch(Global.url + "clients", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization: token,
      },
    });

    const data = await request.json();
    console.log(data);
    if (data.status == "success") {
      setPaciente(data.client);
    }
  };

  return (
    <div className="container bg-body mt-3 rounded-3">
      <h1 className="text-center">Clientes</h1>
      {client?.map((client) => {
        return (
          <article className="card card-body p-4 mb-3" key={client.id}>
            <h5>
              <ins></ins>
            </h5>
            <strong>Id: </strong>
            <p> {client.id}</p>
            <strong>Nombre: </strong>
            <p> {client.fullname}</p>
            <strong>Dirección: </strong>
            <p> {client.address}</p>

            <strong>télefono: </strong>
            <p> {client.phone}</p>
            <strong>Creado el: </strong>
            <p> {client.created_at}</p>

            <strong>usuario: </strong>
            <p> {client.user_id}</p>
          </article>
        );
      })}
    </div>
  );
};
