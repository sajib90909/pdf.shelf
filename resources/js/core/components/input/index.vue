<template>
    <div>
        <div :class="title ? `form-group ${page === 'page' ? 'row' : ''}` : ''">
            <label v-if="title" :class="page === 'page' ? 'col-sm-2 col-form-label' : ''"
                :for="id || $vnode.data.model.expression">{{ title }}</label>

            <div :class="title ? `${page === 'page' ? 'col-sm-10' : ''}`  : ''">
                <radio-input v-if="type === 'radio'" :data="$props" :id="id || $vnode.data.model.expression"/>
                <select-input v-if="type === 'select'" :data="$props" :value="value" v-on="$listeners" :id="id || $vnode.data.model.expression"/>
                <textarea-input v-if="type === 'textarea'" :data="$props" :value="value" v-on="$listeners" :id="id || $vnode.data.model.expression"/>
                <text-input v-if="type === 'text'" :data="$props" :value="value" v-on="$listeners" :id="id || $vnode.data.model.expression"/>
                <file-input v-if="type === 'file'" :data="$props" :value="value" v-on="$listeners" :id="id || $vnode.data.model.expression"/>
                <small v-if="errorMessage" class="form-text text-danger">{{ errorMessage }}</small>
                <small v-if="bottomNote && title" class="form-text text-muted">{{ bottomNote }}</small>
            </div>

        </div>

    </div>
</template>

<script>
import radioInput from "./HelperComponent/radioInput";
import selectInput from "./HelperComponent/selectInput";
import textareaInput from "./HelperComponent/textareaInput";
import textInput from "./HelperComponent/textInput";
import fileInput from "./HelperComponent/fileInput";

export default {
    name: "AppInput",
    components: {radioInput,selectInput,textareaInput,textInput,fileInput},
    props: {
        title: {},
        page: {
            type: String,
            default: 'modal'
        },
        value: {},
        type: {
            type: String,
            required: true
        },
        id: {
            type: String,
        },
        placeholder: {
            type: String,
        },
        required: {
            type: Boolean,
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        },
        readonly: {
            type: Boolean,
            default: false
        },
        maxLength: {
            type: String,
        },
        minlength: {
            type: String,
        },
        inputClass: {

        },
        bottomNote: {},
        errorMessage: {},
        textAreaRows: {},
        textAreaCols: {},
        options: {},
        listValueField: {
            default: 'name'
        },
        fetchUrl: {},
        label: {},
        addClass: {}

    }
}
</script>

<style scoped>

</style>
