import {createRouter, createWebHistory} from "vue-router";

import Home from '../pages/home/Home.vue'
import Login from '../pages/login/Login.vue'
import Register from '../pages/register/Register.vue'
import Profile from '../pages/profile/Profile.vue'
import Inventory from '../pages/inventory/Inventory.vue'
import InventoryAdd from "../pages/inventory/InventoryAdd.vue";
import InventoryEdit from "../pages/inventory/InventoryEdit.vue";
import InventoryItem from "../pages/inventory-item/InventoryItem.vue";
import InventoryItemAdd from "../pages/inventory-item/InventoryItemAdd.vue";
import InventoryItemEdit from "../pages/inventory-item/InventoryItemEdit.vue";

const routes = [
    {path: '/', name: 'home', component: Home},
    {path: '/login', name: 'login', component: Login, meta: {guest: true}},
    {path: '/register', name: 'register', component: Register, meta: {guest: true}},
    {path: '/profile', name: 'profile', component: Profile, meta: {requiresAuth: true}},
    {path: '/inventory', name: 'inventory', component: Inventory, meta: {requiresAuth: true}},
    {path: '/inventory/add', name: 'inventoryAdd', component: InventoryAdd, meta: {requiresAuth: true}},
    {path: '/inventory/edit/:id', name: 'inventoryEdit', component: InventoryEdit, meta: {requiresAuth: true}},
    {path: '/inventory/:inventoryId/inventory-item', name: 'inventoryItem', component: InventoryItem, meta: {requiresAuth: true}},
    {path: '/inventory/:inventoryId/inventory-item/add', name: 'inventoryItemAdd', component: InventoryItemAdd, meta: {requiresAuth: true}},
    {path: '/inventory/:inventoryId/inventory-item/:id/edit', name: 'inventoryItemEdit', component: InventoryItemEdit, meta: {requiresAuth: true}},
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass: 'link-secondary'
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

