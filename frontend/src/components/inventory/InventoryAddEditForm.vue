<script setup>
import {onBeforeMount} from "vue";
import {storeToRefs} from "pinia";
import {useInventoryStore} from "../../stores/inventory.js";

const props = defineProps(['action', 'id'])
const store = useInventoryStore()
const {inventoryForm, inventories} = storeToRefs(store)
onBeforeMount(async () =>  {
    // inventories.value.length === 0 ? await store.getInventories() : ''

    if(props.id) {
        store.setInventory(props.id)
    }
});
</script>

<template>
    <div class="card shadow">
        <div class="card-body">
            <form @submit.prevent="store.handleSave(props.action, props.id)">
                <div class="row g-2 py-3">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" required id="name" v-model="inventoryForm.name"
                                   placeholder="Name">
                            <label for="name" >Name</label>
                            <Validation :error-text="store.getError('name')"/>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Description" id="description"
                                      v-model="inventoryForm.description"></textarea>
                            <label for="description">Description</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-info float-end"><i class="bi bi-floppy"></i>
                    Save
                </button>
            </form>
        </div>
    </div>
</template>

<style scoped>

</style>
