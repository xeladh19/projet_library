import axios from "axios";
import { defineStore } from "pinia";
import { useRouter } from "vue-router";

export const useUsersStore = defineStore('users', {
    id:"users",
    state: () => ({
        userAuth:           {},
        users:              {},
        user:               {
            id:                     '',
            firstname:              '',
            lastname:               '',
            email:                  '',
            password:               '',
        },
        errors:             {},
        message:            null,
        password:           {
            old:            '',
            new:            '',
            confirm:        '',
        },
        router:             useRouter(),
    }),
    getters: {
        getUserAuth: (state) => {
            return state.userAuth;
        },
        getUsers: (state) => {
            return state.users;
        },
        getUser: (state) => {
            return state.user;
        },
        getPassword: (state) => {
            return state.password;
        },
        getMessage: (state) => {
            return state.message;
        },
        getErrors: (state) => {
            return state.errors;
        },
        getFirstnameAndLastnameById: (state) => (id) => {
            if(id.split(',').length > 1){
                let userArray = [];
                id.split(',').forEach(userId => {
                    state.users.find(user => {
                        if(user.id === Number(userId)){
                            userArray.push(user.firstname + ' ' + user.lastname);
                        }
                    })
                });
                return userArray.join(', ');
            }
            else if(id.split(',').length === 1){
                return users.find(user => user.id === Number(id)).firstname + ' ' + users.find(user => user.id === Number(id)).lastname;
            }
        },
        getUserById: (state) => (id) => { 
            if(typeof id === 'string'){
                return state.users.find(user => user.id === Number(id));
            }
            else if(typeof id === 'number'){
                return state.users.find(user => user.id === id);
            }
        }
    },
    actions: {
        // Api request for load all users
        async loadUsers(){
            await axios.get('/api/users').then(reponsePHP => {
                this.users = reponsePHP.data;
            });
        },
        // Api request for load connected user
        async loadUserAuth(){
            await axios.get('/api/users/auth').then(reponsePHP => {
                this.userAuth = reponsePHP.data;
            });
        },
        // Load one user by id
        async show(id){
            this.errors = [];
            await axios.get('/api/users/show/' + id).then(reponsePHP => {
                this.user = reponsePHP.data;
            });
        },
        // Api request for update user
        update(formData){
            // Set Timeout for address function end before set data
            setTimeout(() => {
                // Reset errors
                this.errors = [];
                // Append user 
                let user = null;
                if(typeof this.user.id == 'number'){
                    user = this.user;
                    formData.append('form', JSON.stringify(this.user));
                }
                else{
                    user = this.userAuth;
                    formData.append('form', JSON.stringify(this.userAuth));
                }
                // Send request
                    axios.post('/api/users/update/' + user.id, formData).then( (responsePHP) => {
                        const user                  = responsePHP.data;
                        const foundIndex            = this.users.findIndex(users => users.id === responsePHP.data.id);
                        this.users[foundIndex]      = user;
                        this.user                   = user;
                        if(responsePHP.data.id === this.userAuth.id){
                            this.userAuth = user;
                        }
                    }).catch((error) => {
                        if(error.response.status === 422){
                            this.errors = error.response.data.errors || {};
                        }
                        else{
                            console.log(error)
                        }
                    });
            }, 1000);
        },
        // Api request for destroy user
        async destroy(id){
            // Send request
            await axios.post('/api/users/destroy/' + id, { userId: id }).then( (responsePHP) => {
                let user = this.users.find(users => users.id === responsePHP.data.id);
                user.status = responsePHP.data.status;
                this.router.push({name: 'users-list'}); 
            }).catch((error) => {
                console.log(error)
            });
        },
        // Api requets for create user
        async create(form){
            // Reset errors
            this.errors = [];
            // Send request
            await axios.post('/api/users/create', form).then( (responsePHP) => {
                this.users.push(responsePHP.data);
                this.router.push({name: 'users-list'}); 
            }).catch((error) => {
                if(error.response.status === 422){
                    this.errors = error.response.data.errors || {};
                }
                else{
                    console.log(error)
                }
            });
        },
        // Update password
        updatePassword(){
            // Reset errors
            this.errors = [];
            // Send request
            axios.post('/api/users/updatePassword/' + this.userAuth.id, this.password).then( (responsePHP) => {
                this.userAuth = responsePHP.data;
                this.password = {
                    password: {
                        old: '',
                        new: '',
                        new_confirmation: ''
                    }
                };
                this.message = "Votre mot de passe a bien été modifié";
            }).catch((error) => {
                if(error.response.status === 422){
                    this.errors = error.response.data.errors || {};
                }
                else{
                    console.log(error)
                }
            });
        },
    },
})