import React from 'react';
import { useMenus } from '../hooks/useMenus';
import MenuItem from './MenuItem';

const MenuList = () => {
  const { data: menus } = useMenus();

  return (
    <div>
      {menus && menus.map(menu => (
        <div key={menu.id} className="mb-4">
          <h2 className="text-xl font-bold">{menu.name}</h2>
          <MenuItem menuId={menu.id} />
        </div>
      ))}
    </div>
  );
};

export default MenuList;
