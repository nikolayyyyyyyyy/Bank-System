import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "../views/DashboardView.vue";
import CreateAccountView from "@/views/CreateAccountView.vue";
import CreateClientView from "@/views/CreateClientView.vue";
import CreateEmployeeView from "@/views/CreateEmployeeView.vue";
import CreateTransactionView from "@/views/CreateTransactionView.vue";
import LoginView from "@/views/LoginView.vue";

const routes = [
  {
    path: "/",
    name: "dashboard",
    component: Dashboard,
  },
  {
    path: "/create-account",
    name: "create_account",
    component: CreateAccountView,
  },
  {
    path: "/create-client",
    name: "create_client",
    component: CreateClientView,
  },
  {
    path: "/create-employee",
    name: "create_employee",
    component: CreateEmployeeView,
  },
  {
    path: "/create-transaction",
    name: "create_transaction",
    component: CreateTransactionView,
  },
  {
    path: "/login",
    name: "login",
    component: LoginView,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
