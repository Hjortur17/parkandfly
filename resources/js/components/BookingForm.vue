<template>
	<div class="p-0">
		<section class="w-full mt-8 md:mt-16" id="car-form" v-if="step === 1">
			<div class="w-full">
				<h2 class="font-bold text-white text-4xl text-center mb-12">Upplýsingar um þig og bílinn</h2>
			</div>

			<p v-if="errors.length" class="text-white mb-6">
				<strong class="text-lg font-bold">Úpps! Eitthvað fór úrskeiðis:</strong>

				<ul>
					<li v-for="error in errors" class="text-base">{{ error }}</li>
				</ul>
			</p>

			<div class="flex flex-wrap -mx-3 mb-6">
				<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
					<form class="w-full">
						<div class="flex items-center bg-gray-200 text-gray-700 border border-gray-200 rounded pr-2 focus:bg-white focus:border-gray-500">
							<input class="appearance-none block w-full leading-tight bg-gray-200 py-3 px-4 focus:outline-none" type="text" name="carNumber" placeholder="Bílnúmer" required v-model="booking.carNumber" :maxlength="7" aria-label="Bílnúmer" @keyup="carNumberToUpperCase(booking.carNumber)">
							<button class="flex-shrink-0 text-white text-sm py-1 px-2 bg-orange-600 rounded outline-none" type="button" @click="getCarInfo()">
								Leita
							</button>
						</div>
					</form>
				</div>
				<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Tegund" name="carModel" required v-model="booking.carModel" aria-label="Tegund">
					<p class="text-white text-xs mt-2">Tegund - Undirtegund (Litur)</p>
				</div>
				<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
					<div class="inline-block relative w-full mb-0">
						<select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="booking.carSize" name="carSize" aria-label="Stærð bíls">
							<option selected value="">Veldu stærð</option>
							<option value="Fólksbíll">Fólksbíll</option>
							<option value="Jepplingur">Jepplingur</option>
							<option value="Jeppi">Jeppi</option>
							<option value="Yfirstærð">Yfirstærð</option>
						</select>
						<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 pr-4 text-gray-700">
							<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
						</div>
					</div>
				</div>
			</div>

			<div class="flex flex-wrap -mx-3 mb-6">
				<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Nafn" name="name" required v-model="booking.name" aria-label="Nafn">
				</div>
				<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="email" placeholder="Netfang" name="email" required v-model="booking.email" aria-label="Netfang">
				</div>
				<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="phone" placeholder="Símanúmer" name="phone" required v-model="booking.phone" aria-label="Símanúmer">
				</div>
			</div>
			
			<div class="flex flex-wrap -mx-3">
				<div class="w-full px-3 mb-6 md:mb-0 float-right">
					<button @click.prevent="checkCarUserForm(), next()"  class="float-right" title="Halda áfram">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px" height="30px" fill="#fff"><path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zM140 300h116v70.9c0 10.7 13 16.1 20.5 8.5l114.3-114.9c4.7-4.7 4.7-12.2 0-16.9l-114.3-115c-7.6-7.6-20.5-2.2-20.5 8.5V212H140c-6.6 0-12 5.4-12 12v64c0 6.6 5.4 12 12 12z"/></svg>
					</button>
				</div>
			</div>
		</section>

		<section class="w-full mt-8 md:mt-16" id="arrival-form" v-if="step === 2">
			<div class="w-full">
				<h2 class="font-bold text-white text-4xl text-center mb-12">Hvenær er ferðin þín?</h2>
			</div>

			<p v-if="errors.length" class="text-white mb-6">
				<strong class="text-lg font-bold">Úpps! Eitthvað fór úrskeiðis:</strong>

				<ul>
					<li v-for="error in errors" class="text-base">{{ error }}</li>
				</ul>
			</p>

			<div class="flex flex-wrap -mx-3 my-6">
				<div class="inline-block relative w-full md:w-1/2 px-3 mb-6 md:mb-0">
					<datetime type="datetime" v-model="selectedDeliveryDay" class="theme-orange" :min-datetime="today" :phrases="{ok: 'Komið', cancel: 'Hætta'}" input-class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" :format="formatDate(selectedDeliveryDay)" placeholder="Brottför"></datetime>
				</div>
				<div class="inline-block relative w-full md:w-1/2 px-3">
					<datetime type="datetime" v-model="selectedPickUpDay" class="theme-orange" :min-datetime="selectedDeliveryDay" :phrases="{ok: 'Komið', cancel: 'Hætta'}" input-class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" :format="formatDate(selectedPickUpDay)" placeholder="Heimkoma"></datetime>
				</div>
			</div>

			<div class="flex flex-wrap -mx-3 mb-6">
				<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Flugnúmer á heimleið" name="flightNumber" v-model="booking.flightNumber" aria-label="Flugnúmer" @keyup="flightNumberToUpperCase(booking.flightNumber)">
				</div>
				<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 invisible">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Flugfélag" name="flightAirlane" v-model="booking.flightAirlane" disabled aria-label="Flugfélag">
				</div>
				<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 invisible">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Brottfarastaður" name="flightDeparture" v-model="booking.flightDeparture" disabled aria-label="Brottfarastaður">
				</div>
			</div>

			<div class="flex flex-wrap -mx-3">
				<div class="w-full px-3 mb-6 md:mb-0">
					<ul class="flex float-right">
						<li class="pr-4">
							<button @click.prevent="prev()" title="Til baka">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px" height="30px" fill="#fff"><path d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zm116-292H256v-70.9c0-10.7-13-16.1-20.5-8.5L121.2 247.5c-4.7 4.7-4.7 12.2 0 16.9l114.3 114.9c7.6 7.6 20.5 2.2 20.5-8.5V300h116c6.6 0 12-5.4 12-12v-64c0-6.6-5.4-12-12-12z"/></svg>
							</button>
						</li>
						<li>
							<button @click.prevent="checkDateForm(), numberOfDays(), next()" title="Halda áfram">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px" height="30px" fill="#fff"><path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zM140 300h116v70.9c0 10.7 13 16.1 20.5 8.5l114.3-114.9c4.7-4.7 4.7-12.2 0-16.9l-114.3-115c-7.6-7.6-20.5-2.2-20.5 8.5V212H140c-6.6 0-12 5.4-12 12v64c0 6.6 5.4 12 12 12z"/></svg>
							</button>
						</li>
					</ul>
				</div>
			</div>
		</section>

		<section class="w-full mt-8 md:mt-16" id="service-form" v-if="step === 3">
			<div class="w-full">
				<h2 class="font-bold text-white text-4xl text-center">Klárum dæmið</h2>
				<p class="font-light text-white text-lg text-center italic">Hvaða þjónustu má bjóða þér?</p>
			</div>

			<div class="flex flex-wrap -mx-3 mt-12 relative">
				<multiselect v-model="selectedServices" :options="sortedServices" :multiple="true" placeholder="Veldu þér þjónustu með okkur" track-by="description" label="description" :close-on-select="false" class="absolute appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
					<span slot="noResult">Engin þjónusta fannst! Reyndu annað leitarskilirði</span>
				</multiselect>
			</div>
			
			<div class="flex flex-wrap -mx-3 mt-4 mb-12">
				<small class="italic text-white">* Inni geymsla er 990kr á dag.</small>
			</div>

			<div class="flex flex-wrap -mx-3">
				<div class="w-1/2">
					<h3 class="text-white uppercase font-regular text-xl"><span v-text="total"></span> kr.</h3>
				</div>
				<div class="w-1/2">
					<ul class="flex float-right">
						<li class="pr-4 self-center">
							<button @click.prevent="prev()" class="mt-1" title="Til baka">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px" height="30px" fill="#fff"><path d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zm116-292H256v-70.9c0-10.7-13-16.1-20.5-8.5L121.2 247.5c-4.7 4.7-4.7 12.2 0 16.9l114.3 114.9c7.6 7.6 20.5 2.2 20.5-8.5V300h116c6.6 0 12-5.4 12-12v-64c0-6.6-5.4-12-12-12z"/></svg>
							</button>
						</li>
						<li>
							<button @click.prevent="showPayment = true" class="bg-orange-500 text-white font-bold text-center px-6 py-2 rounded" title="Sýna greiðslugátt">
								Klára Pöntun
							</button>
						</li>
					</ul>
				</div>
			</div>
		</section>

		<payment v-if="showPayment"
			@hide="hideModal"
			:servicePrice="servicePrice"
			:numberOfDays="numberOfDaysData"
			:priceForDays="priceForDays"
			:paidPrice="total"
			:booking="booking"
			:selectedServicesId="selectedServicesId">
		</payment>
