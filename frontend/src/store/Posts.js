import { defineStore } from "pinia";

export const usePostsStore = defineStore("posts", {
    id: "posts",
    state: () => ({
        posts: {},
        post: {
            id: null,
            title: null,
            content: null,
            image: null,
            created_at: null,
            posts_users_id: null,
            posts_categories_id: null,
        },
    }),
    getters: {},
    actions: {
        // async findAllPosts() {
        //     const response = await fetch("/api/posts");
        //     const posts = await response.json();
        //     this.setState({ posts });
        // },
          
          async loadPosts(){
            await axios.get('/api/posts').then(responsePHP => (this.posts = responsePHP.data));
        },
        // Api request for load one order
        async show(id){
            await axios.get('/api/posts/show/' + id).then(responsePHP => (this.post = responsePHP.data));
        },
        async create(formData){
            this.pictures = [];
            // Reset errors
            this.errors = [];
            // Send request
            await axios.post('/api/posts/create', formData).then( (responsePHP) => {
                this.posts.push(responsePHP.data);
                this.router.push({name: 'posts'}); 
            }).catch((error) => {
                if(error.response.status == 422){
                    this.errors     = error.response.data.errors;
                    let fileName    = Object.keys(error.response.data.errors)[0].replace('_', '.');
                    formData.delete(fileName);
                }
                else{
                    console.log(error);
                }
            });
        },
        async update(formData){
            // Append formData
            formData.append('form', JSON.stringify(this.post));
            // Reset errors
            this.errors = [];
            // Send request
            await axios.post('/api/posts/update/' + this.posts.id, formData).then( (responsePHP) => {
                const posts                         = responsePHP.data;
                const foundIndex                    = this.posts.findIndex(posts => posts.id === responsePHP.data.id);
                this.posts[foundIndex]              = post;
                this.post                           = post;
                for(let picture in responsePHP.data.pictures){
                    formData.delete(responsePHP.data.pictures[picture]);
                }
            }).catch((error) => {
                if(error.response.status == 422){
                    this.errors     = error.response.data.errors;
                    let fileName    = Object.keys(error.response.data.errors)[0].replace('_', '.');
                    formData.delete(fileName);
                }
                else{
                    console.log(error);
                }
            });
        },
    },
});
