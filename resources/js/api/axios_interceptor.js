import axios from "axios";
import { GRAPHQL_API } from "./graphql/endpoints";

const graphqlClient = axios.create({
    baseURL: GRAPHQL_API,
    method: 'post'
});

graphqlClient.interceptors.request.use(function (config) {
    let token = localStorage.getItem('token')? localStorage.getItem('token') : '';
    config.headers = {
        ...config.headers,
        'Authorization': `JWT ${token}` };
    // you can also do other modification in config
    return config;
}, function (error) {
    return Promise.reject(error);
});

export default graphqlClient;
