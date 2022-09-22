import { createRouter, createWebHistory } from "vue-router";
import routes from "./routes";

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior: (to, from, savedPosition) => {
        return { 
            top: 0,
            behavior: 'smooth' // Afin de rendre le défilement fluide
        }
    }
});

export default router;
