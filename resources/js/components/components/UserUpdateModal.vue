<template>
    <app-modal
        :id="id"
        v-model="showModal"
        :title="`${selectedUrl ? 'Edit' : 'Add' } user`"
        @submit="submitData"
    >
        <form ref="form">
            <app-input
                title="Name"
                type="text"
                v-model="formData.name"
                id='user-name'
                placeholder="Enter name"
                :errorMessage="errorMessage(errors, 'name')"
            />
            <app-input
                title="Email"
                type="text"
                v-model="formData.email"
                id='user-email'
                placeholder="Enter email"
                :errorMessage="errorMessage(errors, 'email')"
            />

            <app-input
                title="Role"
                type="select"
                v-if="loginUser.id != formData.id && fromAdminPanel"
                v-model="formData.role_id"
                id='user-role'
                :options="[
                    { id: '2', name:'Admin'},
                    { id: '1', name:'User'}
                ]"
                list-value-filed="name"
                :required="true"
                :errorMessage="errorMessage(errors, 'role_id')"
            />

            <app-input
                title="Image"
                type="file"
                v-model="image"
                id='user-image'
                label="Browse"
                :errorMessage="errorMessage(errors, 'image')"
            />

            <app-input
                title="Bio"
                type="textarea"
                v-model="formData.bio"
                id='user-bio'
                text-area-rows="3"
                placeholder="Write bio"
                :errorMessage="errorMessage(errors, 'bio')"
            />

        </form>
    </app-modal>
</template>

<script>
import ModalMixin from "../../core/helpers/ModalMixin";
import FormMixinHelper from "../../core/helpers/FormMixinHelper";
import {axiosPatch, axiosPost} from "../../core/helpers/AxiosHelper";

export default {
    name: "UserUpdateModal",
    mixins: [ModalMixin, FormMixinHelper],
    props: {
        id:{},
        tableId: {},
        fromAdminPanel: {}
    },
    data(){
        return {
            url: 'app/admin-panel/users/update',
            image: {},
            file: {},
        }
    },
    methods: {
        submitData() {
            let formData = new FormData()

            if (this.image?.name){
                formData.append('image', this.image)
            }

            formData.append('name', this.formData.name || '')
            formData.append('email', this.formData.email || '')
            formData.append('role_id', this.formData.role_id || '')
            formData.append('bio', this.formData.bio || '')

            axiosPost(`${this.url}/${this.formData.id}` , formData).then((response) => {
                this.successfullyUpdateData(response)
            }).catch(({response}) => {
                this.errors = response.data.errors;
            })

        },
    },
    computed: {
        loginUser() {
            return this.$store.state.Authenticate.user
        }
    },
}
</script>

<style scoped>

</style>
