<template>
    <div>
        <menu-bar/>
        <div class="px-3 py-2 d-flex align-content-center justify-content-between bg-brand-light border">
            <router-link v-if="filtered" :to="{ name: 'books' }" class="align-self-center mb-0 h5 btn btn-sm btn-outline-primary rounded-pill">Clear filter</router-link>
            <h5 v-else class="align-self-center mb-0">All books</h5>
            <div>
                <div class="dropdown">
                    <button class="btn btn-dark btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-sort-amount-down"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <router-link class="dropdown-item" :to="{ name: 'books', query: { ...$route.query, short_by:'newest'}}">Newest</router-link>
                        <router-link class="dropdown-item" :to="{ name: 'books', query: { ...$route.query, short_by:'oldest'}}">Oldest</router-link>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <book-cards
                :url="`${url}&per_page=16`"
                :top-bar="false"
                :pagination="true"
                :go-top-paginate-action="true"
            />
        </div>

        <footer-menu/>
    </div>
</template>

<script>
import MenuBar from "./HelperComponents/MenuBar";
import Slider from "./HelperComponents/Slider";
import BookCards from "./HelperComponents/BookCards";
import FooterBanner from "./HelperComponents/FooterBanner";
import FooterMenu from "./HelperComponents/FooterMenu";
import {objectToQueryString} from "../../../core/helpers/TextHelper";

export default {
    name: "Books",
    components: {MenuBar,Slider,BookCards,FooterBanner,FooterMenu},
    data(){
        return {
            url: ''
        }
    },
    mounted () {
        window.scrollTo(0, 0)
    },
    computed: {
        filtered(){
            return this.$route.fullPath.includes("?")
        }
    },
    watch: {
        $route: {
            handler: function (to){
                this.url = `app/books?${objectToQueryString(to.query)}`
                if (!this.url.includes("?")){
                    this.url = `${this.url}?`
                }
            },
            immediate: true
        }
    }
}
</script>

<style scoped>

</style>
