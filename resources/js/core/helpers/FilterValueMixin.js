import {objectToQueryString} from "./TextHelper";

export default {
    data() {
        return {
            filteredValue: {}
        }
    },
    methods: {
        setFilteredValue(data){
            this.filteredValue = {...this.filteredValue, ...data};
        }
    },
    computed: {
        queryFilter(){
            return objectToQueryString(this.filteredValue)
        }
    },
    watch: {
        queryFilter: {
            handler: function (data){
                this.getTableData()
            }
        }
    }
}
