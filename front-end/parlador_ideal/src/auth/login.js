import axios from 'axios'
import {useAuthStore} from '@/store/auth'

export const authLogin = function() {
    const auth = useAuthStore()
    axios.defaults.baseURL = 'http://localhost:8000/api';

    async function login(authData) {
        let response
        return await axios.post('/login', authData)
        
    }

    return {
        login
    }
    
}