import React from "react";
import { Routes, Route, BrowserRouter, Navigate } from "react-router-dom";
import { Login } from "../layout/Login";
import { Register } from "../layout/Register";
import { Navbar } from "../layout/Navbar";
import { HomePage } from "../layout/HomePage";
import { User } from "../layout/user/User";

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
      </Routes>
    </BrowserRouter>
  );
};
