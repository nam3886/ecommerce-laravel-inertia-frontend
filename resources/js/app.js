require("./bootstrap");

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import mitt from "mitt";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

const emitter = mitt();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}`),
    setup({ el, app, props, plugin }) {
        const vueApp = createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } });

        vueApp.config.globalProperties.emitter = emitter;
        vueApp.config.globalProperties.$baseUrl = route().t.url;

        return vueApp.mount(el);
    },
});

InertiaProgress.init({ color: "#26c" });
