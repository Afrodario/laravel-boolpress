<template>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Boolpress</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <!-- Un componente specifico di Vue Router richiama la sua logica interna che evita di fare la chiamata verso
            il server ad ogni click del link e quindi di ricaricare la pagina-->
            <router-link class="nav-link" :to="{name: 'home'}">Home</router-link>
            <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'about'}">Chi Siamo</router-link>
            <!-- <a class="nav-link" href="#">Chi Siamo</a> -->
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'contact'}">Contatti</router-link>
            <!-- <a class="nav-link" href="#">Contatti</a> -->
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'posts'}">Post</router-link>
            <!-- <a class="nav-link" href="#">Contatti</a> -->
          </li>


          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
  </header>
</template>

<script>
export default {
    name: 'Header'
}
</script>

<style>
  /* Classe specifica dell'active del componente router link */
 .router-link-exact-active {
   text-transform: uppercase;
 }
</style>