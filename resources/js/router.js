//Importazione di Vue e Vue Router
import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

//Sintassi per definire la rotta che risponda alle pagine
import Home from './pages/Home';
import About from './pages/About.vue';
import Contact from './pages/Contact.vue';
import Posts from './pages/Posts.vue';
import SinglePost from './pages/SinglePost.vue';
import NotFound from './pages/NotFound.vue';

const router = new VueRouter({
    //Modalità di funzionamento (con opportuna configurazione delle rotte catch-all, cioè route::any in web.php)
    //ci consente di avere una struttura tipo www.ilmiosito.it/blog/post
    mode: 'history',
    //Definizione delle rotte come array di oggetti
    routes: [
        {
            //Quando si richiede la barra, devi renderizzare il componente home
            path: '/',
            name: 'home',
            component: Home
        },
        {
            //Quando si richiede la path chi-siamo, devi renderizzare il componente about
            path: '/chi-siamo',
            name: 'about',
            component: About
        },
        {
            //Quando si richiede la path chi-siamo, devi renderizzare il componente about
            path: '/contatti',
            name: 'contact',
            component: Contact
        },
        {
            //Quando si richiede la path chi-siamo, devi renderizzare il componente about
            path: '/blog',
            name: 'blog',
            component: Posts
        },
        {
            //Quando si richiede la path chi-siamo, devi renderizzare il componente about
            //:slug è la parte dinamica dell'URL, con la sintassi di Vue JS che equivale a Route::get('/blog/{slug}') di Laravel
            path: '/blog/:slug',  
            name: 'single-post',
            component: SinglePost
        },
            //FALLBACK
            //Rotta catch-all che entra in azione quando la pagina non esiste e rimanda al componente NotFound
            //Inseriscila al termine delle rotte (è sempre un file JAVASCRIPT)
        {
            path: '/*', //sintassi "prendi-tutto" dopo la barra, alternativa è /:pathMatch(.*)*
            name: 'not-found',
            component: NotFound
        }
    ]
});

//Esportazione della costante per utilizzarla in un altro file javascript
export default router 