import axios from 'axios';
import store from "../store";

const instance = axios.create({
    baseURL: 'http://localhost/api/v1'
});

instance.interceptors.request.use(
    config => {
        const token = store.getState().token;

        console.log('interceptors', store.getState().token )
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }

        return config;
    },
    error => Promise.reject(error)
);

export default instance;