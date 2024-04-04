import 'bootstrap'
import axios from 'axios';
import Swal from "sweetalert2";
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// Set axios base url
window.axios.defaults.baseURL = '/api/v1';

// Set token
const apiToken = localStorage.getItem('token');
if (apiToken) {
    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + apiToken
}


// Toast setup
export const confirm = (title = null, text) => {
    return Swal.fire({
        title: title || 'Are you sure?',
        text: text || 'You will not be able to revert this action!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    });
}

export const successToast = (msg, options) => {
    options = Object.assign({
        toast: true,
        icon: 'success',
        title: msg,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    })
    Swal.fire(options)
}
export const errorToast = (msg, options, timer= 3000) => {
    options = Object.assign({
        toast: true,
        icon: 'error',
        title: msg,
        position: 'top-end',
        showConfirmButton: false,
        timer: timer,
        timerProgressBar: true,
    })
    Swal.fire(options)
}
