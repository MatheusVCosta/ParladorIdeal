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
                        h-96
                        text-sm 
                        rounded-lg
                        text-gray-500 
                        bg-orange-100">
                </textarea>
            </form>
            <navMenu class="w-3/5"></navMenu>
        </div>
    </div>
</template>

<script>
    import navMenu from '@/components/navBottomMenu.vue'
    import headerHome from '@/components/header.vue'

    import { request } from '@/http/request'

    export default {
        name: 'HomeView',
        components: {
            navMenu,
            headerHome
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
                console.log(this.postText)
                if (!this.postText) {
                    alert('Escreve sobre algo para publicar')
                    return
                }

                let params = {about_post: this.postText.about_post}
                await this.request.createPost(params).then(res => {
                    alert(res.data.message)
                    this.$router.push({name: 'home'})
                })
            },
            async editPost(event) {
                event.preventDefault()
                if (!this.postText) {
                    alert('O post não pode ser vazio')
                    return
                }

                let params = {about_post: this.postText.about_post}

                await this.request.updatePost(params, this.postId).then(res => {
                    alert(res.data.message)
                    this.$router.push({name: 'home'})
                })
            },
            async deletePost(event) {
                event.preventDefault()
                await this.request.deletePost(this.postId).then(res => {
                    alert(res.data.message)
                    this.$router.push({name: 'home'})
                })
            }
        }
    }


</script>