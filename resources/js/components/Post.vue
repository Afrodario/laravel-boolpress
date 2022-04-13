<template>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{title}}</h5>
            <img :src="img">
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
    props: ['title', 'content', 'slug', 'category', 'tags', 'img', 'category_id'],
    data() {
        return {
            categories: []
        }
    },

    methods: {
        getCategories(apiPage) {
            axios.get('/api/posts', {
                'params': {
                    'page': apiPage
                }
            }).then((response) => {
                this.categories = response.data.categoryList;
                console.log(this.categories);
            });
        }
    },

    mounted() {
        this.getCategories(1);
    }
}
</script>

<style>

</style>