import { createRouter, createWebHistory } from "vue-router";
import NotFound from "../components/NotFound.vue";
import Player from "../components/Player/index.vue";
import Lines from "../components/LineUp/Lines.vue";
import Formations from "../components/Formation/Formations.vue";
import CreateForm from "../components/Formation/CreateForm.vue";
import DefaultLayout from '../layout/Layout.vue';
const routes = [
    {
        path: '/',
        component: DefaultLayout,
        children: [
          {
            path: 'player',
            components: {
              content: Player,
            },
          },
          {
            path: 'lines',
            components: {
              content: Lines,
            },
          },
          {
            path: 'formations',
            components: {
              content: Formations,
            },
          },
          {
            path: 'formations/create',
            components: {
              content: CreateForm,
            },
          },
        ],
    },
    {
        path: "/:pathMatch(.*)*",
        component: NotFound,
    },
  /*   {
        path: "/player",
        component: Player,
        meta: { layout: DefaultLayout },
    },
    {
        path: "/lines",
        component: Lines,
        meta: { layout: DefaultLayout },
    },
    {
        path: "/formations",
        component: Formations,
        meta: { layout: DefaultLayout },
    }, */
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});
export default router;
