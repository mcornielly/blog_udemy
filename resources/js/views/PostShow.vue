<template>
<article class="post container">

    <!-- @include($post->viewType()) -->

    <div class="content-post">

        <post-header :post="post"></post-header>    
        <div class="image-w-text">
          <div>
            <p v-html="post.body"></p>
          </div>
        </div>

        <footer class="container-flex space-between">

          <social-links :description="post.title"></social-links>

          <div class="tags container-flex">
                <div class="tags container-flex">
                    <span class="tags c-gray-1 text-capitalize" v-for="tag in post.tags" :key="tag.id">
                        <tag-link :tag="tag"></tag-link>       
                    </span>
                </div>
          </div>
      </footer>
      <div class="comments">
      <div class="divider"></div>
            <disqus-comments></disqus-comments>
        </div><!-- .comments -->
    </div>
</article>
</template>
<script>
export default {
    props:['url'],
    data(){
        return{
            post:{
                user:{},
                category:{}
            }
        }
    },
    mounted(){
        axios.get(`/api/blog/${this.url}`)
            .then(res => {
                this.post = res.data;
            }).catch(err =>{
                console.log(err.response .data);
            })
    }
}
</script>