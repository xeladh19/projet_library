<template>
    <h1 class="mb-4 text-xl font-bold text-gray-700">Categories</h1>
        <div class="flex flex-col max-w-sm px-4 py-6 mx-auto bg-white rounded-lg shadow-md">
    <ul>
        <li>
            <a v-for="category in categoriesStore.getCategories" :key="category.id" :value="category"
                href="#"
                class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline"
                >{{ category }}</a>
        </li>
     
    </ul>
    </div>
</template>

<script>
import { useCategoriesStore } from "../store/Categories";
const categoriesStore = useCategoriesStore();
</script>
<style> 

</style>