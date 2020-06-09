<template>
    <section class="pages container">
        <div class="page page-archive">
            <h1 class="text-capitalize">archive</h1>
            <p>Nam efficitur, massa quis fringilla volutpat, ipsum massa consequat nisi, sed eleifend orci sem sodales lorem. Curabitur molestie eros urna, eleifend molestie risus placerat sed.</p>
            <div class="divider-2" style="margin: 35px 0;"></div>
            <div class="container-flex space-between">
                <div class="authors-categories">
                    <h3 class="text-capitalize">authors</h3>
                    <ul class="list-unstyled">
                        <li v-for="user in users" :key="user.id" v-text="user.name"></li>
                    </ul>
                    <h3 class="text-capitalize">categories</h3>
                    <ul class="list-unstyled">
                        <li v-for="category in categories" :key="category.id" class="text-capitalize">
                            <category-link :category="category"></category-link>    
                        </li>
                    </ul>
                </div>
                <div class="latest-posts">
                    <h3 class="text-capitalize">latest posts</h3>
                        <p v-for="post in posts" :key="post.id">
                            <post-link :post="post">{{ post.title }}</post-link>
                        </p>
                    <h3 class="text-capitalize">posts by month</h3>
                    <ul class="list-unstyled">
                        <!-- @foreach ($publishes as $publish)
                        <a href="{{ route('pages.home', ['month' => $publish->month, 'year' => $publish->year] ) }}">
                            <li class="text-capitalize">{{ $publish->monthname }} - {{ $publish->year }} ({{ $publish->posts }})</li>
                        </a>
                        @endforeach -->
                        <li v-for="publish in publishes" :key="publish.id" class="text-capitalize">{{ publish.monthname }} - {{ publish.year }} ({{ publish.posts }})</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data(){
        return {
            publishes: [],
            users: [],
            categories: [],
            posts: []
        }
    },
    mounted() {
        axios.get('/api/archivo').then(res =>{
            // console.log(res.data[0].publishes)
            this.publishes = res.data[0].publishes;
            this.users = res.data[0].users;
            this.categories = res.data[0].categories;
            this.posts = res.data[0].posts;
        }).catch(err =>{
            console.log(err);
        });
    }
}
</script>