<template>
    <div>
        <div class="card m-4">
            <div class="card-body">
                <profile :id="userId" :admin-view="true"/>
            </div>
        </div>
    </div>
</template>

<script>
    import Profile from "./front/components/Profile";
    export default {
        name: 'AdminProfile',
        components: {Profile},
        mounted() {
            console.log('Component mounted.')
        },
        computed: {
            userId(){
                return this.$route.params.id
            }
        }
    }
</script>
