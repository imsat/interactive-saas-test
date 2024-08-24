<script>
export default {
    name: "Sidebar",
    methods: {
         logout(){
             axios.post('/logout', this.loginForm).then(res => {
                localStorage?.removeItem('token')
                localStorage?.removeItem('user')
                this.$router.push('/login')
                location.reload() //Need to work on this #solution pinia or https://stackoverflow.com/questions/63471824/vue-js-3-event-bus
            })
        }
    }
}
</script>
<template>
    <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
        <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="sidebarMenuLabel">Interactive Care</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link d-flex align-items-center gap-2 active" aria-current="page">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/inventory" class="nav-link d-flex align-items-center gap-2" href="#">
                            <i class="bi bi-box2"></i>
                            Inventory
                        </router-link>
                    </li>
<!--                    <li class="nav-item">-->
<!--                        <router-link to="/inventory-item" class="nav-link d-flex align-items-center gap-2" href="#">-->
<!--                            <i class="bi bi-boxes"></i>-->
<!--                            Inventory Item-->
<!--                        </router-link>-->
<!--                    </li>-->
                    <hr class="my-3">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" @click="logout" href="javascript:void(0)"><i class="bi bi-x-octagon"></i>
                            Sign out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style scoped>

.sidebar {
    min-height: 100vh;
}
</style>
