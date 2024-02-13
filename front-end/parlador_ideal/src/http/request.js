import axios from 'axios'
import { useAuthStore } from '@/store/authStore'

export const request = function () {
    const auth = useAuthStore()
    axios.defaults.baseURL = 'http://localhost:8000/api';

    async function login(authData) {
        return await axios.post('/login', authData).then(res => {
            auth.setToken(res.data.token)
            auth.setUser(res.data.user)
            return res
        })

    }

    async function getPost() {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + getToken();
        console.log(axios.defaults.headers.common['Authorization'])
        return await axios.get('/posts/myPosts').then(res => {
            return res
        })

    }

    function currentUser() {
        return auth.getUser()
    }

    function getToken() {
        return auth.getToken()
    }

    function isAuthenticated() {
        return !!(currentUser()  && getToken())
    }

    return {
        login,
        currentUser,
        getToken,
        isAuthenticated,
        getPost
    }

}