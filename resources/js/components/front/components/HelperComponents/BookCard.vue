<template>
    <div class="card">
        <div class="card-img-top book-card-image d-flex justify-content-center align-content-center overflow-hidden">
            <div class="align-self-center">
                <img :src="book.images.length ? urlGenerator(book.images[0].path) : ''" alt="Card image cap">
            </div>

            <div v-if="loginUser.id != book.upload_by" class="book-card-image-hover">
                <button v-if="book.favourites.length" class="m-2 btn btn-danger btn-sm" @click="$emit('favouriteAction', 'remove', book.id)">Remove from favourite</button>
                <button v-else class="m-2 btn btn-success btn-sm"  @click="$emit('favouriteAction', 'add', book.id)">Add to favourite</button>
<!--                <div class="book-card-overlay"></div>-->
            </div>
            <div v-else class="book-card-image-hover">
                <router-link :to="{ name:'book', params: {id:book.id}}" class="m-2 btn btn-success btn-sm">View</router-link>
                <!--                <div class="book-card-overlay"></div>-->
            </div>
        </div>
        <div class="card-body pt-1">
            <div class="d-flex justify-content-between">
                <div>
                    <span><i class="fas fa-star"></i></span>
                    <span v-if="book.rating" class="ml-1">{{ formatDecimal(book.rating) }}</span>
                    <span v-else><small class="font-italic">No rating</small></span>
                </div>
                <div>
                    <span><i class="fas fa-eye"></i></span>
                    <span class="ml-1">{{ book.views_count }}</span>
                </div>
            </div>
            <div class="mt-4">
                <div>
                    <router-link :to="{ name:'book', params: { id: book.id }}" class="mb-0 h5 d-block">{{ book.name }}</router-link>
                    <small>Published by {{ book.publisher }}</small>
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <div>
                        <small class="font-italic">{{ book.comments_count }} comment</small>
                    </div>
                    <div>
                        <a class="btn btn-outline-primary px-3 rounded-pill btn-sm text-nowrap" target="_blank" :href="`${urlGenerator('app/view-book')}/${book.id}`">Read <span class="ml-2"><i class="fas fa-long-arrow-alt-right"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {urlGenerator} from "../../../../core/helpers/AxiosHelper";

export default {
    name: "BookCard",
    props: {
        book: {}
    },
    data() {
        return {
            urlGenerator
        }
    },
    methods:{
        formatDecimal(value){
            if (!value) return '';
            return parseInt(value).toFixed(1);
        }
    },
    computed: {
        loginUser() {
            return this.$store.state.Authenticate.user
        },
    }
}
</script>

<style scoped>

</style>
