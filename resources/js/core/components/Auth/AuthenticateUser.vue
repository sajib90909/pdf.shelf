<template>
    <div></div>
</template>

<script>
export default {
    name: "AuthenticateUser",
    mounted() {
        this.$store.dispatch('getUserInformation')
    },
}
</script>

<style scoped>

</style>
