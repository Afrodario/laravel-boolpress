<template>
  <main>

        <div class="container">

            <h1 class="text-center">Elenco dei post</h1>

            <div class="row">
                
                <!-- Tramite refactoring, creo un nuovo componente Post e trasmetto le informazioni tramite le props -->
                <div class="col-4 text-center" v-for="post in posts" :key="post.id">
                    <Post
                        :title='post.title'
                        :cover='post.cover'
                        :content="post.content"
                        :slug="post.slug"
                        :category="post.category"
                        :tags="post.tags"
                        :category_id="post.category_id"
                        :categories="categories"
                    />
                </div>

            </div>

            <!-- Navbar con paginazione che richiama i dati dal metodo getPosts -->
            <nav aria-label="Page navigation example" class="mt-3">
                <ul class="pagination d-flex justify-content-center">
                    <li class="page-item" :class="(currentPage == 1)?'disabled':''" >
                        <span class="page-link" @click="getPosts(currentPage - 1)">Precedente</span>
                    </li>
                    <li class="page-item" :class="(currentPage == lastPage)?'disabled':''">
                        <span class="page-link" @click="getPosts(currentPage + 1)">Successivo</span>
                    </li>
                </ul>
            </nav>

        </div>

    </main>
</template>

<script>
import Post from '../components/Post.vue';

export default {
    name: 'Posts',
    components: {
        Post
    },

    data() {
        return {
            posts: [],
            currentPage: 1,
            lastPage: null,
            categories: []
        }
    },

    methods: {
        getPosts(apiPage) {
            axios.get('/api/posts', { //i params servono a costruire localhost:8000/api/posts?page=numeroPagina
                'params': {
                    'page': apiPage
                }
            }).then((response) => {
                console.log(response);
                this.currentPage = response.data.results.current_page;
                this.posts = response.data.results.data;
                this.lastPage = response.data.results.last_page;
                this.categories = response.data.categoryList;
            });
        }
    },

    //Chiamata axios all'endpoint definito in api.php
    created() {
        this.getPosts(1);
    }
}
</script>

<style>

</style>