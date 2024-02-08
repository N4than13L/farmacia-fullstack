import React from "react";

export const Profile = () => {
  var user = JSON.parse(localStorage.getItem("user"));
  return (
    <section className="m-3 bg-body rounded-3 p-3">
      <h2 className="text-center">Datos del usuario con id: {user.id}</h2>
      <article className="container">
        <div className="p-2 bg-success rounded-3">
          <i class="fa-solid fa-user"></i>
        </div>
        <h3>Nombre</h3>
        <p>{user.name}</p>
        <h3>apellido</h3>
        <p>{user.surname}</p>
        <h3>Correo electronico</h3>
        <p>{user.email}</p>
        <h3>Creado el:</h3>
        <p>{user.created_at}</p>
      </article>
    </section>
  );
};
