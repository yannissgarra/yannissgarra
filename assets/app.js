import './assets/css/app.css';
import '@fortawesome/fontawesome-free/js/regular';
import '@fortawesome/fontawesome-free/js/solid';
import '@fortawesome/fontawesome-free/js/brands';
import '@fortawesome/fontawesome-free/js/fontawesome';

import { createApp } from 'vue';
import darkModeStore from './stores/darkModeStore';
import DarkModeToggler from './components/DarkModeToggler.vue';

createApp(DarkModeToggler)
  .use(darkModeStore)
  .mount('#dark-mode-toggler');
