import {axiosGet, axiosPatch, axiosPost} from "./AxiosHelper";
import {errorMessageInArray} from "./support/FormHelper";

export default {
    props: {
        selectedUrl: ''
    },
    data() {
        return {
            formData: {},
            errors: {},
        }
    },
    mounted() {
        if (this.selectedUrl){
            this.getEditableData()
        }
    },
    methods: {
        errorMessage(errors, variable){
            return errorMessageInArray(errors, variable)
        },
        submit() {
            if (this.selectedUrl) {
                axiosPatch((`${this.url}/${this.formData.id}` || this.selectedUrl) , this.formData).then((response) => {
                    this.successfullyUpdateData(response)
                }).catch(({response}) => {
                    this.errors = response.data.errors;
                })
            }else{
                axiosPost(this.url, this.formData).then((response) => {
                    this.successfullyUpdateData(response)
                }).catch(({response}) => {
                    this.errors = response.data.errors;
                })
            }

        },
        getEditableData(){
            axiosGet(this.selectedUrl).then(({data}) => {
                this.successfullyGetEditableData(data)
            })
        },
        successfullyUpdateData(data) {
            this.showModal = false
            $('#'+this.id).modal('hide');
            this.$hub.$emit('reload-'+this.tableId)
        },
        successfullyGetEditableData(data){
            this.formData = data
        }
    }
}
