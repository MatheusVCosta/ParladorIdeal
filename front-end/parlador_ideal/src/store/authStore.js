import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', () => {
    const token = ref(localStorage.getItem('token'))
    const user  = ref(JSON.parse(localStorage.getItem('user')))

    function setToken(tokenValue) {
        localStorage.setItem('token', tokenValue)
        token.value = tokenValue
    }

    function setUser(userValue) {
        localStorage.setItem('user', JSON.stringify(userValue))
        user.value = JSON.stringify(userValue)
    }

    function getToken() {
        return localStorage.getItem('token')
    }
    function getUser() {
        return JSON.parse(localStorage.getItem('user'))
    }

    function clearTokenAndUser() {
        localStorage.removeItem('token')
        localStorage.removeItem('user')
    }

    return {
        setToken,
        getToken,
        setUser,
        getUser,
        clearTokenAndUser
    }
})
