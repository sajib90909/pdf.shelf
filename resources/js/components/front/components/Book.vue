<template>
    <div>
        <menu-bar/>
        <div>
            <div class="row d-flex justify-content-center m-5">
                <div class="col-sm-6">
                    <img v-if="book.images && book.images[0]" :src="urlGenerator(book.images[0].path)" class="img-thumbnail" alt="...">
                    <div v-else class="d-flex w-100 h-100 border">
                        <div class="m-auto">No image</div>
                    </div>
                    <div v-if="loginUser">
                        <div v-if="loginUser.id != book.upload_by" class="mt-2">
                            <button v-if="book.favourites && book.favourites.length" class="btn px-3 mr-1 btn-danger btn-sm rounded-pill" @click="favouriteAction('remove',  book.id)">Remove to favourite</button>
                            <button v-else class="btn px-3 mr-1 btn-success btn-sm rounded-pill" @click="favouriteAction('add', book.id)">Add to favourite</button>
                            <button class="btn px-3 mr-1 btn-dark btn-sm rounded-pill" @click="openRatingModal(book.id)">
                                {{ (book.ratings && book.ratings.length) ? `Rated: ${book.ratings[0].point}` : 'Rate' }}
                            </button>
                        </div>
                        <div v-else class="mt-2">
                            <button
                                class="btn px-3 mr-1 btn-primary btn-sm rounded-pill"
                                @click="openEditModal()">Update</button>
                            <button
                                class="btn px-3 mr-1 btn-danger btn-sm rounded-pill"
                                @click="deleteAction()">Delete</button>
                        </div>
                    </div>
                    <div v-else><span class="font-italic">Please login for rate and add to favourite this book</span></div>

                </div>
                <div class="col-sm-6">
                    <h2 class="mb-4">{{ book.name }}</h2>
                    <div class="h6"><span><strong class="mr-1">Writer:</strong>{{ book.writer }}</span></div>
                    <div class="h6"><span><strong class="mr-1">Publisher:</strong>{{ book.publisher }}</span></div>
                    <div class="h6">
                        <span v-if="book.rating"><strong class="mr-1">Rating:</strong>{{ formatDecimal(book.rating) }} out of 5</span>
                        <span v-else><strong class="mr-1">Rating:</strong><small class="font-italic">No rating</small></span>
                    </div>
                    <div class="h6"><span><strong class="mr-1">View:</strong>{{ book.views_count }}</span></div>
                    <div class="h6"><span><strong class="mr-1">Favourite:</strong>{{ book.favourites_count }}</span></div>
                    <div class="h6 mt-4"><span><strong class="mr-1">Description:</strong>{{ book.description }}</span></div>
                    <a :href="urlGenerator(`app/view-book/${book.id}`)" target="_blank" class="btn btn-outline-primary mt-4 px-3 rounded-pill btn-sm text-nowrap">Start Reading <span class="ml-2"><i class="fas fa-long-arrow-alt-right"></i></span></a>
                </div>
            </div>
            <div class="p-2"></div>
            <comment-section
                :count-comment="book.comments_count"
                :book-id="bookId"
            />
        </div>
        <div class="p-2"></div>
        <div class="my-3">
            <book-cards
                title="Related"
                :showBtn="false"
                :url="`app/books?by=related&category=${book.category_id}&per_page=4`"
            />
        </div>
        <footer-menu/>

        <book-create-edit-modal
            id="book-modal"
            v-model="isBookCreateEditModalActive"
            v-if="isBookCreateEditModalActive"
            :table-id="tableId"
            :selected-url="selectedUrl"
        />

        <rating-add-update-modal
            id="rating-modal"
            v-model="isRatingModalActive"
            v-if="isRatingModalActive"
            :table-id="tableId"
            :book-id="book.id"
        />


    </div>
</template>

<script>
import MenuBar from "./HelperComponents/MenuBar";
import BookCards from "./HelperComponents/BookCards";
import {axiosDelete, axiosGet, urlGenerator} from "../../../core/helpers/AxiosHelper";
import FooterMenu from "./HelperComponents/FooterMenu";
import CommentSection from "./HelperComponents/CommentSection";
import BookCreateEditModal from "../../components/bookCreateEditModal";
import favouriteMixin from "../mixins/favouriteMixin";
import RatingAddUpdateModal from "./HelperComponents/RatingAddUpdateModal";

export default {
    name: "Book",
    mixins: [favouriteMixin],
    components: {RatingAddUpdateModal, BookCreateEditModal, CommentSection, MenuBar,BookCards,FooterMenu},
    data() {
        return {
            urlGenerator,
            book: {},
            isBookCreateEditModalActive: false,
            isRatingModalActive: false,
            tableId: 'front-book-component',
            selectedUrl: ''
        }
    },
    computed: {
        bookId() {
            return this.$route.params.id
        },
        loginUser() {
            return this.$store.state.Authenticate.user
        },
    },
    mounted() {
        this.$hub.$on('reload-'+this.tableId, () => {
            this.getData();
        })
        window.scrollTo(0, 0)
    },
    methods: {
        getData(){
            this.book = {}
            axiosGet(`app/book/${this.bookId}`).then(({data}) => {
                this.book = data;
            })
        },
        formatDecimal(value){
            if (!value) return '';
            return parseInt(value).toFixed(1);
        },
        openEditModal() {
            this.selectedUrl = `app/admin-panel/books/${this.bookId}`
            this.isBookCreateEditModalActive = true;
        },
        deleteAction(){
            axiosDelete(`app/admin-panel/books/${this.bookId}`).then((response) => {
                this.$router.push({ name: 'profile', params: { id: this.loginUser.id} })
            })
        },
        openRatingModal(BookId){
            this.isRatingModalActive = true
        }
    },
    watch: {
        bookId: {
            handler: function(value) {
                window.scrollTo(0, 0)
                this.getData()
            },
            immediate: true
        }
    }
}
</script>

