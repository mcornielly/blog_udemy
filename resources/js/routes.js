import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'home',
            component: require('./views/Home').default
        },
        {
            path: '/nosotros',
            name: 'about',
            component: require('./views/About').default
        },
        {
            path: '/archivo',
            name: 'archive',
            component: require('./views/Archive').default
        },
        {
            path: '/contacto',
            name: 'contac',
            component: require('./views/Contact').default
        },
        {
            path: '/blog/:url',
            name: 'post_show',
            component: require('./views/PostShow').default,
            props: true
        },
        {
            path: '/categorias/:category',
            name: 'category_post',
            component: require('./views/CategoryPost').default,
            props: true
        },
        {
            path: '/etiquetas/:tag',
            name: 'tags_post',
            component: require('./views/TagsPost').default,
            props: true
        },
        {
            path: '*',
            component: require('./views/404').default
        }

    ],
    linkExactActiveClass: 'active',
    mode: 'history',
    scrollBehavior(){
        return {x:0, y:0};
    } 

});