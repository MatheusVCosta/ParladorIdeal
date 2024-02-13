<template>
    <form 
    class="
    flex
    flex-col
    self-center
    justify-between
    md:mt-10"
    > 

        <div class="mb-4">
            <label for="email" class="block mb-2 text-sm font-medium text-orange-400">E-mail</label>
            <input 
                type="email" 
                id="email" 
                v-model="email"
                class="
                    bg-gray-50 
                    border 
                    border-gray-300 
                    text-gray-900 
                    text-sm 
                    rounded-lg 
                    focus:ring-blue-500 
                    focus:border-blue-500 
                    block w-full p-2.5 
                    " placeholder="email@exemple.com" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block mb-2 text-sm font-medium text-orange-400">Password</label>
        <input 
            type="password" 
            id="password" 
            v-model="password"
            class="
                bg-gray-50 
                border 
                border-gray-300 
                text-gray-900 
                text-sm rounded-lg 
                focus:ring-blue-500 
                focus:border-blue-500 
                block w-full p-2.5"
                placeholder="Password"
                required>
        </div>
        <div class="mb-10 self-center">
            <span class="text-sm">Ainda não possui uma conta 
                <router-link class="text-orange-400" to="/register">Registrar-se</router-link>
            </span>
            
        </div>
        <button @click="sendForm" class="bg-orange-400 text-white p-3 rounded-lg">Login</button>
    </form>
</template>

<script>
    import { authLogin } from '@/auth/login'

    export default {
        name: 'LoginForm',
        data() {
            return {
                email: "teste23@gmail.com",
                password: '123',
                tokenGenerated: "",
                // t: authLogin()
            }
        },
        methods: {
            async sendForm(event) {
                event.preventDefault()
                let params = {
                    'email' : this.email,
                    'password' : this.password    
                }

                authLogin().login(params).then(res => {
                    if (res.status >= 200 || res.status <= 300) {
                        alert(res.data.message)
                        this.$router.replace('/home')
                    }
                }).catch(error => {
                    alert(error.response.data.message)
                })
            }
        }
    }

</script>