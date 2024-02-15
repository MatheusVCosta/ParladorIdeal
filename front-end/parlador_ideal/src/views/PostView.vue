<template>
    <div 
        class="
        flex 
        flex-col
        w-full">
        <headerHome></headerHome>
    
        <div  class="
            flex 
            flex-col
            p-4
            mt-20">
            
            <form>
                <div class="grid grid-cols-7 gap-2" v-if="mode == 'edit'">
                    
                    <button 
                        @click="editPost" class="bg-orange-400 col-span-6 text-white p-3 mb-6 rounded-lg">
                        Editar publicação
                    </button>

                    <button 
                        @click="deletePost" class="bg-red-400 text-white p-3 mb-6 rounded-lg">
                        Excluir
                    </button>
                </div>

                <button 
                    v-else
                    @click="createNewPost" class="bg-orange-400 w-full text-white p-3 mb-6 rounded-lg">
                    Criar uma nova publicação
                </button>
                
                <textarea 
                    id="newPost" 
                    placeholder="Escreve sobre o que você pensa..."
                    maxlength="280"
                    v-model="postText.about_post"
                    class="
                        block 
                        p-5
                        w-full 
                        h-5/6
                        min-h-96
                        text-sm 
                        rounded-lg
                        resize-none
                        text-gray-500 
                        bg-orange-100">
                </textarea>
            </form>
            <navMenu class="w-3/5"></navMenu>
        </div>
        <openModal 
            :activate="showModalBool" 
            :message="messageModal"
            :onModalName="modalName"
            @closeModal="close"
            @responseModal="responseModal"
        />
    </div>
</template>

<script>
    import navMenu from '@/components/navBottomMenu.vue'
    import headerHome from '@/components/header.vue'
    import openModal from '@/components/Modal/ModalSuccess.vue'

    import { request } from '@/http/request'

    export default {
        name: 'HomeView',
        components: {
            navMenu,
            headerHome,
            openModal
        },
        data() {
            return {
                postData: {},
                postText: {
                    about_post: ""
                },
                request: request(),
                mode: 'create',
                postId: '',
                messageModal: '',
                messageModalArr: [],
                showModalBool: false,
                modalName: ''
            }
        },
        created() {
            this.mode = this.$route.query.mode
            if (this.mode == 'edit') {
                this.postId = this.$route.query.postId
                this.getMyPost()
            }  
        },
        methods: {
            async getMyPost() {
                await this.request.getMyPost(this.postId).then(res => {
                    this.postText = res.data.data
                })
            },
            async createNewPost(event) {
                event.preventDefault()
                
                if (!this.postText.about_post) {
                    this.messageModal  = "Escreve sobre algo para publicar!"
                    this.modalName     = "error"
                    this.showModalBool = true
                    setTimeout(() => {
                        this.showModalBool = false
                    }, 2000)
                    return
                }

                let params = {about_post: this.postText.about_post}
                await this.request.createPost(params).then(res => {
                    this.messageModal  = res.data.message
                    this.modalName     = "success"
                    this.showModalBool = true
                    setTimeout(() => {
                        this.showModalBool = false
                        this.$router.push({name: 'mypost'})
                    }, 2000)
                    
                })
            },
            async editPost(event) {
                event.preventDefault()
                if (!this.postText.about_post) {
                    this.messageModal  = "O post não pode ser vazio!"
                    this.modalName     = "error"
                    this.showModalBool = true

                    setTimeout(() => {
                        this.showModalBool = false
                    }, 2000)
                    return
                }

                let params = {about_post: this.postText.about_post}

                await this.request.updatePost(params, this.postId).then(res => {
                    this.messageModal  = res.data.message
                    this.modalName     = "success"
                    this.showModalBool = true
                    setTimeout(() => {
                        this.showModalBool = false
                        this.$router.push({name: 'mypost'})
                    }, 2000)
                })
            },
            async deletePost(event) {
                event.preventDefault()
                this.messageModal  = 'Deseja remover este post?'
                this.modalName     = "question"
                this.showModalBool = true
                
            },
            close(close) {
                this.showModalBool = close
            },
            responseModal(response) {
                if (response) {
                    this.request.deletePost(this.postId).then(res => {
                        this.messageModal  = res.data.message
                        this.modalName     = "success"
                        this.showModalBool = true
                        setTimeout(() => {
                            this.showModalBool = false
                            this.$router.push({name: 'mypost'})
                        }, 2000)
                    })
                }
                this.showModalBool = false
            }
        }
    }


</script>