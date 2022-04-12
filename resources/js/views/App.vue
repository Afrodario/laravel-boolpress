<template>
  <div>
    <Header></Header>
    <BlogMain/>
    <Footer></Footer>
  </div>
</template>

<script>
import BlogMain from '../components/BlogMain.vue';
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';

export default {
    name: 'App',
    components: {
      BlogMain,
      Header,
      Footer
    }
}
</script>

<style>

</style>