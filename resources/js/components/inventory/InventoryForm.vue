<script>
import {toast} from "vue3-toastify";

export default {
    name: "InventoryForm",
    props: {
        operation: {
            type: String,
            required: true
        },
        id: {
            type: String,
            required: false
        },
    },
    data() {
        return {
            isLoading: false,
            inventoryForm: {
                name: '',
                description: ''
            },
            errors: [],
        }
    },
    created() {
        if (this.id) {
            this.getInventory()
        }
    },
    methods: {
        handleSubmit() {
            let apiUrl = `/inventories`
            if (this.id) {
                apiUrl = `/inventories/${this.id}`
                this.inventoryForm._method = 'PUT'
            }
            this.isLoading = true
            axios.post(apiUrl, this.inventoryForm).then(res => {
                this.inventoryForm = {}
                this.$router.push('/inventory').then(() => toast(res?.data?.message))
            }).catch(errors => {
                this.setError(errors.response.data.errors);
            }).finally(() => this.isLoading = false)
        },
        getInventory() {
            this.isLoading = true
            axios.get(`/inventories/${this.id}`).then(res => {
                const {name, description} = res.data.data
                this.inventoryForm.name = name
                this.inventoryForm.description = description
            }).catch(errors => {
                this.setError(errors.response.data.errors);
            }).finally(() => this.isLoading = false)
        },
        setError(errors) {
            return this.errors = errors;
        },
        getError(key) {
            return !!this.errors && this.errors[key] !== undefined ? this.errors[key][0] : null;
        },
    }
}
</script>

<template>
    <div class="form-crud w-100 m-auto">
        <div class="mb-2">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Name" v-model="inventoryForm.name">
            <span class="text-danger" v-if="getError('name')">{{ getError('name') }}</span>
        </div>
        <div class="mb-2">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" rows="3" placeholder="Description"
                      v-model="inventoryForm.description"></textarea>
            <span class="text-danger" v-if="getError('description')">{{ getError('description') }}</span>
        </div>

        <button type="button" class="btn btn-primary my-2 ml-auto" @click.prevent="handleSubmit">Submit</button>
    </div>
</template>

<style scoped>

</style>
