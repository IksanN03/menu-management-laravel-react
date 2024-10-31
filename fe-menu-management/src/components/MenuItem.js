import React from 'react';
import { useMenuItems } from '../hooks/useMenuItems';
import AddItemButton from './AddItemButton';

const MenuItem = ({ menuId }) => {
  const { data: items } = useMenuItems(menuId);

  return (
    <ul className="ml-4">
      {items && items.map(item => (
        <li key={item.id}>
          {item.name}
          <AddItemButton parentId={item.id} menuId={menuId} />
          {item.children && item.children.length > 0 && (
            <MenuItem menuId={menuId} parentId={item.id} />
          )}
        </li>
      ))}
    </ul>
  );
};

export default MenuItem;
