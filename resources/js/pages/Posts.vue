<template>
  <main>

        <div class="container">

            <h1 class="text-center">Elenco dei post</h1>
            <div class="row">
                
                <div class="col-4" v-for="post in posts" :key="post.id">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{post.title}}</h5>
                            <img :src="post.img">
                            <span>{{post.category_id}}</span>
                            <p class="card-text">{{post.content.substr(0, 130)}}...</p>
                            <a href="#" class="btn btn-primary">Vai all'articolo completo</a>
                        </div>
                    </div>
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
export default {
    name: 'BlogMain',

    data() {
        return {
            posts: [],
            currentPage: 1,
            lastPage: null
        }
    },

    methods: {
        getPosts(apiPage) {
            axios.get('/api/posts', {
                'params': {
                    'page': apiPage
                }
            }).then((response) => {
                console.log(response);
                this.currentPage = response.data.results.current_page;
                this.posts = response.data.results.data;
                this.lastPage = response.data.results.last_page;
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