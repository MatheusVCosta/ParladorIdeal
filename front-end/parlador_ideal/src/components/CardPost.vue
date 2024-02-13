<template>
    <div>
        <div
        class="
            block 
            max-w-sm p-6
            mb-5
            bg-orange-400
            w-screen
            ">

        <h5 class="
            mb-2 
            text-2xl 
            font-bold
            tracking-tight 
            text-white">
                {{ post.user.name }} :
            </h5>
            <p class="font-normal text-white">
                {{ post.about_post }}
            </p>
    </div>
    </div>
     
</template>

<script>

    export default {
        props: {
            post: ''
        }
    }

</script>