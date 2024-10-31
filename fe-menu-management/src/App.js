import React from 'react';
import MenuForm from './components/MenuForm';
import MenuList from './components/MenuList';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { RecoilRoot } from 'recoil';

const queryClient = new QueryClient();

const App = () => {
  return (
    <RecoilRoot>
      <QueryClientProvider client={queryClient}>
        <div className="container mx-auto p-4">
          <h1 className="text-2xl font-bold mb-4">Menu Management System</h1>
          <MenuForm />
          <MenuList />
        </div>
      </QueryClientProvider>
    </RecoilRoot>
  );
};

export default App;
