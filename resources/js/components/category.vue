<template>
    <div>
        <app-page-title title="Books" @buttonAction="openAddBookModal" btn-title="Add Book"/>

        <app-table
            :options="options"
            :id="tableId"
            @action="actionTrigger"
        />

        <category-create-edit-modal
            id="book-modal"
            v-model="isCategoryCreateUpdateModalActive"
            v-if="isCategoryCreateUpdateModalActive"
            :table-id="tableId"
            :selected-url="selectedUrl"
        />

    </div>
</template>

<script>
import ActionHelperMixin from "../core/helpers/ActionHelperMixin";
import {axiosDelete} from "../core/helpers/AxiosHelper";
import {urlGenerator} from "../core/helpers/AxiosHelper";
import categoryMixin from "./mixins/categoryMixin";
import CategoryCreateEditModal from "./components/CategoryCreateEditModal";

export default {
    name: 'category',
    mixins: [ActionHelperMixin, categoryMixin],
    components: {CategoryCreateEditModal},
    data() {
        return {
            isCategoryCreateUpdateModalActive: false,
            selectedUrl: '',
        }
    },
    methods: {
        editAction(row){
            this.selectedUrl = `${this.options.url}/${row.id}`;
            this.isCategoryCreateUpdateModalActive = true;
        },
        deleteAction(row){
            axiosDelete(`${this.options.url}/${row.id}`).then((response) => {
                this.$hub.$emit('reload-'+this.tableId)
            })
        },
        openAddBookModal(){
            this.selectedUrl = '';
            this.isCategoryCreateUpdateModalActive = true;
        }
    }
}
</script>
