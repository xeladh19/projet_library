import { defineStore } from "pinia";

export const useCategoriesStore = defineStore("categories", {
    id:"categories",
    state: () => ({
         categories: {} ,
         category: {
             id:                    null,
             name:                  null,
             created_at:            null,
             categories_users_id:   null,

         }

}),
getters: {},
actions: {
    async findAllCategories(){
        const response = await fetch("/api/categories");
        const categories = await response.json();
        this.setState({ categories });
    }

},

});



