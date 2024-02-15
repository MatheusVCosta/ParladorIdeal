<template>
    <div>
        <div
        class="
            block 
            p-6
            mb-5
            bg-orange-400
            "
            @click="editPost"    
        >

        <h5 class="
            mb-2 
            text-2xl 
            font-bold
            tracking-tight 
            text-white
            ">
                {{ post.user.name }} :
            </h5>
            <p class="font-normal text-white text-justify break-words" >
                {{ post.about_post }}
            </p>
            <span class="text-md text-white float-end">{{ formatDate(post.created_at) }}</span>
    </div>
    </div>
     
</template>

<script>

    export default {
        props: {
            post: {},
            modeEdited: false
        },
        methods: {
            formatDate(postDate) {
                postDate = new Date(postDate)
                const day = String(postDate.getDate()).padStart(2, '0');
                const month = String(postDate.getMonth() + 1).padStart(2, '0');
                const year = postDate.getFullYear();
                const hour = String(postDate.getHours()).padStart(2, '0');
                const minutes = String(postDate.getMinutes()).padStart(2, '0');
                const seconds = String(postDate.getSeconds()).padStart(2, '0');

                return `${day}/${month}/${year} ${hour}:${minutes}:${seconds}`;

            },
            editPost(event) {
                event.preventDefault()
                if (this.modeEdited) {
                    this.$router.push({name: 'post', query: {mode: 'edit', postId: this.post.id}})
                }
                else {
                    return false
                }
            }
        }
    }

</script>