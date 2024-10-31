import React, { useState } from 'react';
import { useMutation, useQueryClient } from '@tanstack/react-query';
import API_URL from '../config';

const MenuForm = () => {
  const [name, setName] = useState('');
  const queryClient = useQueryClient();
  
  const mutation = useMutation(
    (newMenu) => {
      return fetch(`${API_URL}/menus`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(newMenu),
      });
    },
    {
      onSuccess: () => {
        queryClient.invalidateQueries('menus');
      },
    }
  );

  const handleSubmit = (e) => {
    e.preventDefault();
    mutation.mutate({ name });
    setName('');
  };

  return (
    <form onSubmit={handleSubmit} className="mb-4">
      <input 
        type="text" 
        value={name} 
        onChange={(e) => setName(e.target.value)} 
        placeholder="New Menu Name" 
        className="border p-2"
      />
      <button type="submit" className="bg-green-500 text-white p-2 ml-2">
        Create Menu
      </button>
    </form>
  );
};

export default MenuForm;
