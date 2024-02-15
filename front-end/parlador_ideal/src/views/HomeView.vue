<template>
    <div 
        class="
        flex 
        flex-col
        w-full">
        <headerHome></headerHome>
    
        <div  class="flex flex-col p-8 mt-20">
            <loadCard :action="this.$route.name"></loadCard>
            <navMenu class="w-3/5"></navMenu>
        </div>
        <openModal 
            :activate="showModalBool" 
            :message="messageModal"
            :onModalName="modalName"
            @closeModal="showModalBool"
        />
    </div>
</template>

<script>
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
                postsData: {},
                messageModal: '',
                messageModalArr: [],
                showModalBool: false,
                modalName: ''
            }
        },
        mounted() {
            this.messageModal = this.$route.query.sendMessage
            this.modalName = this.$route.query.modalName
            this.showModalBool = this.$route.query.activate
        }
    }
</script>