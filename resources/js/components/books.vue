<template>
    <div>
        <app-page-title title="Books" @buttonAction="openAddBookModal" btn-title="Add Book"/>

        <app-table
            :options="options"
            :id="tableId"
            @action="actionTrigger"
        />

        <book-create-edit-modal
            id="book-modal"
            v-model="isBookCreateEditModalActive"
            v-if="isBookCreateEditModalActive"
            :table-id="tableId"
            :selected-url="selectedUrl"
        />

    </div>
</template>

<script>
import bookMixins from "./mixins/bookMixins";
import ActionHelperMixin from "../core/helpers/ActionHelperMixin";
import {axiosDelete} from "../core/helpers/AxiosHelper";
import bookCreateEditModal from "./components/bookCreateEditModal";
import {urlGenerator} from "../core/helpers/AxiosHelper";

    export default {
        name: 'books',
        mixins: [bookMixins, ActionHelperMixin],
        components: {bookCreateEditModal},
        data() {
            return {
                isBookCreateEditModalActive: false,
                selectedUrl: '',
            }
        },
        methods: {
            editAction(row){
                this.selectedUrl = `${this.options.url}/${row.id}`;
                this.isBookCreateEditModalActive = true;
            },
            deleteAction(row){
                axiosDelete(`${this.options.url}/${row.id}`).then((response) => {
                    this.$hub.$emit('reload-'+this.tableId)
                })
            },
            viewAction(row){
                // let routeData = this.$router.resolve({path: urlGenerator(`app/view-book/${row.id}`)})
                window.open(urlGenerator(`app/view-book/${row.id}`), '_blank');
            },
            openAddBookModal(){
                this.selectedUrl = '';
                this.isBookCreateEditModalActive = true;
            }
        }
    }
</script>
