import React, { useState, useEffect } from "react";
import { Global } from "../../helpers/Global.js";

export const AddMedicine = () => {
  // funcion para recoger valores del formulario.
  const [saved, setSaved] = useState("");
  const [suplier, setSuplier] = useState([{}]);
  const [secondary_effects, setSecEfects] = useState([{}]);
  const [type_medicine, setTipeMedicine] = useState([{}]);

  useEffect(() => {
    Suplier();
    setSuplier(suplier);
  }, []);

  useEffect(() => {
    Seceffects();
    setSecEfects(secondary_effects);
  }, []);

  useEffect(() => {
    typemedicine();
    setTipeMedicine(type_medicine);
  }, []);

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
    setTipeMedicine(data.type_medicine);
  };

  //   sacar suplidor
  const Suplier = async () => {
    const request = await fetch(Global.url + "supplier/index", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization: token,
      },
    });

    const data = await request.json();
    // console.log(data.suplier);
    setSuplier(data.suplier);
  };

  //   sacar efectos secundarios
  const Seceffects = async () => {
    const request = await fetch(Global.url + "seceffects/index", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Authorization: token,
      },
    });

    const data = await request.json();
    // console.log(data);
    setSecEfects(data.secondary_effects);
  };

  let token = localStorage.getItem("token");

  const addMedicine = async (e) => {
    // prevenir que se recargue la pagina
    e.preventDefault();

    // recoger los datos del formulario.
    let name = document.getElementById("name").value;
    let supplier_id = document.getElementById("sec_effects_id").value;

    let sec_effects_id = document.getElementById("sec_effects_id").value;

    let type_medicine_id = document.getElementById("type_medicine_id").value;

    let medicine = {
      name: name,
      type_medicine_id: type_medicine_id,
      sec_effects_id: sec_effects_id,
      supplier_id: supplier_id,
    };

    console.log(medicine);

    var token = localStorage.getItem("token");

    const request = await fetch(Global.url + "mediccine/save", {
      method: "POST",
      body: JSON.stringify(medicine),
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
      <h2 className="text-center">Agrega tus Medicamentos </h2>
      <div className="mb-3">
        {saved == "saved" ? (
          <div
            class="alert alert-success alert-dismissible fade show container"
            role="alert"
          >
            Medicamento registrado con éxito
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
      <form className="container mb-4 rounded-3 bg-body" onSubmit={addMedicine}>
        {/* alerta si si envio el usuario */}
        <br />
        <div className="mb-3">
          <label htmlFor="name" className="form-label">
            Nombre
          </label>
          <input
            type="text"
            className="form-control"
            name="name"
            id="name"
            aria-describedby="emailHelp"
          />
        </div>

        {/* suplidor */}
        <select class="form-select mb-3" id="supplier_id">
          <option selected>Suplidor</option>
          {suplier?.map((sup) => {
            return (
              <option key={sup.id} value={sup.id}>
                {sup.name}
              </option>
            );
          })}
        </select>

        {/* efecto secundario */}
        <select class="form-select mb-3" id="sec_effects_id">
          <option selected>Efectos secundario</option>
          {secondary_effects?.map((sec) => {
            return (
              <option key={sec.id} value={sec.id}>
                {sec.name}
              </option>
            );
          })}
        </select>

        {/* tipo de medicina */}
        <select class="form-select mb-3" id="type_medicine_id">
          <option selected>Tipo de Medicamento</option>
          {type_medicine?.map((sec) => {
            return (
              <option key={sec.id} value={sec.id}>
                {sec.name}
              </option>
            );
          })}
        </select>

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
