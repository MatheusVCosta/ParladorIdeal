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
    </div>
</template>

<script>
    import navMenu from '@/components/navBottomMenu.vue'
    import headerHome from '@/components/header.vue'
    import loadCard from '@/components/LoadCards.vue'

    export default {
        name: 'HomeView',
        components: {
            loadCard,
            navMenu,
            headerHome
        },
        data() {
            return {
                postsData: {},
            }
        },
    }
</script>