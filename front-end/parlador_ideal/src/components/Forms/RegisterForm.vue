<template>
    <div>
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
                <label for="password" class="block mb-2 text-sm font-medium text-orange-400">Senha</label>
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
                        placeholder="Senha"
                        required>
            </div>
            <div class="mb-10 self-center">
                <span class="text-sm">Já possui uma conta?
                    <router-link class="text-orange-400" to="/login">Login</router-link>
                </span>
            </div>
            <button @click="sendForm" class="bg-orange-400 text-white p-3 rounded-lg">Registrar-se</button>
        </form>
        <openModal 
            :activate="showModalBool" 
            :message="messageModal"
            :messageArr="messageModalArr"
            :onModalName="modalName"
            @closeModal="modal"
            />
    </div>
</template>

<script>
    import axios from 'axios';
    import openModal from '@/components/Modal/ModalSuccess.vue'

    export default {
        name: 'LoginForm',
        components: {
            openModal
        },
        data() {
            return {
                name: "",
                email: "",
                password: "",
                messageModal: '',
                messageModalArr: [],
                showModalBool: false,
                modalName: ''
            }
        },
        methods: {
            modal(activate) {           
                this.showModalBool = activate
            },
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
                    if (res.status >= 200 || res.status <= 300) {
                        this.messageModal = res.data.message
                        this.modal(true)
                        this.modalName = 'success'

                        setTimeout(() => {
                            this.modal(false)
                            this.$router.replace('/login')
                        }, 2000)
                    }
                }).catch(error => {

                    if (!!error.response.data.errors) {
                        this.messageModalArr= []
                        Object.entries(error.response.data.errors).forEach(error => {
                            Object.entries(error[1][0]).forEach(e => {
                                this.messageModalArr.push(e[1][0])
                            })
                            
                        });
                        
                    }else {
                        this.messageModal = error.response.data.message
                    }
                    
                    this.modal(true)
                    this.modalName = 'error'
                })
                
            }
        }
    }

</script>