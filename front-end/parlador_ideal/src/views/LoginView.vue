<template>
    <div 
        class="
        flex 
        flex-col
        items-center
        justify-around
        "
    >
    <img src="../../public/logo/default_transparent_765x625.png" alt="">
    <LoginForm/>
    <p class="text-orange-400">Atlas Shrugged</p>
    </div>
</template>

<script>
    import LoginForm from "@/components/Forms/LoginForm.vue"
    export default {
        name: 'LoginView',
        components: {
            LoginForm,
        },
    }

</script>