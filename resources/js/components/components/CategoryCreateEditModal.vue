<template>
    <app-modal
        :id="id"
        v-model="showModal"
        :title="`${selectedUrl ? 'Edit' : 'Add' } category`"
        @submit="submit"
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
        </form>
    </app-modal>
</template>

<script>
import ModalMixin from "../../core/helpers/ModalMixin";
import FormMixinHelper from "../../core/helpers/FormMixinHelper";
export default {
    name: "CategoryCreateEditModal",
    mixins: [ModalMixin, FormMixinHelper],
    props: {
        id: {},
    },
    data(){
        return{
            url: 'app/admin-panel/categories'
        }
    }
}
</script>

<style scoped>

</style>
