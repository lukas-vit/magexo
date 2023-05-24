import { createRouter, createWebHistory } from 'vue-router';
import Home from './pages/Home.vue';
import AddEmployee from './pages/employees/AddEmployee.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/add-employee',
    name: 'add-employee',
    component: AddEmployee,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
