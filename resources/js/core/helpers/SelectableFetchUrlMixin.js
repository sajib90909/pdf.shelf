import {axiosGet} from "./AxiosHelper";

export default {
    created(){
        if(this.data.fetchUrl && !this.data.options && this.data.type === 'select'){
            this.getOptionsData();
        }
    },
    methods: {
        getOptionsData() {
            axiosGet(this.data.fetchUrl).then(({data}) => {
                this.selectAbleOptions = data.concat({id: '', name: 'Select an options'})
            })
        }
    }
}
