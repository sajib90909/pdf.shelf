<template>
    <app-modal
        :id="id"
        v-model="showModal"
        :title="`${selectedUrl ? 'Edit' : 'Add' } book`"
        @submit="submitData"
    >
        <form ref="form">
            <app-input
                title="Name"
                type="text"
                v-model="formData.name"
                id='book-name'
                placeholder="Enter name"
                :errorMessage="errorMessage(errors, 'name')"
            />
            <app-input
                title="Writer"
                type="text"
                v-model="formData.writer"
                id='book-writer'
                placeholder="Enter writer"
                :errorMessage="errorMessage(errors, 'writer')"
            />
            <app-input
                title="Publisher"
                type="text"
                v-model="formData.publisher"
                id='book-publisher'
                placeholder="Enter publisher"
                :errorMessage="errorMessage(errors, 'publisher')"
            />

            <app-input
                title="Category"
                type="select"
                v-model="formData.category_id"
                id='book-category'
                fetch-url="app/selectable/categories"
                list-value-filed="name"
                :required="true"
                :errorMessage="errorMessage(errors, 'category_id')"
            />

            <app-input
                title="Description"
                type="textarea"
                v-model="formData.description"
                id='book-description'
                placeholder="Enter description"
                text-area-rows="5"
                :errorMessage="errorMessage(errors, 'description')"
            />

            <app-input
                title="Image"
                type="file"
                v-model="image"
                id='book-image'
                label="Browse"
                :errorMessage="errorMessage(errors, 'image')"
            />

            <app-input
                title="Pdf"
                type="file"
                v-model="pdf"
                id='book-file'
                label="Browse"
                :errorMessage="errorMessage(errors, 'pdf')"
            />

        </form>
    </app-modal>
</template>

<script>
import ModalMixin from "../../core/helpers/ModalMixin";
import FormMixinHelper from "../../core/helpers/FormMixinHelper";
import {axiosPatch, axiosPost} from "../../core/helpers/AxiosHelper";

export default {
    name: "bookCreateEditModal",
    mixins: [ModalMixin, FormMixinHelper],
    props: {
        id: {},
    },
    data(){
        return {
            url: 'app/admin-panel/books',
            updateUrl: 'app/admin-panel/books/update',
            image: {},
            file: {}
        }
    },
    methods: {
        submitData() {
            let formData = new FormData()

            if (this.pdf?.name){
                formData.append('pdf', this.pdf)
            }

            if (this.image?.name){
                formData.append('image', this.image)
            }

            formData.append('name', this.formData.name || '')
            formData.append('writer', this.formData.writer || '')
            formData.append('publisher', this.formData.publisher || '')
            formData.append('category_id', this.formData.category_id || '')
            formData.append('description', this.formData.description || '')

            axiosPost((this.selectedUrl ? `${this.updateUrl}/${this.formData.id}` : this.url) , formData).then((response) => {
                this.successfullyUpdateData(response)
            }).catch(({response}) => {
                this.errors = response.data.errors;
            })

        },
    }
}
</script>

<style scoped>

</style>
