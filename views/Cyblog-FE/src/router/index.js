import Vue from 'vue'
import Router from 'vue-router'
import Blog from '@/pages/Blog'
import Category from '@/pages/Category'
import Article from '@/pages/Article'
import Timeline from '@/pages/Timeline'
import Experiment from '@/pages/Experiment'
import About from '@/pages/About'

Vue.use(Router)

const router = new Router({
    routes: [
        {
            path: '/',
            name: 'Blog',
            meta: {
                title: 'Blog'
            },
            component: Blog
        },
        {
            path: '/category',
            name: 'Category',
            meta: {
                title: 'Category'
            },
            component: Category
        },
        {
            path: '/timeline',
            name: 'Timeline',
            meta: {
                title: 'Timeline'
            },
            component: Timeline
        },
        {
            path: '/blog/:id',
            name: 'Article',
            meta: {
                title: 'Article'
            },
            component: Article
        },
        {
            path: '/experiment',
            name: 'Experiment',
            meta: {
                title: 'Experiment'
            },
            component: Experiment
        },
        {
            path: '/about',
            name: 'About',
            meta: {
                title: 'About'
            },
            component: About
        }
    ]
})
router.beforeEach((to, from, next) => {
    //  路由发生变化修改页面title
    if (to.meta.title) {
        document.title = to.meta.title
    }
    next()
})

export default router
