import {defineStore} from 'pinia'
import {del, get, getWithParams, post} from "../utils/fetchAPI.js";
import {errorToast, successToast, confirm} from "../utils/swalUtil.js";

export const useInventoryStore = defineStore('inventory', {
    state: () => {
        return {
            errors: [],
            inventories: [],
            pagination: {},
            inventory: {},
            inventoryForm: {
                email: '',
                password: '',
            },
        }
    },
    getters: {
        getError: (state) => {
            return (key) => !!state.errors && state.errors[key] !== undefined ? state.errors[key][0] : null
        },
    },
    actions: {
        async getInventories(page = 1) {
            const payload = {page}
            await getWithParams('/inventories', payload)
                .then(res => {
                    let {data, ...rest} = res?.data?.data
                    this.inventories = data
                    this.pagination = rest
                })
        },
        async setInventory(id) {
            let inventory = this.inventories.find(inventory => inventory.id === id);
            if(!inventory){
                await get(`/inventories/${id}`)
                    .then(res => {
                        inventory = res.data.data
                    })
            }

            if (inventory) {
                this.inventoryForm.name = inventory.name
                this.inventoryForm.description = inventory.description
            }
        },
        async handleSave(action = 'add', id = null) {
            let apiUrl = `/inventories`
            if (action === 'edit') {
                apiUrl = `/inventories/${id}`
                this.inventoryForm._method = 'PUT'

                if (!id) {
                    errorToast('Something went wrong')
                    return;
                }
            }

            await post(apiUrl, this.inventoryForm)
                .then(res => {
                    const data = res?.data?.data;
                    if(action === 'edit'){
                        this.updateInventory(id, data)
                    }else{
                        this.inventories.unshift(data)
                    }
                    this.inventoryForm = {}
                    successToast(res?.data?.message)
                    this.router.push('/inventory')
                }).catch(err => {
                    const {errors, message} = err?.response?.data
                    errorToast(message)
                    this.errors = errors
                })
        },
        updateInventory(id, updatedData) {
            const index = this.inventories.findIndex(inventory => inventory.id === id);
            if (index !== -1) {
                this.inventories[index] = { ...updatedData };
            }
        },
        async deleteInventory(id) {
            const result = await confirm();
            if (result.value) {
                await del(`/inventories/${id}`)
                    .then(res => {
                        successToast(res?.data?.message)
                        this.inventories = this.inventories.filter(inventory => inventory.id !== id);
                    })
            }
        }
    }
})
