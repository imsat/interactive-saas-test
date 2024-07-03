import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';

// Import your components
import Login from './views/Login.vue';
import Register from './views/Register.vue';
import Home from './views/Home.vue';
import Inventory from './views/inventory/Inventory.vue';
import Profile from './views/Profile.vue';
import InventoryAdd from './views/inventory/InventoryAdd.vue';
import InventoryEdit from './views/inventory/InventoryEdit.vue';

// Extend the RouteMeta interface
declare module 'vue-router' {
    interface RouteMeta {
        title: string;
        guest?: boolean;
        requiresAuth?: boolean;
    }
}

// Define routes with meta properties
const routes: Array<RouteRecordRaw> = [
    { path: '/', name: 'home', component: Home, meta: { title: 'Home', guest: false, requiresAuth: true } },
    { path: '/login', name: 'login', component: Login, meta: { title: 'Login', guest: true } },
    { path: '/register', name: 'register', component: Register, meta: { title: 'Register', guest: true } },
    { path: '/profile', name: 'profile', component: Profile, meta: { title: 'Profile', requiresAuth: true } },
    { path: '/inventory', name: 'inventory', component: Inventory, meta: { title: 'Inventory list', requiresAuth: true } },
    { path: '/inventory/add', name: 'inventoryAdd', component: InventoryAdd, meta: { title: 'Inventory Add', requiresAuth: true } },
    { path: '/inventory/edit/:id', name: 'inventoryEdit', component: InventoryEdit, meta: { title: 'Inventory Edit', requiresAuth: true } },
];

// Create the router
const router = createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass: 'link-secondary'
});

// Navigation guard to handle authentication
router.beforeEach((to, _, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (localStorage?.getItem('token')) {
            next();
            return;
        }
        next('/login');
    } else {
        next();
    }
    document.title = `${to.meta.title}`;
});

// Navigation guard to handle guest routes
router.beforeEach((to, _, next) => {
    if (to.matched.some(record => record.meta.guest)) {
        if (localStorage?.getItem('token')) {
            next('/');
            return;
        }
        next();
    } else {
        next();
    }
    document.title = `${to.meta.title}`;
});

export default router;
