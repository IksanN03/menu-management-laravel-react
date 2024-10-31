import { useQuery } from '@tanstack/react-query';
import API_URL from '../config';
import { useSetRecoilState } from 'recoil';
import { menuState } from '../state/menuState';

export const useMenus = () => {
  const setMenus = useSetRecoilState(menuState);

  return useQuery('menus', async () => {
    const response = await fetch(`${API_URL}/menus`);
    const data = await response.json();
    setMenus(data);
    return data;
  });
};
