import {createRouter, createWebHistory} from "vue-router";

import Dashboard from './pages/dashboard/Dashboard.vue'
import Login from './pages/login/Login.vue'
import Register from './pages/register/Register.vue'
import Inventory from './pages/inventory/Inventory.vue'
import InventoryItem from './pages/inventory-item/InventoryItem.vue'
import inventoryCreate from "./pages/inventory/InventoryCreate.vue";
import inventoryUpdate from "./pages/inventory/InventoryUpdate.vue";
import inventoryItemCreate from "./pages/inventory-item/InventoryItemCreate.vue";
import inventoryItemUpdate from "./pages/inventory-item/InventoryItemUpdate.vue";

const routes = [
    {path: '/', name: 'dashboard', component: Dashboard, meta: {requiresAuth: true}},
    {path: '/login', name: 'login', component: Login, meta: {guest: true}},
    {path: '/register', name: 'register', component: Register, meta: {guest: true}},
    {path: '/inventory', name: 'inventory', component: Inventory, meta: {requiresAuth: true}},
    {path: '/inventory/create', name: 'inventoryCreate', component: inventoryCreate, meta: {requiresAuth: true}},
    {path: '/inventory/update/:id', name: 'inventoryUpdate', component: inventoryUpdate, meta: {requiresAuth: true}},
    {path: '/inventory/:inventoryId/item', name: 'inventoryItem', component: InventoryItem, meta: {requiresAuth: true}},
    {path: '/inventory/:inventoryId/item/create', name: 'inventoryItemCreate', component: inventoryItemCreate, meta: {requiresAuth: true}},
    {path: '/inventory/:inventoryId/item/:id/update', name: 'inventoryItemUpdate', component: inventoryItemUpdate, meta: {requiresAuth: true}},
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass: 'link-info'
})

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (localStorage?.getItem('token')) {
            next();
            return;
        }
        next("/login");
    } else {
        next();
    }
});

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.guest)) {
        if (localStorage?.getItem('token')) {
            next("/");
            return;
        }
        next();
    } else {
        next();
    }
});


export default router;

