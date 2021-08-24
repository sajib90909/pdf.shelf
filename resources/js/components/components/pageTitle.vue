<template>
    <div class="d-flex justify-content-between m-4">
        <h2>{{ title }}</h2>
        <button v-if="btnTitle" class="btn btn-primary" @click="buttonClick">{{ btnTitle }}</button>
    </div>
</template>

<script>
export default {
    name: "pageTitle",
    props: {
        btnTitle: {},
        title: {}
    },
    methods: {
        buttonClick() {
            this.$emit('buttonAction')
        }
    }
}
</script>

<style scoped>

</style>
