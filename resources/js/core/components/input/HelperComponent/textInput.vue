<template>
    <input :type="data.type"
           :name="$parent.name"
           :id="inputFieldId"
           :required="data.required"
           :class="'form-control '+data.inputClass+' '+data.addClass"
           :maxlength="data.maxLength"
           :minlength="data.minlength"
           :placeholder="data.placeholder"
           :readonly="data.readOnly"
           :disabled="data.disabled"
           v-bind:value="value"
           v-on="listeners"
    />
</template>

<script>
import InputMixin from "../../../helpers/InputMixin";

export default {
    name: "textInput",
    mixins: [InputMixin],
}
</script>

<style scoped>

</style>
