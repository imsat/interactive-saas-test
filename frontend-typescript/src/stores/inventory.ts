import { defineStore } from 'pinia';
import { del, get, getWithParams, post } from "../utils/fetchAPI.js";
import { errorToast, successToast, confirm } from "../utils/swalUtil.js";

interface Inventory {
    id: number;
    name: string;
    description: string;
    // Add more properties as needed
}

interface InventoryForm {
    name: string;
    description: string;
    // Add more properties as needed
}

interface Pagination {
    current_page: number;
    // first_page_url: string;
    // from: number;
    // last_page: number;
    // last_page_url: string;
    // links: string[];
    // next_page_url: string;
    // path: string;
    per_page: number;
    // prev_page_url: string;
    // to: string;
    total: number;
}

interface InventoryState {
    errors: Record<string, string[]>;
    inventories: Inventory[];
    pagination: Pagination;
    inventory: Inventory | null; // Make sure inventory can be null
    inventoryForm: InventoryForm;
}

export const useInventoryStore = defineStore('inventory', {
    state: (): InventoryState => ({
        errors: {},
        inventories: [],
        pagination: {
            current_page: 1,
            per_page: 10,
            total: 0,
        },
        inventory: null,
        inventoryForm: {
            name: '',
            description: '',
        },
    }),
    getters: {
        // getError: (state) => (key: string) => {
        //     return !!state.errors && state.errors[key] !== undefined ? state.errors[key][0] : null;
        // },
        getError: (state: InventoryState) => (key: string): string | null => {
            return state.errors[key]?.[0] ?? null;
        },
    },
    actions: {
        async getInventories(this: any, page = 1) {
            const payload = { page };
            await getWithParams('/inventories', payload)
                .then(res => {
                    let { data, ...rest } = res?.data?.data;
                    this.inventories = data;
                    this.pagination = rest;
                });
        },
        async setInventory(this: any, id: number) {
            let inventory = this.inventories.find((inventory: Inventory) => inventory.id === id);
            if (!inventory) {
                await get(`/inventories/${id}`)
                    .then(res => {
                        inventory = res.data.data;
                    });
            }

            if (inventory) {
                this.inventoryForm.name = inventory.name;
                this.inventoryForm.description = inventory.description;
            }
        },
        async handleSave(this: any, action: 'add' | 'edit' = 'add', id: number | null = null) {
            let apiUrl = `/inventories`;
            if (action === 'edit') {
                apiUrl = `/inventories/${id}`;
                this.inventoryForm._method = 'PUT';

                if (!id) {
                    errorToast('Something went wrong');
                    return;
                }
            }

            await post(apiUrl, this.inventoryForm)
                .then(res => {
                    const data = res?.data?.data;
                    if (action === 'edit') {
                        this.updateInventory(id, data);
                    } else {
                        this.inventories.unshift(data);
                    }
                    this.inventoryForm = {} as InventoryForm;
                    successToast(res?.data?.message);
                    this.router.push('/inventory');
                })
                // .catch(err => {
                //     const { errors, message } = err?.response?.data;
                //     errorToast(message);
                //     this.errors = errors;
                // });
        },
        updateInventory(this: any, id: number, updatedData: Inventory) {
            const index = this.inventories.findIndex((inventory: Inventory) => inventory.id === id);
            if (index !== -1) {
                this.inventories[index] = { ...updatedData };
            }
        },
        async deleteInventory(this: any, id: number) {
            const result = await confirm();
            if (result.value) {
                await del(`/inventories/${id}`)
                    .then(res => {
                        successToast(res?.data?.message);
                        this.inventories = this.inventories.filter((inventory: Inventory) => inventory.id !== id);
                    });
            }
        }
    }
});
