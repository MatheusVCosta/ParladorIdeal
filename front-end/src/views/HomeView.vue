<template>
    <div 
        class="
        flex 
        flex-col
        w-full">
        <headerHome @logout="makeLogout"/>
    
        <div  class="flex flex-col p-8 mt-20">
            <loadCard :action="this.$route.name"></loadCard>
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
    import { request } from '@/http/request'
    import navMenu from '@/components/navBottomMenu.vue'
    import headerHome from '@/components/header.vue'
    import loadCard from '@/components/LoadCards.vue'
    import openModal from '@/components/Modal/ModalSuccess.vue'

    export default {
        name: 'HomeView',
        components: {
            loadCard,
            navMenu,
            headerHome,
            openModal
        },
        data() {
            return {
                request: request(),
                postsData: {},
                messageModal: '',
                messageModalArr: [],
                showModalBool: false,
                modalName: ''
            }
        },
        mounted() {
            if (!!this.$route.query.sendMessage) {
                this.messageModal = this.$route.query.sendMessage
                this.modalName = this.$route.query.modalName
                this.showModalBool = this.$route.query.activate
            }
            
        },
        methods: {
            makeLogout() {
                this.messageModal  = "Deseja sair?"
                this.modalName     = "question"
                this.showModalBool = true
            },
            close(close) {
                this.showModalBool = close
            },
            responseModal(response) {
                if (response) {
                    this.request.logout().then(res => {
                        this.$router.replace({name: 'login'})
                    })
                }
                this.showModalBool = false
            }
        }
        
    }
</script>