<template>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Boolpress</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active" v-for="menuItem in menuItems" :key="menuItem.routeName">
            <!-- Un componente specifico di Vue Router richiama la sua logica interna che evita di fare la chiamata verso
            il server ad ogni click del link e quindi di ricaricare la pagina-->
            <router-link class="nav-link" :to="{name: menuItem.routeName}">{{menuItem.label}}</router-link>
          </li>
        </ul>

        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="/admin">Pannello amministrazione</a>
          </li>
        </ul>

      </div>
    </nav>
  </header>
</template>

<script>
export default {
    name: 'Header',
    data() {
        return {
            menuItems: [
                {
                    routeName: 'home',
                    label: 'Home'
                },
                {
                    routeName: 'about',
                    label: 'Chi Siamo'
                },
                {
                    routeName: 'contact',
                    label: 'Contatti'
                },
                {
                    routeName: 'blog',
                    label: 'Blog'
                },
            ]
        }
    }
}
</script>

<style>
  /* Classe specifica dell'active del componente router link */
 .router-link-exact-active {
   text-transform: uppercase;
 }
</style>