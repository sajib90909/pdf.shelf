<template>
    <div class="d-flex justify-content-between">
        <div class="d-flex justify-content-start">
            <template v-for="filter in filters">
                <multi-search-select v-if="filter.type === 'multi-search-select'" :data="filter" />
            </template>
        </div>
        <search/>
    </div>
</template>

<script>
import multiSearchSelect from "./components/multiSearchSelect";
import search from "./components/search";

export default {
    name: "AppFilter",
    components: {multiSearchSelect, search},
    props: {
        filters: {
            required: true,
        }
    }
}
</script>

<style scoped>

</style>
