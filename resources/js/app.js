
require('./bootstrap');

window.Vue = require('vue');

import 'vue-datetime/dist/vue-datetime.css'
import { Datetime } from 'vue-datetime';
import dt from 'luxon/src/datetime.js';

dt.local().toISO();

Vue.component('datetime', Datetime);

Vue.component('booking-form', require('./components/BookingForm.vue').default);
Vue.component('navbar', require('./components/Navbar.vue').default);

const app = new Vue({
	el: '#app',
});
