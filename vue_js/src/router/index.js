import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "../views/DashboardView.vue";
import LoginView from "@/views/LoginView.vue";
import CreateClientView from "@/views/CreateClientView.vue";

const routes = [
  {
    path: "/",
    name: "dashboard",
    component: Dashboard,
  },
  {
    path: "/login",
    name: "login",
    component: LoginView,
  },
  {
    path: "/create-client",
    name: "create_client",
    component: CreateClientView,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
