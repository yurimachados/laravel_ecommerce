import './bootstrap';
import '../css/app.css';
import { library, dom } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
library.add(fas);
dom.watch();

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const app = createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const appInstance = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue);
        appInstance.component('FontAwesomeIcon', FontAwesomeIcon);
        appInstance.mount(el);
        appInstance.config.globalProperties.$route = route;
    },
    progress: {
        color: '#4B5563',
    },
});