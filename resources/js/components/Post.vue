<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{title}}</h5>
            <img :src="cover" class="img-thumbnail" :alt="title">
            <div class="my-3" v-for="category in categories" :key="category.id">
                <span v-if="category.id == category_id">
                    Genere: <strong>{{category.name}}</strong>
                </span>
            </div>
            <p class="card-text">{{content.substr(0, 130)}}...</p>
            <!-- <a href="#" class="btn btn-primary">Vai all'articolo completo</a> -->
            <!-- La sintassi params è specifica di Vue Router per recuperare l'informazione del post a cui indirizzare
                slug è la parte dinamica della rotta, definita in router.js -->
            <router-link class="btn btn-primary" :to="{name: 'single-post', params: {slug: slug}}">
                Vai all'articolo completo
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Post',
    props: ['title', 'content', 'slug', 'category', 'tags', 'cover', 'category_id', 'categories'],
    data() {
        return {

        }
    },
}
</script>

<style>

</style>