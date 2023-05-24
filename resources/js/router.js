import { createRouter, createWebHistory } from 'vue-router';
import Home from './pages/Home.vue';
import AddEmployee from './pages/employees/AddEmployee.vue';
import EditEmployee from './pages/employees/EditEmployee.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/employee/add',
    name: 'add-employee',
    component: AddEmployee,
  },
  {
    path: '/employee/:id/edit',
    name: 'edit-employee',
    component: EditEmployee,
    props: true
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
