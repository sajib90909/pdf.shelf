<template>
<div>
    <menu-bar v-if="!adminView"/>
    <div>
        <div class="row d-flex justify-content-center m-5">
            <div class="col-sm-6">
                <img v-if="user.profile_picture" :src="urlGenerator(user.profile_picture.path)" class="img-thumbnail" alt="...">
                <div v-else class="d-flex w-100 h-100 border">
                    <div class="m-auto">No image</div>
                </div>
            </div>
            <div class="col-sm-6">
                <h2 class="mb-4">{{ user.name }}</h2>
                <div class="h6"><span><strong class="mr-1">Average rating:</strong>{{ formatDecimal(user.rating) }}</span></div>
                <div class="h6"><span><strong class="mr-1">Select book as favourite:</strong>{{ user.favourite }}</span></div>
                <div class="h6"><span><strong class="mr-1">Readed book:</strong>{{ user.read }}</span></div>
                <div class="h6 mt-4"><span><strong class="mr-1">Bio:</strong>{{ user.bio }}</span></div>
                <button class="btn btn-outline-primary mt-4 px-3 rounded-pill btn-sm text-nowrap" @click="openUpdateModal">Update Profile <span class="ml-2"><i class="fas fa-long-arrow-alt-right"></i></span></button>
            </div>
        </div>

    </div>
    <div class="p-2"></div>
    <div class="my-3" v-if="!adminView">
        <book-cards
            title="Uploaded"
            btn-title="Add Book"
            :id="tableId"
            :pagination="true"
            @btnAction="openAddBookModal()"
            :url="`app/books?by=uploaded&per_page=8&user=${userId}`"
        />
    </div>
    <div class="my-3" v-if="!adminView">
        <book-cards
            title="Favourite"
            :show-btn="false"
            :id="tableId"
            :pagination="true"
            :url="`app/books?by=favourite&per_page=8&user=${userId}`"
        />
    </div>
    <footer-menu v-if="!adminView"/>

    <user-update-modal
        id="user-modal"
        table-id="profile-component"
        v-model="isUserUpdateModalActive"
        v-if="isUserUpdateModalActive"
        :selected-url="selectedUrl"
    />

    <book-create-edit-modal
        id="book-modal"
        v-model="isBookCreateEditModalActive"
        v-if="isBookCreateEditModalActive"
        :table-id="tableId"
    />

</div>
</template>

<script>
import FooterMenu from "./HelperComponents/FooterMenu";
import MenuBar from "./HelperComponents/MenuBar";
import BookCards from "./HelperComponents/BookCards";
import {axiosGet, urlGenerator} from "../../../core/helpers/AxiosHelper";
import UserUpdateModal from "../../components/UserUpdateModal";
import BookCreateEditModal from "../../components/bookCreateEditModal";

export default {
    name: "Profile",
    components: {BookCreateEditModal, UserUpdateModal, BookCards, MenuBar, FooterMenu},
    props: {
        adminView: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            urlGenerator,
            user: {},
            tableId: 'own-book-cards',
            isUserUpdateModalActive: false,
            isBookCreateEditModalActive: false,
            selectedUrl: '',
        }
    },
    mounted() {
        this.getUserData();

        this.$hub.$on('reload-profile-component', () => {
            this.getUserData();
        })
        window.scrollTo(0, 0)
    },
    computed: {
        userId(){
            return this.$route.params.id
        }
    },
    methods: {
        getUserData() {
            this.user = {}
            axiosGet(`app/user/${this.userId}`).then(({data}) => {
                this.user = data;
            })
        },
        formatDecimal(value){
            if (!value) return 0;
            return parseInt(value).toFixed(1);
        },
        openUpdateModal(){
            this.selectedUrl = `app/admin-panel/users/${this.userId}`
            this.isUserUpdateModalActive = true
        },
        openAddBookModal(){
            this.isBookCreateEditModalActive = true
        }
    }
}
</script>

