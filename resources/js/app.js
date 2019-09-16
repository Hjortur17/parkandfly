
require('./bootstrap');

window.Vue = require('vue');

import 'vue-datetime/dist/vue-datetime.css'
import { Datetime } from 'vue-datetime';
import dt from 'luxon/src/datetime.js';

dt.local().toISO();

Vue.component('datetime', Datetime);

Vue.component('booking-form', require('./components/BookingForm.vue').default);
Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('price', require('./components/Price.vue').default);

Vue.component('flash', require('./components/Flash.vue').default);

window.events = new Vue();

window.flash = function (message) {
    window.events.$emit('flash', message);
};

const app = new Vue({
	el: '#app',
});
