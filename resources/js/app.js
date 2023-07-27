// app.js
require('./bootstrap');
import router from './routes/routes.js'
import { createApp } from 'vue'
import App from './components/App.vue';
import {store} from './store/store';
import '../css/app.css'; // Import your global CSS file here
/* import 'bootstrap/dist/css/bootstrap.css'; */
createApp({
    components: { App },
})
.use(store)
.use(router)
.mount('#app')
