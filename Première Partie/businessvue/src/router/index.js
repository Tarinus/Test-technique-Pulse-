import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";

const routes = [
  {
    path: "/",
    name: "home",
    component: HomeView,
  },
  {
    path: "/signup",
    name: "SignUp",
    component: () => import("../components/SignUp.vue"),
  },
  {
    path: "/signin",
    name: "SignIn",
    component: () => import("../components/SignIn.vue"),
  },

  {
    path: "/profile",
    name: "DashBoard",
    component: () => import("../components/DashBoard.vue"),
  },

  {
    path: "/cards",
    name: "BusinessCard",
    component: () => import("../components/Card.vue"),
  },
  {
    path: "/addcard",
    name: "AddCard",
    component: () => import("../components/AddCard.vue"),
  },

  {
    path: "/about",
    name: "about",
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () =>
      import(/* webpackChunkName: "about" */ "../views/AboutView.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
