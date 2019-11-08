import axios from 'axios';

export const register = async newUser => {
    try {
        const res = await axios
            .post('http://localhost:8000/api/register', newUser, {
                headers: { 'Content-Type': 'application/json' }
            });
        console.log(res);
    }
    catch (err) {
        console.log(err);
    }
}

export const login = async user => {
    try {
        const res = await axios
            .post('http://localhost:8000/api/login', {
                email: user.email,
                password: user.password
            }, {
                headers: { 'Content-Type': 'application/json' }
            });
        localStorage.setItem('userToken', res.data.token);
        console.log(res);
    }
    catch (err) {
        console.log(err);
    }
}

export const getProfile = async () => {
    try {
        const res = await axios
            .post('http://localhost:8000/api/profile', newUser, {
                headers: { Authorization: `Bearer ${localStorage.userToken}` }
            });
        console.log(res);
        return res.data;
    }
    catch (err) {
        console.log(err);
    }
}