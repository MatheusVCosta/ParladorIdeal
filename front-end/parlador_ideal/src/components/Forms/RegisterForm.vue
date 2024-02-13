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
            <label for="name" class="block mb-2 text-sm font-medium text-orange-400">Nome</label>
            <input 
                type="text" 
                id="name" 
                v-model="name"
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
                    " placeholder="Maria de Souza" required>
        </div>
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
                value="123"
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
            <span class="text-sm">Já possui uma conta?
                <router-link class="text-orange-400" to="/login">Login</router-link>
            </span>
        </div>
        <button @click="sendForm" class="bg-orange-400 text-white p-3 rounded-lg">Registrar-se</button>
    </form>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'LoginForm',
        data() {
            return {
                name: "teste",
                email: "teste@gmail.com",
                password: "123"
            }
        },
        methods: {
            async sendForm(event) {
                event.preventDefault()
                let params = {
                    'name'  : this.name,
                    'email' : this.email,
                    'password' : this.password    
                }

                await axios.post(
                    'http://localhost:8000/api/users', 
                    params
                ).then(res => {
                    alert(res.data.message)
                    this.$router.replace('/login')
                }).catch(error => {
                    alert(error.response.data.message)
                })
                
            }
        }
    }

</script>