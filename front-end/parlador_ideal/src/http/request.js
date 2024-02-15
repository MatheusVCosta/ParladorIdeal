import axios from 'axios'
import { useAuthStore } from '@/store/authStore'

export const request = function () {
    const auth = useAuthStore()
    // axios.defaults.baseURL = 'http://192.168.1.12:8000/api';
    axios.defaults.baseURL = 'http://localhost:8000/api';
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + getToken();
    axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';

    async function login(authData) {
        var responseError

        try {
            return await axios.post('/login', authData).then(res => {
                auth.setToken(res.data.token)
                auth.setUser(res.data.user)
                return res
            })
        } catch (error) {
            responseError = error
            throw error
        }

        // return responseError
    }

    async function logout() {
        try {
            return await axios.post('/logout').then(res => {
                auth.clearTokenAndUser()
                return res
            })
        } catch (error) {
            return error
        }
    }

    async function getPost() {
        return await axios.get('/posts').then(res => {
            return res
        })

    }

    async function getMyPosts() {
        return await axios.get('/posts?myPosts=true').then(res => {
            return res
        })

    }

    async function getMyPost(postId) {
        return await axios.get("/posts/myPost/" + postId).then(res => {
            return res
        })

    }

    async function createPost(params) {
        try {
            return await axios.post('/posts', params).then(res => {
                return res
            })
        }
        catch (error) {
            return error
        }
    }

    async function updatePost(params, postId) {
        try {
            console.log(params)
            return await axios.put('/posts/myPosts/' + postId, params).then(res => {
                return res
            })
        }
        catch (error) {
            return error
        }
    }

    async function deletePost(postId) {
        try {
            return await axios.delete('/posts/myPosts/' + postId).then(res => {
                return res
            })
        }
        catch (error) {
            return error
        }
    }

    function currentUser() {
        return auth.getUser()
    }

    function getToken() {
        return auth.getToken()
    }

    function isAuthenticated() {
        return !!(currentUser() && getToken())
    }

    return {
        login,
        logout,
        currentUser,
        getToken,
        isAuthenticated,

        getPost,
        getMyPosts,
        getMyPost,
        createPost,
        updatePost,
        deletePost
    }

}