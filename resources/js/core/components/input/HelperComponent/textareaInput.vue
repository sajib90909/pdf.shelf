<template>
    <textarea
        :type="data.type"
        :id="inputFieldId"
        :name="$parent.name"
        :required="data.required"
        :class="'form-control custom-scrollbar ' + data.inputClass"
        :placeholder="data.placeholder"
        :readonly="data.readOnly"
        :disabled="data.disabled"
        :rows="data.textAreaRows"
        :cols="data.textAreaCols"
        :minlength="data.minlength"
        :maxlength="data.maxlength"
        v-bind:value="value"
        v-on="listeners">
    </textarea>
</template>

<script>
import InputMixin from "../../../helpers/InputMixin";

export default {
    name: "textareaInput",
    mixins: [InputMixin]
}
</script>

<style scoped>

</style>
