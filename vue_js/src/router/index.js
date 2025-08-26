import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import AccountTransactionsView from "@/views/AccountTransactionsView.vue";
import ClientAccountsView from "@/views/ClientAccountsView.vue";
import ClientTransactionView from "@/views/ClientTransactionView.vue";
import CreateAccountView from "@/views/CreateAccountView.vue";
import CreateClientView from "@/views/CreateClientView.vue";
import CreateEmployeeView from "@/views/CreateEmployeeView.vue";
import CreateTransactionView from "@/views/CreateTransactionView.vue";
import EmployeeTransactionView from "@/views/EmployeeTransactionView.vue";
import LoginView from "@/views/LoginView.vue";
import TransactionForPeriodView from "@/views/TransactionForPeriodView.vue";
import TransactionsOfTypeView from "@/views/TransactionsOfTypeView.vue";

const routes = [
  {
    path: "/",
    name: "home",
    component: HomeView,
  },
  {
    path: "/account-transactions",
    name: "account_transactions",
    component: AccountTransactionsView,
  },
  {
    path: "/client-accounts",
    name: "client_accounts",
    component: ClientAccountsView,
  },
  {
    path: "/client-transactions",
    name: "client_transactions",
    component: ClientTransactionView,
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
    path: "/employee-transactions",
    name: "employee_transactions",
    component: EmployeeTransactionView,
  },
  {
    path: "/login",
    name: "login",
    component: LoginView,
  },
  {
    path: "/transactions-for-period",
    name: "transactions_for_period",
    component: TransactionForPeriodView,
  },
  {
    path: "/transactions-of-type",
    name: "transactions-of-type",
    component: TransactionsOfTypeView,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
