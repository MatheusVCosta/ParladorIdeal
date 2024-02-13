import axios from 'axios'
import {useAuthStore} from '@/store/auth'

export const authLogin = function() {
    const auth = useAuthStore()
    axios.defaults.baseURL = 'http://localhost:8000/api';

    async function login(authData) {
        return await axios.post('/login', authData).then(res => {
            auth.setToken(res.data.token)
            auth.setUser(res.data.user)
            return res
        })
        
    }

    function currentUser() {
        return auth.getUser()
    }

    function getToken() {
        return auth.getUser()
    }

    return {
        login,
        currentUser,
        getToken
    }
    
}