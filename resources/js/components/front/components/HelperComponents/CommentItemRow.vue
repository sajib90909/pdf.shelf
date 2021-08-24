<template>
    <div class="">
        <div class="d-flex justify-content-start my-3">
            <div class="mr-4 text-center rounded-pill overflow-hidden bg-brand-light" style="width: 50px; height: 50px">
                <img v-if="comment.user.profile_picture" :src="urlGenerator(comment.user.profile_picture.path)" class="img-thumbnail w-100 h-100" alt="...">
                <h4 v-else class="w-100 h-100 p-2 mt-1">{{ makeSortName(comment.user.name) }}</h4>
            </div>
            <div>
                <h6 class="font-weight-bold">{{ comment.user.name }}</h6>
                <p class="mb-2">{{ comment.text }}</p>
                <div>
                    <button v-if="comment.likes && comment.likes.length" class="btn btn-primary btn-sm" @click="$emit('likeAction', 'remove', comment.id)"><i class="fas fa-thumbs-up"></i><span class="ml-2">{{ comment.likes_count }}</span></button>
                    <button v-else class="btn btn-outline-primary btn-sm" @click="$emit('likeAction', 'add', comment.id)"><i class="fas fa-thumbs-up"></i><span class="ml-2">{{ comment.likes_count }}</span></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {axiosPost, urlGenerator} from "../../../../core/helpers/AxiosHelper";
export default {
    name: "CommentItemRow",
    props: {
        comment: {}
    },
    data() {
        return {
            urlGenerator,
        }
    },
    methods: {
        makeSortName(name) {
            if (!name) return '';
            let matches = name.match(/\b(\w)/g);
            let acronym = matches.join('');
            return acronym.substring(0,2)
        },
    }
}
</script>

<style scoped>

</style>
