import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

const router = new VueRouter({
    routes : [
        {
            path : '/', component : require('./views/home/index.vue').default
        },
        {
            path : '/admin/category', component : require('./views/category/index.vue').default
        },
        {
            path : '/admin/typenews', component : require('./views/typenews/index.vue').default
        },
        {
            path : '/admin/news', component : require('./views/news/index.vue').default
        },
        {
            path : '/admin/users', component : require('./views/users/index.vue').default
        },
        {
            path : '/admin/comment', component : require('./views/comment/index.vue').default
        },
    ]
})

export default router
