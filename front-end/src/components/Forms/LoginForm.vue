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
            <span class="text-sm">Ainda não possui uma conta 
                <router-link class="text-orange-400" to="/register">Registrar-se</router-link>
            </span>
            
        </div>
        <button @click="sendForm" class="bg-orange-400 text-white p-3 rounded-lg">Login</button>
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
    import { request } from '@/http/request'
    import openModal from '@/components/Modal/ModalSuccess.vue'

    export default {
        name: 'LoginForm',
        components: {
            openModal
        },
        data() {
            return {
                email: "",
                password: '',
                tokenGenerated: "",
                request: request(),
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
            redirectToHome(message) {
                this.$router.push({name: 'home', query: {sendMessage: message, modalName: 'success', activate: true}})
            },
            async sendForm(event) {
                event.preventDefault()
                let params = {
                    'email' : this.email,
                    'password' : this.password    
                }

                this.request.login(params).then(res => {

                    if (res.status >= 200 || res.status <= 300) {
                        this.redirectToHome(res.data.message)
                    }

                }).catch(error => {
                    if (!!error.response.data.errors) {
                        this.messageModalArr= []
                        Object.entries(error.response.data.errors).forEach(error => {
                            this.messageModalArr.push(error[1][0])
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