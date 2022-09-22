require('./bootstrap');

// Import dependencies
import { createApp } from 'vue';
import { createPinia } from 'pinia';

// Import routes
import router from './routes/index';

// Import components
import App from './App.vue';

// Vue app creation
const app = createApp(App);
app.use(router);
app.use(createPinia());
app.mount('#app');