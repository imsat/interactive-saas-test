<script>
import {errorToast, successToast} from "../../bootstrap.js";
import Pagination from "../Pagination.vue";
import PageHeading from "../PageHeading.vue";
import Spinner from "../Spinner.vue";

export default {
    name: "InventoryItemAddEditForm",
    components: {Spinner, PageHeading, Pagination},
    props: {
        action: {
            type: String,
            required: true
        },
        inventoryId: {
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
            inventoryItemForm: {
                name: '',
                quantity: '',
                description: '',
                image: '',
                show_image: ''
            },
            errors: [],
        }
    },
    created() {
        if (this.inventoryId && this.id) {
            this.getInventoryItem()
        }
    },
    methods: {
        handleImage(e) {
            this.inventoryItemForm.image = e.target.files[0]
        },
        handleSave() {
            let formBody = new FormData();
            formBody.append('name', this.inventoryItemForm.name);
            formBody.append('quantity', this.inventoryItemForm.quantity);
            formBody.append('description', this.inventoryItemForm.description);
            formBody.append('image', this.inventoryItemForm.image);

            let apiUrl = `/inventories/${this.inventoryId}/inventoryItems`
            if (this.action === 'edit') {
                apiUrl = `/inventories/${this.inventoryId}/inventoryItems/${this.id}`
                formBody.append('_method','PUT');

                if (!this.id || !this.inventoryId) {
                    errorToast('Something went wrong')
                    return;
                }
            }
            this.isLoading = true
            axios.post(apiUrl, formBody).then(res => {
                this.inventoryItemForm = {}
                this.$router.push(`/inventory/${this.inventoryId}/inventory-item`).then(() => successToast(res?.data?.message))

            }).catch(errors => {
                this.setError(errors.response.data.errors);
            }).finally(() => this.isLoading = false)
        },
        getInventoryItem() {
            this.isLoading = true
            axios.get(`/inventories/${this.inventoryId}/inventoryItems/${this.id}`).then(res => {
                const {name, description, quantity, image} = res.data.data
                this.inventoryItemForm.name = name
                this.inventoryItemForm.quantity = quantity
                this.inventoryItemForm.show_image = image
                this.inventoryItemForm.description = description
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
    <div class="card shadow">
        <div class="card-body">
            <Spinner v-if="isLoading"/>
            <form @submit.prevent="handleSave">
                <div class="row g-2 pt-3">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" required id="name" v-model="inventoryItemForm.name"
                                   placeholder="Name">
                            <label for="name">Name</label>
                            <Validation :error-text="getError('name')"/>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" required id="quantity" v-model="inventoryItemForm.quantity"
                                   placeholder="Name">
                            <label for="quantity">Quantity</label>
                            <Validation :error-text="getError('quantity')"/>
                        </div>
                    </div>
                </div>
                <div class="row g-2 pb-3">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input class="form-control" type="file" :required="action !== 'edit'" id="image" @change="handleImage">
                            <label for="image">Image</label>
                            <Validation :error-text="getError('image')"/>
                            <img :src="inventoryItemForm.show_image" class="img-fluid w-25 mt-1" alt="Item image" v-if="inventoryItemForm.show_image">
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Description" id="description"
                                      v-model="inventoryItemForm.description"></textarea>
                            <label for="description">Description</label>
                            <Validation :error-text="getError('description')"/>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-info float-end" :disabled="isLoading"><i class="bi bi-floppy"></i>
                    Save
                </button>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
