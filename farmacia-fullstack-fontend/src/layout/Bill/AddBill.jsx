import React, { useState, useEffect } from "react";
import { Global } from "../../helpers/Global";

export const AddBill = () => {
  // funcion para recoger valores del formulario.
  const [saved, setSaved] = useState("");
  const [client, setClient] = useState([{}]);
  const [medicine, setMedicine] = useState([{}]);

  useEffect(() => {
    Client();
    setClient(client);
  }, []);

  useEffect(() => {
    Medicine();
    setMedicine(medicine);
  }, []);

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
      setMedicine(data.medicine);
    }
  };

  const Client = async () => {
    const request = await fetch(Global.url + "clients", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization: token,
      },
    });

    const data = await request.json();
    // console.log(data);
    if (data.status == "success") {
      setClient(data.client);
    }
  };

  let token = localStorage.getItem("token");

  const addBill = async (e) => {
    // prevenir que se recargue la pagina
    e.preventDefault();

    // recoger los datos del formulario.
    let personal = document.getElementById("personal").value;
    let amount = document.getElementById("amount").value;
    let medicine_id = document.getElementById("medicine_id").value;
    let clients_id = document.getElementById("clients_id").value;

    let bill = {
      personal: personal,
      amount: amount,
      medicine_id: medicine_id,
      clients_id: clients_id,
    };

    console.log(bill);

    var token = localStorage.getItem("token");

    const request = await fetch(Global.url + "bill/save", {
      method: "POST",
      body: JSON.stringify(bill),
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
      <h2 className="text-center">Agrega tus Factuas </h2>
      <div className="mb-3">
        {saved == "saved" ? (
          <div
            className="alert alert-success alert-dismissible fade show container"
            role="alert"
          >
            Factura registrada con éxito
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
            Error al registrar
            <button
              type="button"
              className="btn-close"
              data-bs-dismiss="alert"
              aria-label="Close"
            ></button>
          </div>
        )}
      </div>
      <form className="container mb-4 rounded-3 bg-body" onSubmit={addBill}>
        {/* alerta si si envio el usuario */}
        <br />
        {/* personal */}
        <div className="mb-3">
          <label htmlFor="personal">Attendido Por:</label>
          <input
            type="text"
            className="form-control"
            name="personal"
            id="personal"
          />
        </div>
        {/* monto */}
        <div className="form-label mb-3">
          <label htmlFor="amount">Monto $</label>
          <input
            type="number"
            className="form-control"
            name="amount"
            id="amount"
          />
        </div>

        {/* medicina */}
        <select class="form-select mb-3" id="medicine_id">
          <option selected>Medicamento</option>
          {medicine?.map((med) => {
            return (
              <option key={med.id} value={med.id}>
                {med.name}
              </option>
            );
          })}
        </select>

        {/* cient */}
        <select class="form-select mb-3" id="clients_id">
          <option selected>Cliente</option>
          {client?.map((cli) => {
            return (
              <option key={cli.id} value={cli.id}>
                {cli.fullname}
              </option>
            );
          })}
        </select>

        <button className="btn btn-success mb-3">
          <i className="fa-solid fa-floppy-disk"></i>
          <input type="submit" value="Guardar" className="btn btn-success" />
        </button>

        <br />
      </form>
    </>
  );
};
