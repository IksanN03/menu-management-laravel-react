import React, { useState } from 'react';
import { useMutation, useQueryClient } from '@tanstack/react-query';
import API_URL from '../config';

const AddItemButton = ({ parentId, menuId }) => {
  const [name, setName] = useState('');
  const queryClient = useQueryClient();
  
  const mutation = useMutation(
    (newItem) => {
      return fetch(`${API_URL}/menus/${menuId}/items`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(newItem),
      });
    },
    {
      onSuccess: () => {
        queryClient.invalidateQueries(['menuItems', menuId]);
      },
    }
  );

  const handleAddItem = () => {
    mutation.mutate({ name, parent_id: parentId });
    setName('');
  };

  return (
    <div>
      <input 
        type="text" 
        value={name} 
        onChange={(e) => setName(e.target.value)} 
        placeholder="New Item Name" 
        className="border p-1"
      />
      <button onClick={handleAddItem} className="bg-blue-500 text-white p-1 ml-2">
        Add
      </button>
    </div>
  );
};

export default AddItemButton;
