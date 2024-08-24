<script>
import PrivateLayout from "./layouts/PrivateLayout.vue";
import PublicLayout from "./layouts/PublicLayout.vue";
export default {
    components: {
        PrivateLayout,
        PublicLayout,
    },
    data() {
        return {
            token: localStorage.getItem('token')
        }
    }
}
</script>

<template>
    <PrivateLayout v-if="token">
        <router-view/>
    </PrivateLayout>
    <PublicLayout v-else>
        <router-view/>
    </PublicLayout>
</template>

<style scoped>

</style>
