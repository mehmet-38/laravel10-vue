import axios from 'axios';

const API_URL = '/api/manager/messages';

export const getMessages = () => {
    return axios.get(API_URL).then(response => response.data);
};

export const postMessage = (message) => {
    return axios.post(API_URL, { message }).then(response => response.data);
};

export const loginUser = (email, password) => {
    return axios.post('/api/login', { email, password }).then(response => response.data);
};

export const registerUser = (name, email, password, password_confirmation) => {
    return axios.post('/api/register', {
        name,
        email,
        password,
        password_confirmation
    }).then(response => response.data);
};
