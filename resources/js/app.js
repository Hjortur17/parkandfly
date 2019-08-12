
require('./bootstrap');

window.Vue = require('vue');

import VCalendar from 'v-calendar';

Vue.use(VCalendar, { componentPrefix: 'vc' });

Vue.component('booking-form', require('./components/BookingForm.vue').default);
Vue.component('navbar', require('./components/Navbar.vue').default);

const app = new Vue({
	el: '#app',
});
