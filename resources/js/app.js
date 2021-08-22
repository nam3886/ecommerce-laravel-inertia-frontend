import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import mitt from "mitt";
import messages from "@/constants/messages.js";
import "@stripe/stripe-js";

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

        vueApp.config.globalProperties.$EMITTER = emitter;
        vueApp.config.globalProperties.$MESSAGES = messages;
        vueApp.config.globalProperties.$BASE_URL = route().t.url;

        return vueApp.mount(el);
    },
});

InertiaProgress.init({ color: "#26c" });
