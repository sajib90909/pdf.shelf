<template>
    <app-modal
        :id="id"
        v-model="showModal"
        title="Rating"
        @submit="submit"
    >
        <div class="d-flex justify-content-between p-4">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" v-model="formData.point" name="exampleRadios" id="exampleRadios1" value="1">
                <label class="form-check-label" for="exampleRadios1">
                    One
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" v-model="formData.point" name="exampleRadios" id="exampleRadios2" value="2">
                <label class="form-check-label" for="exampleRadios2">
                    Two
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" v-model="formData.point" name="exampleRadios" id="exampleRadios3" value="3">
                <label class="form-check-label" for="exampleRadios3">
                    Three
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" v-model="formData.point" name="exampleRadios" id="exampleRadios4" value="4">
                <label class="form-check-label" for="exampleRadios4">
                    Four
                </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" v-model="formData.point" name="exampleRadios" id="exampleRadios5" value="5">
                <label class="form-check-label" for="exampleRadios5">
                    Five
                </label>
            </div>
        </div>

    </app-modal>
</template>

<script>
import ModalMixin from "../../../../core/helpers/ModalMixin";
import FormMixinHelper from "../../../../core/helpers/FormMixinHelper";

export default {
    name: "RatingAddUpdateModal",
    props: {
        id: {},
        bookId: {},
    },
    mixins: [ModalMixin, FormMixinHelper],
    data(){
        return {
            url: ''
        }
    },
    mounted() {
        this.url = `app/add/rating/${this.bookId}`
    }

}
</script>

<style scoped>

</style>
