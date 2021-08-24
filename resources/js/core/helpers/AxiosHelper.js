import AxiosFunction from "./AxiosFunction";

export const axiosGet = (url) => AxiosFunction.axiosGet(urlGenerator(url));
export const axiosPost = (url, data) => AxiosFunction.axiosPost(urlGenerator(url), data);
export const axiosPatch = (url, data) => AxiosFunction.axiosPatch(urlGenerator(url), data);
export const axiosDelete = (url) => AxiosFunction.axiosDelete(urlGenerator(url));

export const baseUrl = window.location.origin
export const urlGenerator = (url) => `${baseUrl}/${url}`
