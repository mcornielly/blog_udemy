<template>
    <section class="posts container">

        <post-list-item v-for="post in items" :key="post.id" :post="post"></post-list-item> 

        <article v-if="!items.length" class="post">
            <div class="content-post">
                <h1>No hay publicaciones todavía.</h1>
                <div class="divider"></div>
            </div>
        </article>
    
    </section><!-- fin del div.posts.container -->

</template>

<script>
export default {
    props:['items']
}
</script>