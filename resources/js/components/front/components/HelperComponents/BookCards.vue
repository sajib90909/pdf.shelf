<template>
    <div class="">
        <div v-if="topBar" class="d-flex justify-content-between my-4">
            <div>
                <h4 v-if="title" class="d-inline-block">{{ title }} </h4>
                <span v-if="title" class="ml-2 h5"><i class="fas fa-long-arrow-alt-right"></i></span>
            </div>
            <div>
                <button v-if="showBtn" class="btn btn-outline-info rounded-pill btn-sm" @click="$emit('btnAction', title)">{{ btnTitle }}</button>
            </div>
        </div>
        <div>
            <div class="row d-flex justify-content-start">
                <template v-for="book in books">
                    <div class="col-sm-6 col-md-4 col-lg-3 mt-3">
                        <book-card
                            :book="book"
                            @favouriteAction="favouriteAction"
                        />
                    </div>
                </template>
            </div>
            <app-pagination
                v-if="pagination"
                :current-page="pageData.current_page"
                :last-page="pageData.last_page"
                @setFilteredValue="setFilteredValue"
            />
        </div>
    </div>
</template>

<script>
import {axiosGet, urlGenerator} from "../../../../core/helpers/AxiosHelper";
import BookCard from "./BookCard";
import FilterValueMixin from "../../../../core/helpers/FilterValueMixin";
import favouriteMixin from "../../mixins/favouriteMixin";

export default {
    name: "BookCards",
    mixins: [FilterValueMixin, favouriteMixin],
    components: {BookCard},
    props: {
        id: {},
        topBar: {
            type: Boolean,
            default: true
        },
        url: {
            default: 'app/books'
        },
        title: '',
        showBtn: {
            type: Boolean,
            default: true
        },
        btnTitle: {
            default: 'Show All'
        },
        pagination:{
            default: false
        },
        goTopPaginateAction:{
            default: false
        }
    },
    data() {
        return {
            urlGenerator,
            books: {},
            pageData: {}
        }
    },
    mounted() {
        this.getData()

        this.$hub.$on('reload-'+this.id, () => {
            this.getData()
        })
    },
    methods: {
        getData() {
            axiosGet(`${this.url}&${this.queryFilter}`).then(({data}) => {
                this.books = data.data;
                this.pageData = data;
                if(this.goTopPaginateAction) window.scrollTo(0, 0)
            })
        },
        getTableData(){
            this.getData()
        }
    },
    computed: {
        urlChangeCheck(){
            return this.url
        }
    },
    watch: {
        urlChangeCheck: {
            handler: function (){
                this.getData()
            }
        }
    }
}
</script>

<style scoped>

</style>