</div>
</template>

<script>
import axios from 'axios';
import dayjs from 'dayjs';
import payment from './Payment.vue';
import Multiselect from 'vue-multiselect';

export default {
	components: { payment, Multiselect },

	data() {
		return {
			today: dayjs().format(),

			errors: [],

			services: [],

			selectedServices: [],

			selectedDeliveryDay: null,
			selectedPickUpDay: null,

			numberOfDaysData: null,

			step: 1,
			booking: {
				carNumber: null,
				carSize: "",
				carMake: null,
				carType: null,
				carColor: null,
				carModel: null,

				name: null,
				socialId: '0000000000',
				email: null,
				phone: null,

				dropOffDate: null,
				pickUpDate: null,
				dropOffTime: "",
				pickUpTime: "",

				flightNumber: null,
			},

			flightAirlane: null,
			flightDeparture: null,

			showPayment: false,
			price: 4000,
		}
	},

	methods: {
		getCarInfo: function() {
			axios.get('/api/car/info/get?carNumber=' + this.booking.carNumber)
			.then(response => {
				this.booking.carMake = response.data.make;
				this.booking.carType = response.data.vehcom;
				this.booking.carColor = response.data.color;

				this.booking.carModel = response.data.make + ' - ' + response.data.vehcom + ' (' + response.data.color + ')';
			})
			.catch(function (error) {
				
			});
		},

		carNumberToUpperCase: function(value) {
			if (value) {
				return this.booking.carNumber = value.toUpperCase();
			}
		},

		flightNumberToUpperCase: function(value) {
			if (value) {
				return this.booking.flightNumber = value.toUpperCase();
			}
		},

		getServices: function() {
			axios.get('/api/services/get')
			.then(response => {
				this.services = response.data;
			})
		},

		hideModal: function() {
			return this.showPayment = false;
		},

		checkCarUserForm: function(e) {
			this.errors = [];

			if (!this.booking.carNumber) {
				this.errors.push('Vantar bílnúmer!');
			}
			if (!this.booking.carSize) {
				this.errors.push('Veldu stærð!');
			}
			if (!this.booking.carModel) {
				this.errors.push('Vantar tegund bíls!');
			}

			if (!this.booking.name) {
				this.errors.push('Vantar nafn!');
			}
			if (!this.booking.email) {
				this.errors.push('Vantar netfang!');
			}
			if (!this.booking.phone) {
				this.errors.push('Vantar símanúmer!');
			}

			if (this.errors.length > 0) {
				return false;
			}

			this.booking.carMake = this.booking.carModel;
			this.booking.carType = this.booking.carModel;
			this.booking.carColor = this.booking.carModel;
		},

		checkDateForm: function(e) {
			this.errors = [];
			
			if (!this.selectedDeliveryDay) {
				this.errors.push('Vantar brottfarardag!');
			}

			if (!this.booking.dropOffTime) {
				this.errors.push('Vantar brottfarartíma!');
			}

			if (!this.selectedPickUpDay) {
				this.errors.push('Vantar komudag!');
			}

			if (!this.booking.pickUpTime) {
				this.errors.push('Vantar komutíma!');
			}
			
			if (!this.booking.flightNumber) {
				this.errors.push('Vantar flugnúmer!');
			}

			if (this.errors.length > 0) {
				return false;
			}
		},

		prev: function() {
			this.step--;
		},

		next: function() {
			if (this.errors.length > 0) {
				return false;
			}

			this.errors = [];
			this.step++;
		},

		addToArray: function(id) {
			if (this.selectedServicesId.includes(id)) {
				this.selectedServicesId.splice(this.selectedServicesId.indexOf(id), 1)
			} else {
				this.selectedServicesId.push(id);
			}
		},

		changePrice: function(service) {
			if (service.id === 7 || service.id === 14 || service.id === 21 || service.id === 28) {
				if (this.selectedServicesId.includes(service.id)) {
					return this.price = (((this.numberOfDaysData)*1290)+this.price)-1290;
				} else {
					return this.price -= ((this.numberOfDaysData-1)*1290);
				}
			}
		},

		formatDropOffDate: function() {
			this.booking.dropOffTime = dayjs(this.selectedDeliveryDay).format('HH:mm');
			return this.booking.dropOffDate = dayjs(this.selectedDeliveryDay).format('DD.MM.YYYY');
		},

		formatPickUpDate: function () {
			this.booking.pickUpTime = dayjs(this.selectedPickUpDay).format('HH:mm');
			return this.booking.pickUpDate = dayjs(this.selectedPickUpDay).format('DD.MM.YYYY');
		},

		numberOfDays: function () {
			return this.numberOfDaysData = Math.abs(dayjs(this.selectedDeliveryDay).diff(dayjs(this.selectedPickUpDay), 'days'));
		},

		formatDate: function (value) {
			if (value) {
				this.booking.dropOffTime = dayjs(this.selectedDeliveryDay).format('HH:mm');
				this.booking.dropOffDate = dayjs(this.selectedDeliveryDay).format('DD.MM.YYYY');

				this.booking.pickUpTime = dayjs(this.selectedPickUpDay).format('HH:mm');
				this.booking.pickUpDate = dayjs(this.selectedPickUpDay).format('DD.MM.YYYY');

				return dayjs(String(value)).format('DD.MM.YYYY HH:mm');
			}
		},
	},

	computed: {
		total: function() {
			return (this.priceForDays + this.selectedServicesPrices.reduce((sum, item) => sum + item, this.price));
		},
		servicePrice: function () {
			return (this.total - this.price) - this.priceForDays;
		},
		priceForDays: function () {
			return (this.numberOfDaysData * 500);
		},
		selectedServicesPrices: function () {
			return this.selectedServices.map(service => service.price);
		},
		selectedServicesId: function () {
			return this.selectedServices.map(service => service.id);
		},
		sortedServices: function () {
			let filtered = _.filter(this.services, ['carMake', 'Fólksbíll']);
			let sorted = _.sortBy(filtered, 'description');

			return sorted;
		}
	},

	mounted() {
		this.getServices();
	}
};
</script>


