import axios, {AxiosResponse, AxiosError, InternalAxiosRequestConfig, AxiosRequestConfig} from 'axios';
import {get as getL, remove} from './localStorage.js';

export const baseURL: string = (import.meta as any).env.VITE_API_BASE_URL;

axios.interceptors.request.use(
    (config: InternalAxiosRequestConfig) => {
        let token: string | null = getL('token');

        if (token) {
            if (config.headers) {
                config.headers.Authorization = "Bearer " + token;
            }
        }
        config.baseURL = baseURL;
        return config;
    },
    (error: AxiosError) => {
        return Promise.reject(error);
    }
);

axios.interceptors.response.use(
    (response: AxiosResponse) => {
        return response;
    },
    (error: AxiosError) => {
        if (error.response?.status === 401) {
            remove('user');
            window.location.href = '/login';
        }
        return Promise.reject(error);
    }
);

export function post(url: string, data: any | null, contentType: string = "application/json"): Promise<AxiosResponse> {
    return axios({
        method: 'POST',
        url: url,
        data: data,
        headers: {
            'Content-Type': contentType,
        },
    });
}

export function put(url: string, data: any, contentType: string = "application/json"): Promise<AxiosResponse> {
    return axios({
        method: 'PUT',
        url: url,
        data: data,
        headers: {
            'Content-Type': contentType,
        },
    });
}

export function get(url: string): Promise<AxiosResponse> {
    const config: AxiosRequestConfig = {
        method: 'GET',
        url: url,
    };
    return axios(config);
}

export function getWithParams(url: string, params: any): Promise<AxiosResponse> {
    const config: AxiosRequestConfig = {
        method: 'GET',
        url: url,
        params: params,
    };
    return axios(config);
}

export function del(url: string): Promise<AxiosResponse> {
    const config: AxiosRequestConfig = {
        method: 'DELETE',
        url: url,
    };
    return axios(config);
}
