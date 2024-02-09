import React, { useState, useEffect } from "react";
import { Global } from "../../helpers/Global";

export const Bill = () => {
  // funcion para recoger valores del formulario.
  const [saved, setSaved] = useState("error");
  const [bill, setPaciente] = useState([{}]);

  useEffect(() => {
    Bill();
  });

  let token = localStorage.getItem("token");

  const Bill = async () => {
    const request = await fetch(Global.url + "bill/index", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization: token,
      },
    });

    const data = await request.json();
    if (data.status == "success") {
      setPaciente(data.bill);
    }
  };
  return (
    <div className="container bg-body mt-3 rounded-3">
      <h1 className="text-center">Factura</h1>
      {bill?.map((bill) => {
        return (
          <article className="card card-body p-4 mb-3" key={bill.id}>
            <h5>
              <ins></ins>
            </h5>
            <strong>Id: </strong>
            <p> {bill.id}</p>

            <strong>atendido por: </strong>
            <p>{bill.personal}</p>

            <strong>Monto: </strong>
            <p> $RD {bill.amount}</p>

            <strong>Medicina_id: </strong>
            <p>{bill.medicine_id}</p>

            <strong>usuario: </strong>
            <p> {bill.user_id}</p>

            <strong>Creado el: </strong>
            <p> {bill.created_at}</p>
          </article>
        );
      })}
    </div>
  );
};
