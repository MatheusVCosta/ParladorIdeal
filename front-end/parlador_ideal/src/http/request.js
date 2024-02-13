import axios from 'axios'
import { useAuthStore } from '@/store/authStore'

export const request = function () {
    const auth = useAuthStore()
    axios.defaults.baseURL = 'http://192.168.1.12:8000/api';

    async function login(authData) {
        try {
            return await axios.post('/login', authData).then(res => {
                auth.setToken(res.data.token)
                auth.setUser(res.data.user)
                return res
            })
        }catch (error) {
            alert(error)
        } 
        

    }

    async function getPost() {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + getToken();
        return await axios.get('/posts').then(res => {
            return res
        })

    }

    async function getMyPosts() {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + getToken();
        return await axios.get('/posts?myPosts=true').then(res => {
            return res
        })

    }

    async function createPost(params) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + getToken();
        try {
            return await axios.post('/posts', params).then(res => {
                return res
            })
        }
        catch (error) {
            alert(error)
        }
    }

    async function updatePost(params) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + getToken();
        try {
            return await axios.put('/posts', params).then(res => {
                return res
            })
        }
        catch (error) {
            alert(error)
        }
    }

    async function deletePost(params) {
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + getToken();
        try {
            return await axios.delete('/posts').then(res => {
                return res
            })
        }
        catch (error) {
            alert(error)
        }
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
        
        getPost,
        getMyPosts,
        createPost
    }

}