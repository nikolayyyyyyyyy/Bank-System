import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "../views/DashboardView.vue";
import LoginView from "@/views/LoginView.vue";
import CreateClientView from "@/views/client/CreateClientView.vue";
import CreateEmployeeView from "@/views/employee/CreateEmployeeView.vue";
import CreateAccountView from "@/views/account/CreateAccountView.vue";
import CreateTransactionView from "@/views/transaction/CreateTransactionView.vue";
import AllClientsView from "@/views/client/AllClientsView.vue";

const routes = [
  {
    path: "/",
    component: Dashboard,
  },
  {
    path: "/login",
    component: LoginView,
  },
  {
    path: "/create-client",
    component: CreateClientView,
  },
  {
    path: "/create-employee",
    component: CreateEmployeeView,
  },
  {
    path: "/create-account",
    component: CreateAccountView,
  },
  {
    path: "/create-transaction",
    component: CreateTransactionView,
  },
  {
    path: "/all-clients",
    component: AllClientsView,
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
