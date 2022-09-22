export default [
      // Posts
  
    {
        path: '/post/list',
        name: 'post-list',
        component: () => import('../components/Post/PostList.vue')
    },
    {
        path: '/post/create',
        name: 'post-create',
        component: () => import('../components/Post/PostCreate.vue')
    },
    {
        path: 'post/update/:id',
        name: 'post-update',
        component: () => import('../components/Post/PostUpdate.vue')
    },
    {
        path: 'post/delete/:id',
        name: 'post-update',
        component: () => import('../components/Post/PostDelete.vue')
    },
    {
        path: '/post/show/:id',
        name: 'post-show',
        component: () => import('../components/Post/PostShow.vue'),
    },
]