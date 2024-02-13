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
            p-8
            mt-20
            ">
            <div v-if="typeof postsData.data == 'undefined'">
                {{ postsData.message }}
            </div>
            
            <div v-for="(post, i) in postsData.data" :key="i">
                <card :post="post"></card>
            </div>

            <navMenu class="w-3/5"></navMenu>
        </div>
    </div>
</template>

<script>
    import card from '@/components/CardPost.vue'
    import navMenu from '@/components/navBottomMenu.vue'
    import headerHome from '@/components/header.vue'

    import { request } from '@/http/request'

    export default {
        name: 'HomeView',
        components: {
            card,
            navMenu,
            headerHome
        },
        data() {
            return {
                postsData: {},
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

            }
        }
    }


</script>