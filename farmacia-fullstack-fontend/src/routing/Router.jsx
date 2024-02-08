import React from "react";
import { Routes, Route, BrowserRouter, Navigate } from "react-router-dom";
import { Login } from "../layout/Login";
import { Register } from "../layout/Register";
import { Navbar } from "../layout/Navbar";
import { HomePage } from "../layout/HomePage";
import { User } from "../layout/user/User";
import { Profile } from "../layout/user/Profile";
import { Footer } from "../layout/footer";
import { TypeMedicine } from "../layout/TypeMedicine/TypeMedicine";
import { Medicine } from "../layout/medicine/Medicine";
import { SecEffects } from "../layout/SecEfects/SecEffects";
import { Suplier } from "../layout/Suplier/Suplier";
import { Client } from "../layout/Client/Client";
import { Bill } from "../layout/Bill/Bill";

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

        {/* tablas extras  */}
        <Route path="/medicine" element={<Medicine />} />
        <Route path="/typemedicine" element={<TypeMedicine />} />
        <Route path="/suplier" element={<Suplier />} />

        <Route path="/seceffects" element={<SecEffects />} />
        <Route path="/client" element={<Client />} />

        <Route path="/bill" element={<Bill />} />
      </Routes>
      <Footer />
    </BrowserRouter>
  );
};
