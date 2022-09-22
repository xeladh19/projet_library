<template>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un post') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="my-5">
                <span class="block text-red-500">{{ $error }}</span>         
        </div>

        <form method="POST" @submit-prevent="sendForm()" enctype="multipart/form-data" class="mt-10">
            <!--On a besoin de traiter les images donc on fait un enctype form data -->
            <x-label for="title" value="Titre du post" />
            <x-input id="title" name="title" />

            <x-label for="content" value="Contenu du post" />
            <textarea name="content" id="content" cols="30" rows="10"></textarea>
            
            <x-label for="image" value="Image du post" />
            <x-input id="image" type="file" name="image" />

            <x-label for="category" value="Categorie du post" />


            <select name="category" id="category" v-model="input.post_categories_id">
                    <option v-for="item in postsStore.getPostsCategories" :key="item.id" :value="item.id">{{ item.name }}</option>
            </select>
            <x-button style="display:block !important;" class="mt-5">Créer mon post</x-button>

        </form>
    </div>
</x-app-layout>
</template>

<script setup>
// Import dependencies
import { usePostsStore } from "../store/Posts";
 // Define constante
const postsStore = usePostsStore();
const formData = new FormData();

// Send form
const sendForm = async () => {
    formData.append('form', JSON.stringify(input.value));
    postsStore.create(formData);
}
</script>
    