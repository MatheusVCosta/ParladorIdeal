<template>
    <div 
        class="
        mx-auto
        flex 
        flex-col
        items-center
        justify-around
        "
    >
    <img src="../../public/logo/default_transparent_765x625.png" alt="">
    <RegisterForm/>
    <p class="text-orange-400">Atlas Shrugged</p>
    </div>
</template>

<script>
    import RegisterForm from '@/components/Forms/RegisterForm.vue';
    export default {
        name: 'RegisterView',
        components: {
            RegisterForm,
        },
    }

</script>