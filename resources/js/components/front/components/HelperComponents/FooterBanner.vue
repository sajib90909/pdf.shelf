<template>
    <div class="footer-banner-container mt-5">
        <img :src="urlGenerator('images/banner5.jpg')" class="" alt="...">
        <router-link to="books" class="btn btn-dark">Browser All Book <span class="ml-2"><i class="fas fa-long-arrow-alt-right"></i></span></router-link>
    </div>
</template>

<script>
import {urlGenerator} from "../../../../core/helpers/AxiosHelper";
export default {
    name: "FooterBanner",
    data() {
        return {
            urlGenerator
        }
    }
}
</script>

<style scoped>

</style>
