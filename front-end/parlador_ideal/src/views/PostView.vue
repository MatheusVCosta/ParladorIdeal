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
              
                <button 
                    @click="createPostt" class="bg-orange-400 min-w-full text-white p-3 mb-6 rounded-lg">
                    Crie um Novo Post
                </button>
                <textarea 
                    id="newPost" 
                    placeholder="Escreve sobre o que você pensa..."
                    maxlength="280"
                    v-model="newPostText"
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
                postsData: {},
                newPostText: "",
                request: request()
            }
        },
        created() {
            this.getPosts()
        },
        methods: {
            async getPosts() {
                await this.request.getPost().then(res => {
                    this.postsData = res.data
                })
            },
            async createPostt(event) {
                event.preventDefault()
                if (!this.newPostText) {
                    alert('Escreve sobre algo para publicar')
                    return
                }

                let params = {about_post: this.newPostText}
                await this.request.createPost(params).then(res => {
                    alert(res.data.message)
                    this.$router.push({name: 'home'})
                })
            }
        }
    }


</script>