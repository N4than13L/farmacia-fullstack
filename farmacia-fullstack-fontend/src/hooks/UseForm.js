import React, { useState } from "react";

export const UseForm = (initialOBJ) => {
  const [form, setForm] = useState(initialOBJ);

  const changed = ({ target }) => {
    const { name, value } = target;
    setForm({
      ...form,
      [name]: value,
    });
  };

  return {
    form,
    changed,
  };
};
