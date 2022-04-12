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

const router = new VueRouter({
    //Modalità di funzionamento (con opportuna configurazione delle rotte catch-all, cioè route::any in web.php)
    mode: 'history',
    //Definizione delle rotte
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
            path: '/posts',
            name: 'posts',
            component: Posts
        },
        {
            //Quando si richiede la path chi-siamo, devi renderizzare il componente about
            path: '/posts/:slug',  //:slug è la parte dinamica dell'URL, con la sintassi di Vue JS che equivale a {slug} di Laravel
            name: 'single-post',
            component: SinglePost
        }
    ]
});

//Esportazione della costante per utilizzarla in un altro file javascript
export default router 