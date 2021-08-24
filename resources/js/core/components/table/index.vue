<template>
    <div class="m-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
<!--                        <app-filter-->
<!--                            :filters="options.filters"-->
<!--                        />-->
                    </div>
                    <!-- /.card-header -->
                    <table-component
                        :options="options"
                        :from-sr="tableData.from"
                        :columns-data="columnsData"
                        @actionTrigger="actionTrigger"
                    />
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <app-pagination
                            :current-page="tableData.current_page"
                            :last-page="tableData.last_page"
                            @setFilteredValue="setFilteredValue"
                        />
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</template>

<script>
import tableComponent from "./tableComponent";
import appFilter from "../filters/index"
import {axiosGet} from "../../helpers/AxiosHelper";
import FilterValueMixin from "../../helpers/FilterValueMixin";

export default {
    name: "AppTable",
    components: {tableComponent, appFilter},
    mixins: [FilterValueMixin],
    props: {
        options: {
            required: true,
            type: Object
        },
        id: {
            required: true,
            type: String
        },
        tableOptions: {}
    },
    data() {
        return {
            tableData: {},
        }
    },
    mounted() {
        if (this.tableOptions){
            this.tableData = this.tableOptions
        }

        if (!this.tableOptions && this.options.url){
            this.getTableData();
        }

        this.$hub.$on('reload-'+this.id, () => {
            this.getTableData()
        })
    },
    methods: {
        getTableData(){
            axiosGet(this.urlModify(this.options.url, this.queryFilter)).then(({data}) => {
                this.tableData = data
            });
        },
        actionTrigger(action, row){
            this.$emit('action', action, row)
        },
        urlModify(url, query){
            return `${url}${url.includes('?') ? `&${query}` : `?${query}`}`
        }
    },
    computed: {
        columnsData(){
            return this.tableData.data
        }
    }
}
</script>

<style scoped>

</style>
