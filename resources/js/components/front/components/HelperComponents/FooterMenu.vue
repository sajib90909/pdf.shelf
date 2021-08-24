<template>
    <div class="d-flex align-content-center justify-content-between mt-5 p-4 bg-brand-light">
        <div class="align-self-center">
            <h1>Pdf | Shelf</h1>
        </div>
        <div class="align-self-center">
            <ul class="list-group list-group-flush">
                <router-link :to="{ name: 'home' }" class="list-group-item bg-brand-light">Home</router-link>
                <router-link v-if="loginUser" :to="{ name: 'profile', params: { id: loginUser.id } }" class="list-group-item bg-brand-light">My account</router-link>
                <a v-else :href="urlGenerator('login')" class="list-group-item bg-brand-light">Login</a>
                <router-link :to="{ name: 'books' }" class="list-group-item bg-brand-light">Browse all book</router-link>
            </ul>
        </div>
        <div class="align-self-center">
            <h6>Search by book name</h6>
            <div>
                <app-input
                    type="text"
                    add-class="form-control-sm mr-sm-2 mb-2"
                    v-model="formData.name"
                    id='book-name'
                    placeholder="Enter name"
                />
                <button type="submit" class="btn btn-primary btn-sm" @click="searchValue">Search</button>
            </div>
        </div>
    </div>
</template>

<script>
import {urlGenerator} from "../../../../core/helpers/AxiosHelper";

export default {
    name: "FooterMenu",
    data() {
        return {
            urlGenerator,
            formData: {}
        }
    },
    mounted() {
        //console.log(this.loginUser, 'blade')
    },
    computed: {
        loginUser() {
            return this.$store.state.Authenticate.user
        }
    },
    methods: {
        searchValue(){
            if(this.formData.name){
                this.$router.push({ name: 'books', query: { search: this.formData.name} })
                this.formData = {}
            }
        }
    }
}
</script>

<style scoped>

</style>
