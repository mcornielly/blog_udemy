<template>
    <article class="post">
        <!-- @include($post->viewType('home')) -->
        <div class="content-post">
            <!-- header -->
            <post-header :post="post"></post-header>
            <p v-html="post.excerpt"></p>
            <footer class="container-flex space-between">
                <div class="read-more">
                    <!-- <a href="#" class="text-uppercase c-green">Leer más</a> -->
                    <!-- <router-link :to="{name: 'post_show', params: {url: post.url}}" class="text-uppercase c-green">Leer más</router-link> -->
                    <post-link :post="post" class="text-uppercase c-green">Leer más</post-link>
                </div>
                <div class="tags container-flex">
                    <span class="tags c-gray-1 text-capitalize" v-for="tag in post.tags" :key="tag.id">
                        <!-- <router-link :to="{ name: 'tags_post', params: { tag: tag.url }}">#{{ tag.name }}</router-link>  -->
                        <tag-link :tag="tag"></tag-link>       
                    </span>
                </div>
            </footer>
        </div>
    </article>
</template>

<script>
export default {
    props:['post']
}
</script>