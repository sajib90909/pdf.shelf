<template>
    <div class="custom-file">
        <input type="file"
               class="custom-file-input"
               :id="inputFieldId"
               :disabled="data.disabled"
               v-on="listeners">
        <label class="custom-file-label" :for="inputFieldId">
            {{ fileLabel }}
        </label>
    </div>
</template>

<script>
import InputMixin from "../../../helpers/InputMixin";

export default {
    name: "fileInput",
    mixins: [InputMixin],
    computed: {
        fileLabel() {
            if(this.value && this.fieldValue && this.fieldValue === this.value)
                return this.value?.name ? this.value.name : this.data.label;
            else return this.data.label;
        }
    }
}
</script>

<style scoped>

</style>
