<template>
    <!-- App is loading -->
    <section id="page-content" style="display: none;" v-show="appIsLoading">
        <div class="row">
            <Menu />
            <div class="col-md-9" v-if="appIsLoading">
                <div class="container">
                    <UserMenu />
                    <router-view />
                </div>
            </div>
        </div>
    </section>
    <!-- App is not loading -->
    <section id="loading" v-show="appIsLoading === false" style="text-align: center;">
        <div class="spinner-border" style="color: #3cb295; width: 75px; height: 75px; margin-top: 150px; margin-bottom: 150px;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </section>
</template>

<script setup>
// Import dependencies
import { ref } from 'vue';

// Import stores
import { usePostsStore } from '/stores/Posts';

// Define stores constants
const usersStore                     = useUsersStore();
const postsStore                     = usePostsStore();

// Define promises
const promise1 = new Promise((resolve, reject) => {
    try{
        resolve(usersStore.loadUserAuth());
    }
    catch(e){
        reject(e);
    }
});

const promise2 = new Promise((resolve, reject) => {
    try{
        resolve(postsStore.loadPosts())
    }
    catch(e){
        reject(e);
    }
});
</script>
<script>

    import { mapActions } from "pinia";
    import { useUserStore } from "./store/user";
    import { useActivitiesStore } from "./store/activities";
    import { useCategoriesStore } from "./store/categories";
    
    export default {
        name: "App",
        created () {
            this.load();
            this.findAllCategories();
            this.locateUser();
            this.loadUser();
        },
        methods: {
            ...mapActions(useActivitiesStore, ['load']),
            ...mapActions(useCategoriesStore, ['findAllCategories']),
            ...mapActions(useUserStore, ['locateUser', 'loadUser']),
        }
    }
    
    </script>
    


    <script setup>
        // Import dependencies
        import { ref } from 'vue';
        
        // Import stores
        import { usePostsStore } from '/stores/Posts';
        
        // Define stores constants
        // const usersStore                     = useUsersStore();
        const postsStore                     = usePostsStore();
        
        // Define promises
        // const promise1 = new Promise((resolve, reject) => {
        //     try{
        //         resolve(usersStore.loadUserAuth());
        //     }
        //     catch(e){
        //         reject(e);
        //     }
        // });
        
        const promise2 = new Promise((resolve, reject) => {
            try{
                resolve(postsStore.loadPosts())
            }
            catch(e){
                reject(e);
            }
        });
        </script>