<script>
import {toast} from "vue3-toastify";

export default {
    name: "InventoryItemForm",
    props: {
        operation: {
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
        handleSubmit() {
            // Form data
            let itemData = new FormData();
            itemData.append('name', this.inventoryItemForm.name);
            itemData.append('quantity', this.inventoryItemForm.quantity);
            itemData.append('description', this.inventoryItemForm.description);
            itemData.append('image', this.inventoryItemForm.image);

            let apiUrl = `/inventories/${this.inventoryId}/inventoryItems`
            if (this.inventoryId && this.id) {
                apiUrl = `/inventories/${this.inventoryId}/inventoryItems/${this.id}`
                itemData.append('_method','PUT');
            }

            this.isLoading = true

            axios.post(apiUrl, itemData).then(res => {
                this.inventoryItemForm = {}
                this.$router.push(`/inventory/${this.inventoryId}/item`).then(() => toast(res?.data?.message))
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
    <div class="form-crud w-100 m-auto">
        <div class="mb-2">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" placeholder="Name" v-model="inventoryItemForm.name">
            <span class="text-danger" v-if="getError('name')">{{ getError('name') }}</span>
        </div>
        <div class="mb-2">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" placeholder="Quantity" v-model="inventoryItemForm.quantity">
            <span class="text-danger" v-if="getError('quantity')">{{ getError('quantity') }}</span>
        </div>
        <div class="mb-2">
            <label for="image" class="form-label">Image</label>
            <input class="form-control" type="file" id="image" @change="(e) => inventoryItemForm.image = e.target.files[0]">
            <span class="text-danger" v-if="getError('image')">{{ getError('image') }}</span>
            <img :src="inventoryItemForm.show_image" class="img-fluid w-25 mt-1" alt="Item image" v-if="inventoryItemForm.show_image">
        </div>
        <div class="mb-2">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" rows="3" placeholder="Description"
                      v-model="inventoryItemForm.description"></textarea>
            <span class="text-danger" v-if="getError('description')">{{ getError('description') }}</span>
        </div>

        <button type="button" class="btn btn-primary my-2 ml-auto" @click.prevent="handleSubmit">Submit</button>
    </div>
</template>

<style scoped>

</style>
