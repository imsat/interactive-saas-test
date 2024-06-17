import {createRouter, createWebHistory} from "vue-router";

import Login from './views/Login.vue';
import Register from './views/Register.vue';
import Home from "./views/Home.vue";
import Inventory from './views/inventory/Inventory.vue';
import Profile from "./views/Profile.vue";
// import CreateInventory from "./views/inventory/CreateInventory.vue";
// import UpdateInventory from "./views/inventory/UpdateInventory.vue";
// import InventoryItem from './views/inventory-item/Items.vue';
// import inventoryItemCreate from "./views/inventory-item/ItemCreate.vue";
// import inventoryItemUpdate from "./views/inventory-item/ItemUpdate.vue";

const routes = [
    {path: '/', name: 'home', component: Home, meta: {title: 'Home', guest: false, requiresAuth: true}},
    {path: '/login', name: 'login', component: Login, meta: {title: 'Login', guest: true}},
    {path: '/register', name: 'register', component: Register, meta: {title: 'Register', guest: true}},
    {path: '/profile', name: '/profile', component: Profile, meta: {title: 'Profile', requiresAuth: true}},
    {path: '/inventory', name: 'inventory', component: Inventory, meta: {title: 'Inventory list', requiresAuth: true}},
    // {path: '/inventory/create', name: 'createInventory', component: CreateInventory, meta: {title: 'Create Inventory', requiresAuth: true}},
    // {path: '/inventory/update/:id', name: 'UpdateInventory', component: UpdateInventory, meta: {title: 'Update Inventory', requiresAuth: true}},
    // {path: '/inventory/:inventoryId/item', name: 'inventoryItem', component: InventoryItem, meta: {title: 'Inventory item', requiresAuth: true}},
    // {path: '/inventory/:inventoryId/item/create', name: 'inventoryItemCreate', component: inventoryItemCreate, meta: {title: 'Inventory item create', requiresAuth: true}},
    // {path: '/inventory/:inventoryId/item/:id/update', name: 'inventoryItemUpdate', component: inventoryItemUpdate, meta: {title: 'Inventory item update', requiresAuth: true}},
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
    document.title = `${to.meta.title}`
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
    document.title = `${to.meta.title}`
});


export default router;
