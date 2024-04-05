<script>
import {successToast} from "../../bootstrap.js";
import Pagination from "../Pagination.vue";
import PageHeading from "../PageHeading.vue";
export default {
    name: "InventoryAddEditForm",
    components: {PageHeading, Pagination},
    props: {
        action: {
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
        handleSave() {
            let apiUrl = `/inventories`
            if (this.id) {
                apiUrl = `/inventories/${this.id}`
                this.inventoryForm._method = 'PUT'
            }
            this.isLoading = true
            axios.post(apiUrl, this.inventoryForm).then(res => {
                this.inventoryForm = {}
                this.$router.push('/inventory').then(() => successToast(res?.data?.message))
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
    <div class="d-flex justify-content-center">
    <div class="card shadow w-50">
        <div class="card-body">
            <form @submit.prevent="handleSave">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" required id="name" v-model="inventoryForm.name" placeholder="Name">
                    <label for="name">Name</label>
                    <Validation :error-text="getError('name')" />
                </div>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Description" id="description" v-model="inventoryForm.description"></textarea>
                    <label for="description">Description</label>
                    <Validation :error-text="getError('description')" />
                </div>
                <button type="submit" class="btn btn-sm btn-primary py-2 my-3 float-end"><i class="bi bi-floppy"></i> Save</button>
            </form>
        </div>
    </div>
    </div>
</template>

<style scoped>

</style>
