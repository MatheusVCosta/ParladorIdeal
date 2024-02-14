<template>
    <div>
        <h1 class="text-orange-400 text-center mb-8 text-2xl font-bold">{{ this.titlePage }}</h1>
        <div v-if="typeof postsData.data == 'undefined'">
            {{ postsData.message }}
        </div>
        <div v-for="(post, i) in postsData.data" :key="i">
            <card :post="post" :modeEdited="mypost"></card>
        </div>
    </div>
</template>


<script>
    import card from '@/components/CardPost.vue'
    import { request } from '@/http/request'

    export default {
        name: 'HomeView',
        props: {
            action: 'home',
        },  
        components: {
            card
        },
        data() {
            return {
                postsData: {},
                request: request(),
                mypost: false,
                titlePage: 'Ultimas publicações'
               
            }
        },
        created() {
            this.mypost = this.action == "mypost" ? true : false
            this.titlePage = this.mypost ?  "Minhas publicações" : 'Ultimas publicações'
            this.getPosts(this.mypost)
        },
        watch: {
             '$route'() {
                this.mypost = this.action == "mypost" ? true : false
                this.titlePage = this.mypost ?  "Minhas publicações" : 'Ultimas publicações'
                this.getPosts(this.mypost)
            }
        },  
        methods: {
            async getPosts(mypost = false) {

                if (mypost) {
                    return await this.request.getMyPosts().then(res => {
                        this.postsData = res.data
                    })
                }
                return await this.request.getPost().then(res => {
                    this.postsData = res.data
                })

            }
            
        }
    }


</script>