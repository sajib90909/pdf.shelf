<template>
    <select
        :id="inputFieldId"
        :disabled="data.disabled"
        ref="select"
        :class="'form-control custom-select' + data.inputClass"
        v-bind:value="value" v-on="listeners"
    >
        <template v-for="item in options">
            <option :value="item.id" :selected="!item.id || item.id == value" :key="item.id">{{ item[data.listValueField] }}</option>
        </template>

    </select>
</template>

<script>
import InputMixin from "../../../helpers/InputMixin";
import SelectableFetchUrlMixin from "../../../helpers/SelectableFetchUrlMixin";

export default {
    name: "selectInput",
    mixins: [InputMixin, SelectableFetchUrlMixin],
    data() {
        return {
            selectAbleOptions: {}
        }
    },
    computed: {
        options() {
            return this.data.options || this.selectAbleOptions
        }
    }
}
</script>

<style scoped>

</style>
