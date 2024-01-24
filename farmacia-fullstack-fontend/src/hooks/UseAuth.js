import React, { useContext } from "react";
import AuthConext from "context/AuthProvider";

const UseAuth = () => {
  return useContext(AuthConext);
};

export default UseAuth;
