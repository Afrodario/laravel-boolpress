<template>
    <!-- Posso accedere allo slug che è stato immagazzinato nei params della variabile route
    posso visualizzarla tramite l'ispettore di Vue tramite {{$route.params.slug}}-->
  <div class="container">

      <div class="row">

        <div class="col">
          
          <div class="card">
            <div class="card-body" v-if="post">
              <h1 class="card-title">{{post.title}}</h1>
              <img :src="post.img">
              <h3 v-if="post.category">Categoria: {{post.category.name}}</h3>
              <p>{{post.content}}</p>
              <span>Tags:</span>
              <ul>
                <li v-for="tag in post.tags" :key="tag.id">
                  {{tag.name}}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

  </div>

</template>

<script>
export default {
    name: 'SinglePost',

    data() {
      return {
        post: null
      }
    },


    // Al mounted farò una chiamata axios sulla rotta specifica e recuperare i dati
    mounted() {
      //Mi serve richiamare il riferimento dello slug, attenzione al this
      const slug = this.$route.params.slug;

      //La chiamata axios avrà la parte di URI fissa che già conosco e una append del riferimento allo slug
      axios.get('/api/posts/' + slug).then(response => {

        console.log(response);

        if (response.data.success == false) {
          //Sintassi per forzare Vue Router al reindirezzamento ad una pagina specifica, in questo caso not found
          this.$router.push({name: 'not-found'})
        } else {
          this.post = response.data.result;
        }

      });
    }
}
</script>

<style>

</style>