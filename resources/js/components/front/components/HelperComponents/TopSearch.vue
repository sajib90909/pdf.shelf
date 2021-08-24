<template>
    <div>
        <div class="form-inline">
            <app-input
                type="text"
                add-class="form-control-sm mr-sm-2"
                v-model="formData.name"
                id='book-name'
                placeholder="Enter name"
            />
            <button class="btn btn-outline-success my-2 my-sm-0 btn-sm" @click="searchValue">Search</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "TopSearch",
    data() {
        return {
            formData: {}
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
