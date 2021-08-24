import {axiosPost} from "../../../core/helpers/AxiosHelper";

export default {
    methods: {
        favouriteAction(type, bookId){
            let url = {
                'add' : `app/add/favourite/${bookId}`,
                'remove' : `app/remove/favourite/${bookId}`
            }[type]
            let data = {}
            axiosPost(url, data).then((data) => {
                this.getData()
            })
        }
    }
}
