import React from "react";

export const Login = () => {
  return (
    <>
      <h2 className="text-center">inicia seccion aquí </h2>
      <form className="container">
        <div className="mb-3">
          <label htmlFor="exampleInputEmail1" className="form-label">
            Correo electronico
          </label>
          <input
            type="email"
            className="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
          />
        </div>
        <div className="mb-3">
          <label htmlFor="exampleInputPassword1" className="form-label">
            Contraseña
          </label>
          <input
            type="password"
            className="form-control"
            id="exampleInputPassword1"
          />
        </div>
        <section className="text-center">
          <button type="submit" className="btn btn-primary">
            Login
          </button>
        </section>
      </form>
    </>
  );
};
