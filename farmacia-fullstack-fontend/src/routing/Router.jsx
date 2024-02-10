import React from "react";
import { Routes, Route, BrowserRouter, Navigate } from "react-router-dom";
import { Login } from "../layout/Login";
import { Register } from "../layout/Register";
import { Navbar } from "../layout/Navbar";
import { HomePage } from "../layout/HomePage";

// vistas principales.
import { User } from "../layout/user/User";
import { Profile } from "../layout/user/Profile";
import { Footer } from "../layout/footer";
import { TypeMedicine } from "../layout/TypeMedicine/TypeMedicine";
import { Medicine } from "../layout/medicine/Medicine";
import { SecEffects } from "../layout/SecEfects/SecEffects";
import { Suplier } from "../layout/Suplier/Suplier";
import { Client } from "../layout/Client/Client";
import { Bill } from "../layout/Bill/Bill";

// vistar secundarias.
import { AddSecEffects } from "../layout/SecEfects/AddSecEffects";
import { AddTypeMedicine } from "../layout/TypeMedicine/AddTypeMedicine";
import { AddClient } from "../layout/Client/AddClient";

export const Router = () => {
  return (
    <BrowserRouter>
      <Navbar />
      <Routes>
        <Route path="/" element={<HomePage />} />
        <Route index element={<HomePage />} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/user/settings" element={<User />} />
        <Route path="/user/profile" element={<Profile />} />

        {/* vistas principales  */}
        <Route path="/medicine" element={<Medicine />} />
        <Route path="/typemedicine" element={<TypeMedicine />} />
        <Route path="/suplier" element={<Suplier />} />
        <Route path="/seceffects" element={<SecEffects />} />
        <Route path="/client" element={<Client />} />
        <Route path="/bill" element={<Bill />} />

        {/* vistas extras */}
        <Route path="/add/seceffects" element={<AddSecEffects />} />
        <Route path="/add/typemedicine" element={<AddTypeMedicine />} />
        <Route path="/add/client" element={<AddClient />} />
      </Routes>
      <Footer />
    </BrowserRouter>
  );
};