<style>
.theme-orange .vdatetime-popup__header,
.theme-orange .vdatetime-calendar__month__day--selected > span > span,
.theme-orange .vdatetime-calendar__month__day--selected:hover > span > span {
	background: #FF9800;
}

.theme-orange .vdatetime-year-picker__item--selected,
.theme-orange .vdatetime-time-picker__item--selected,
.theme-orange .vdatetime-popup__actions__button {
	color: #ff9800;
}

.multiselect__tag {
	background: #ed8936;
	border-radius: .25rem;
	font-size: .875rem;
	padding-right: 0.5rem;
	padding-left: 0.5rem;
	padding-top: 0.25rem;
	padding-bottom: 0.25rem;
	margin-right: 0.25rem;
	color: white;
}

.multiselect__input {
	background: transparent;
	margin-top: 1rem;
	margin-bottom: 1rem;
	outline: 0;
}

.multiselect__content {
	width: 100%;
	transition: .5s;
}

.multiselect__element {
	padding-top: 0.5rem;
	padding-bottom: 0.5rem;
	overflow: auto;
	cursor: pointer;
}

.multiselect__element:hover {
	text-decoration: underline;
}

.multiselect__content-wrapper {
	z-index: 10 !important;
	max-height: 200px !important;
	overflow: auto !important;
}

.multiselect__option--selected {
	font-weight: bold;
}
</style>
