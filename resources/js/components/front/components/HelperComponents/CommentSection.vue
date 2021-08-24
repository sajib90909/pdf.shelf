<template>
    <div class="my-5 border-bottom">
        <div class="border-bottom mb-4">
            <h2 class="d-inline-block">Comments</h2>
            <small class="text-muted font-weight-bold">{{ countComment }}</small>
        </div>
        <div class="w-75">
            <template v-for="comment in comments">
                <comment-item-row :comment="comment" @likeAction="likeUpdate"/>
            </template>
            <div v-if="loginUser">
                <app-input
                    type="textarea"
                    v-model="formData.text"
                    id='book-description'
                    placeholder="Enter description"
                    text-area-rows="3"
                    :errorMessage="errorMessage(errors, 'text')"
                />

                <div class="text-right">
                    <button type="submit" class="btn btn-primary btn-sm my-2" @click="submit">Comment</button>
                </div>
            </div>
            <div v-else ><span class="font-italic">Please login for comment</span></div>
        </div>

    </div>
</template>

<script>
import {axiosGet, axiosPost, urlGenerator} from "../../../../core/helpers/AxiosHelper";
import CommentItemRow from "./CommentItemRow";
import FormMixinHelper from "../../../../core/helpers/FormMixinHelper";
export default {
    name: "CommentSection",
    mixins: [FormMixinHelper],
    components: {CommentItemRow},
    props: {
        countComment: {},
        bookId: {},
    },
    data() {
        return {
            urlGenerator,
            comments: {},
            formData: {}
        }
    },
    methods: {
        getComments(){
            this.comments= {}
            axiosGet(`app/comments/${this.bookId}`).then(({data}) => {
                this.comments = data;
            })
        },
        successfullyUpdateData(response){
            this.formData = {}
            this.getComments()
        },
        likeUpdate(type, commentId){
            let url = {
                'add' : `app/comment-like/add/${commentId}`,
                'remove' : `app/comment-like/remove/${commentId}`
            }[type]

            let data = {}
            axiosPost(url, data).then((data) => {
                this.getComments()
            })
        }
    },
    computed: {
        bookIdUpdate() {
            return this.bookId;
        },
        url(){
            return `app/add/comment/${this.bookId}`
        },
        loginUser() {
            return this.$store.state.Authenticate.user
        },
    },
    watch: {
        bookIdUpdate: {
            handler: function (id){
                this.formData.id = id;
                this.getComments()
            },
            immediate: true
        }
    }
}
</script>

<style scoped>

</style>
