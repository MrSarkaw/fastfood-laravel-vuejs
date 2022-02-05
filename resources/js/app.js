
require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router'
import {routes} from './routes'
import VueTailwindModal from "vue-tailwind-modal"
import { Form, HasError, AlertError } from 'vform'
import VueSweetalert2 from 'vue-sweetalert2';
import moment from 'moment'


Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('Infinite-Loading',require('vue-infinite-loading'));

window.Form=Form;
window.Load=new Vue();
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
Vue.use(VueRouter);
Vue.component("VueTailwindModal", VueTailwindModal)
Vue.use(VueSweetalert2);

Vue.filter('time',(e)=>{
    return moment(e).startOf('h').fromNow();
    })

Vue.filter('toCurrency', function (value) {
        if (typeof value !== "number") {
            return value;
        }
        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'IQD',
            minimumFractionDigits: 0
        });
        return formatter.format(value);
    });

const router = new VueRouter({
    routes,
    mode:"history"
})

const app = new Vue({
    el: '#app',
    router
});
