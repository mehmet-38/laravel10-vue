import {createRouter, createWebHistory} from 'vue-router';
import axios from 'axios';

const routes = [
    {
        path: '/',
        component: () => import('./Pages/Home.vue'),
    },
    {
        path: '/login',
        component: () => import('./Pages/Login.vue'),
    },
    {
        path: '/register',
        component: () => import('./Pages/Register.vue'),
    },
    {
        path: '/manager/messages',
        component: () => import('./Pages/Messages.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Route guard ekliyoruz
router.beforeEach(async (to, from, next) => {

    const requiresAuth = to.path.startsWith('/manager');

    if (requiresAuth) {
        try {
            const response = await axios.get('/api/user');

            if (response.data) {
                next();
            }
        } catch (error) {
            next('/login');
        }
    } else {
        next();
    }
});

export default router;
