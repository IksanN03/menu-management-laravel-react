import { useQuery } from '@tanstack/react-query';
import API_URL from '../config';

export const useMenuItems = (menuId) => {
  return useQuery(['menuItems', menuId], async () => {
    const response = await fetch(`${API_URL}/menus/${menuId}/items`);
    return response.json();
  });
};
