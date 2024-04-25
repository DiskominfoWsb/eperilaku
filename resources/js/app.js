import "./bootstrap";
import "../css/app.css";
import "toastr/build/toastr.min.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
// import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import ziggyRoute from "./routers";
import { Ziggy } from "./ziggy";

window.route = (name, params) => ziggyRoute(name, params, false, Ziggy);

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
