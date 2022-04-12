<template>
    <!-- Posso accedere allo slug che è stato immagazzinato nei params della variabile route -->
  <div>{{$route.params.slug}}</div>
</template>

<script>
export default {
    name: 'SinglePost',
    // Al created farò una chiamata axios sulla rotta specifica e recuperare i dati
}
</script>

<style>

</style>