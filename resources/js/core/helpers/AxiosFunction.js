export default class AxiosFunction {
    static axiosGet(url){
        return axios.get(url);
    }

    static axiosPost(url, data){
        return axios.post(url, data);
    }

    static axiosPatch(url, data){
        return axios.patch(url, data)
    }

    static axiosDelete(url){
        return axios.delete(url)
    }
}
