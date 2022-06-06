export default [
    // Dashboard
    {
        path: '/dashboard',
        name: 'dashboard',
        component: () => import('../components/Dashboard.vue'),
        meta: {
            requiresAuth: true
        }
    },
     // Posts
     {
        path: '/dashboard/posts/list',
        name: 'posts-list',
        component: () => import('../components/Tags/PostsList.vue')
    },
    {
        path: '/dashboard/posts/create',
        name: 'posts-create',
        component: () => import('../components/Tags/PostsCreate.vue')
    },
    {
        path: '/dashboard/posts/update/:id',
        name: 'posts-update',
        component: () => import('../components/Posts/PostsUpdate.vue')
    },
    {
        path: '/dashboard/posts/show/:id',
        name: 'posts-show',
        component: () => import('../components/Posts/PostsShow.vue'),
    },
    {
        path: '/dashboard/select-post',
        name: 'select-post',
        component: () => import('../components/Posts/SelectPost.vue'),
    },
    // Users
    {
        path: '/dashboard/users/list',
        name: 'users-list',
        component: () => import('../components/Users/UsersList.vue')
    },
    {
        path: '/dashboard/users/create',
        name: 'users-create',
        component: () => import('../components/Users/UsersCreate.vue')
    },
    {
        path: '/dashboard/users/show/:id',
        name: 'users-show',
        component: () => import('../components/Users/UsersShow.vue')
    },
    {
        path: '/dashboard/users/update/:id',
        name: 'users-update',
        component: () => import('../components/Users/UsersUpdate.vue'),
    },
    // Categories
    {
        path: '/dashboard/categories/list',
        name: 'categories-list',
        component: () => import('../components/Categories/CategoriesList.vue')
    },
    {
        path: '/dashboard/categories/create',
        name: 'categories-create',
        component: () => import('../components/Categories/CategoriesCreate.vue')
    },
    {
        path: '/dashboard/categories/update/:id',
        name: 'categories-update',
        component: () => import('../components/Categories/CategoriesUpdate.vue')
    },
    {
        path: '/dashboard/categories/show/:id',
        name: 'categories-show',
        component: () => import('../components/Posts/CategoriesShow.vue'),
    },
    {
        path: '/dashboard/select-category',
        name: 'select-category',
        component: () => import('../components/Categories/SelectCategory.vue'),
    },
    // Tags
    {
        path: '/dashboard/tags/list',
        name: 'tags-list',
        component: () => import('../components/Tags/TagsList.vue')
    },
    {
        path: '/dashboard/tags/create',
        name: 'tags-create',
        component: () => import('../components/Tags/TagsCreate.vue')
    },
    {
        path: '/dashboard/tags/update/:id',
        name: 'tags-update',
        component: () => import('../components/Tags/TagsUpdate.vue')
    },
    {
        path: '/dashboard/tags/show/:id',
        name: 'tags-show',
        component: () => import('../components/Posts/TagsShow.vue'),
    },
    {
        path: '/dashboard/select-tag',
        name: 'select-tag',
        component: () => import('../components/Tags/SelectTag.vue'),
    },
]