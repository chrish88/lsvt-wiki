require('./bootstrap');

// Import modules...
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';


Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);



import VueTailwind from 'vue-tailwind';
import TPagination from 'vue-tailwind/dist/t-pagination';
import TButton from 'vue-tailwind/dist/t-button';

const VueTailwindSettings = {
    't-button': {
        component: TButton,
        props: {
            type: 'button',
        }
    },
    't-pagination': {
        component: TPagination,
        props: {
            classes: {
                wrapper: 'table border-collapse text-center bg-white mx-auto shadow-sm',
                element: 'w-8 h-8 border border-gray-200 table-cell hover:border-blue-100',
                activeElement: 'w-8 h-8 border border-gray-200 border-blue-500 table-cell hover:border-blue-600',
                disabledElement: 'w-8 h-8 border border-gray-200 table-cell',
                ellipsisElement: 'w-8 h-8 border border-gray-200 hidden md:table-cell',
                activeButton: 'bg-blue-500 w-full h-full text-white hover:bg-blue-600 transition duration-100 ease-in-out focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50',
                disabledButton: 'opacity-25 w-full h-full cursor-not-allowed transition duration-100 ease-in-out',
                button: 'hover:bg-blue-100 w-full h-full transition duration-100 ease-in-out focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50',
                ellipsis: ''
            },
            tagName: 'div',
            elementTagName: 'a',

        }
    }

}


Vue.use(VueTailwind, VueTailwindSettings);

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);


//crypto js lib
const CryptoJS = require("crypto-js");

window.decrypt = (encrypted) => {
    let key = process.env.MIX_APP_KEY.substr(7);
    var encrypted_json = JSON.parse(atob(encrypted));
    return CryptoJS.AES.decrypt(encrypted_json.value, CryptoJS.enc.Base64.parse(key), {
        iv: CryptoJS.enc.Base64.parse(encrypted_json.iv)
    }).toString(CryptoJS.enc.Utf8);
};