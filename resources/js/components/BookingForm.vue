<template>
	<div class="md:min-h-screen p-0 flex flex-col flex-no-wrap justify-center items-center">
		<section class="w-full my-8 mt-40 md:mt-0" id="car-form" v-if="step === 1">

            <div class="w-full">
				<h2 class="font-bold text-white text-4xl text-center mb-12">Upplýsingar um bílinn</h2>
			</div>

            <p v-if="errors.length" class="text-white mb-6">
                <strong class="font-bold">Úpps! Einhvað fór úrskeiðis:</strong>

                <ul>
                    <li v-for="error in errors">{{ error }}</li>
                </ul>
            </p>

			<div class="flex flex-wrap -mx-3 mb-6">
				<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" name="carNumber" placeholder="Bílnúmer" required v-model="booking.carNumber" @blur="getCarInfo()">
				</div>
				<div class="inline-block relative w-full md:w-1/2 px-3 mb-0">
					<select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="booking.carSize" name="carSize">
						<option selected disabled>Bíltegund</option>
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
			<div class="flex flex-wrap -mx-3 mb-6">
				<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Tegund" name="carMake" required v-model="booking.carMake">
				</div>
				<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Undirtegund" name="carType" required v-model="booking.carType">
				</div>
				<div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Litur" name="carColor" required v-model="booking.carColor">
				</div>
			</div>

			<div class="flex flex-wrap -mx-3">
				<div class="w-full px-3 mb-6 md:mb-0 float-right">
					<button @click.prevent="checkCarForm(), next()"  class="float-right">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px" height="30px" fill="#fff"><path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zM140 300h116v70.9c0 10.7 13 16.1 20.5 8.5l114.3-114.9c4.7-4.7 4.7-12.2 0-16.9l-114.3-115c-7.6-7.6-20.5-2.2-20.5 8.5V212H140c-6.6 0-12 5.4-12 12v64c0 6.6 5.4 12 12 12z"/></svg>
					</button>
				</div>
			</div>
		</section>

		<section class="w-full my-8" id="about-form" v-if="step === 2">
			<div class="w-full">
				<h2 class="font-bold text-white text-4xl text-center mb-12">Upplýsingar um eiganda eða notanda bílsins</h2>
			</div>

            <p v-if="errors.length" class="text-white mb-6">
                <strong class="font-bold">Úpps! Einhvað fór úrskeiðis:</strong>

                <ul>
                    <li v-for="error in errors">{{ error }}</li>
                </ul>
            </p>

			<div class="flex flex-wrap -mx-3 mb-6">
				<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Kennitala" name="socialId" required v-model="booking.socialId">
				</div>
				<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Nafn" name="name" required v-model="booking.name">
				</div>
			</div>

			<div class="flex flex-wrap -mx-3 mb-6">
				<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="email" placeholder="Netfang" name="email" required v-model="booking.email">
				</div>
				<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Símanúmer" name="phone" required v-model="booking.phone">
				</div>
			</div>

			<div class="flex flex-wrap -mx-3">
				<div class="w-full px-3 mb-6 md:mb-0">
					<ul class="flex float-right">
						<li class="pr-4">
							<button @click.prevent="prev()">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px" height="30px" fill="#fff"><path d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zm116-292H256v-70.9c0-10.7-13-16.1-20.5-8.5L121.2 247.5c-4.7 4.7-4.7 12.2 0 16.9l114.3 114.9c7.6 7.6 20.5 2.2 20.5-8.5V300h116c6.6 0 12-5.4 12-12v-64c0-6.6-5.4-12-12-12z"/></svg>
							</button>
						</li>
						<li>
							<button @click.prevent="checkUserForm(), next()">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px" height="30px" fill="#fff"><path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zM140 300h116v70.9c0 10.7 13 16.1 20.5 8.5l114.3-114.9c4.7-4.7 4.7-12.2 0-16.9l-114.3-115c-7.6-7.6-20.5-2.2-20.5 8.5V212H140c-6.6 0-12 5.4-12 12v64c0 6.6 5.4 12 12 12z"/></svg>
							</button>
						</li>
					</ul>
				</div>
			</div>
		</section>

		<section class="w-full my-8" id="arrival-form" v-if="step === 3">
			<div class="w-full">
				<h2 class="font-bold text-white text-4xl text-center mb-12 pt-20">Hvenær er ferðin þín?</h2>
			</div>

            <div class="flex flex-wrap -mx-3 my-6">
                <div class="inline-block relative w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <datetime type="date" v-model="selectedDeliveryDay" title="Brottfaradagur" class="theme-orange" input-class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" :format="{ year: 'numeric', month: 'numeric', day: 'numeric' }"></datetime>
                </div>
                <div class="inline-block relative w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <datetime type="date" v-model="selectedPickUpDay" title="Komudagur" class="theme-orange" input-class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" :format="{ year: 'numeric', month: 'numeric', day: 'numeric' }"></datetime>
                </div>
            </div>

			<div class="flex flex-wrap -mx-3 my-6">
				<div class="inline-block relative w-full md:w-1/2 px-3 mb-6 md:mb-0">
					<select @click="dropOffDate" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="booking.dropOffTime" name="dropOffTime">
						<option selected disabled>Áætlaður komutími á Leifsstöð?</option>
						<option>00:00</option>
						<option>00:15</option>
						<option>00:30</option>
						<option>00:45</option>

						<option>01:00</option>
						<option>01:15</option>
						<option>01:30</option>
						<option>01:45</option>

						<option>02:00</option>
						<option>02:15</option>
						<option>02:30</option>
						<option>02:45</option>

						<option>03:00</option>
						<option>03:15</option>
						<option>03:30</option>
						<option>03:45</option>

						<option>04:00</option>
						<option>04:15</option>
						<option>04:30</option>
						<option>04:45</option>

						<option>05:00</option>
						<option>05:15</option>
						<option>05:30</option>
						<option>05:45</option>

						<option>06:00</option>
						<option>06:15</option>
						<option>06:30</option>
						<option>06:45</option>

						<option>07:00</option>
						<option>07:15</option>
						<option>07:30</option>
						<option>07:45</option>

						<option>08:00</option>
						<option>08:15</option>
						<option>08:30</option>
						<option>08:45</option>

						<option>09:00</option>
						<option>09:15</option>
						<option>09:30</option>
						<option>09:45</option>

						<option>10:00</option>
						<option>10:15</option>
						<option>10:30</option>
						<option>10:45</option>

						<option>11:00</option>
						<option>11:15</option>
						<option>11:30</option>
						<option>11:45</option>

						<option>12:00</option>
						<option>12:15</option>
						<option>12:30</option>
						<option>12:45</option>

						<option>13:00</option>
						<option>13:15</option>
						<option>13:30</option>
						<option>13:45</option>

						<option>14:00</option>
						<option>14:15</option>
						<option>14:30</option>
						<option>14:45</option>

						<option>15:00</option>
						<option>15:15</option>
						<option>15:30</option>
						<option>15:45</option>

						<option>16:00</option>
						<option>16:15</option>
						<option>16:30</option>
						<option>16:45</option>

						<option>17:00</option>
						<option>17:15</option>
						<option>17:30</option>
						<option>17:45</option>

						<option>18:00</option>
						<option>18:15</option>
						<option>18:30</option>
						<option>18:45</option>

						<option>19:00</option>
						<option>19:15</option>
						<option>19:30</option>
						<option>19:45</option>

						<option>20:00</option>
						<option>20:15</option>
						<option>20:30</option>
						<option>20:45</option>

						<option>21:00</option>
						<option>21:15</option>
						<option>21:30</option>
						<option>21:45</option>

						<option>22:00</option>
						<option>22:15</option>
						<option>22:30</option>
						<option>22:45</option>

						<option>23:00</option>
						<option>23:15</option>
						<option>23:30</option>
						<option>23:45</option>-
					</select>
					<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 pr-4 text-gray-700">
						<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
					</div>
				</div>
				<div class="inline-block relative w-full md:w-1/2 px-3 mb-6 md:mb-0">
					<select @click="pickUpDate" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" v-model="booking.pickUpTime" name="pickUpTime">
						<option selected disabled>Áætlaður lendingartími á Leifsstöð?</option>
						<option>00:00</option>
						<option>00:15</option>
						<option>00:30</option>
						<option>00:45</option>

						<option>01:00</option>
						<option>01:15</option>
						<option>01:30</option>
						<option>01:45</option>

						<option>02:00</option>
						<option>02:15</option>
						<option>02:30</option>
						<option>02:45</option>

						<option>03:00</option>
						<option>03:15</option>
						<option>03:30</option>
						<option>03:45</option>

						<option>04:00</option>
						<option>04:15</option>
						<option>04:30</option>
						<option>04:45</option>

						<option>05:00</option>
						<option>05:15</option>
						<option>05:30</option>
						<option>05:45</option>

						<option>06:00</option>
						<option>06:15</option>
						<option>06:30</option>
						<option>06:45</option>

						<option>07:00</option>
						<option>07:15</option>
						<option>07:30</option>
						<option>07:45</option>

						<option>08:00</option>
						<option>08:15</option>
						<option>08:30</option>
						<option>08:45</option>

						<option>09:00</option>
						<option>09:15</option>
						<option>09:30</option>
						<option>09:45</option>

						<option>10:00</option>
						<option>10:15</option>
						<option>10:30</option>
						<option>10:45</option>

						<option>11:00</option>
						<option>11:15</option>
						<option>11:30</option>
						<option>11:45</option>

						<option>12:00</option>
						<option>12:15</option>
						<option>12:30</option>
						<option>12:45</option>

						<option>13:00</option>
						<option>13:15</option>
						<option>13:30</option>
						<option>13:45</option>

						<option>14:00</option>
						<option>14:15</option>
						<option>14:30</option>
						<option>14:45</option>

						<option>15:00</option>
						<option>15:15</option>
						<option>15:30</option>
						<option>15:45</option>

						<option>16:00</option>
						<option>16:15</option>
						<option>16:30</option>
						<option>16:45</option>

						<option>17:00</option>
						<option>17:15</option>
						<option>17:30</option>
						<option>17:45</option>

						<option>18:00</option>
						<option>18:15</option>
						<option>18:30</option>
						<option>18:45</option>

						<option>19:00</option>
						<option>19:15</option>
						<option>19:30</option>
						<option>19:45</option>

						<option>20:00</option>
						<option>20:15</option>
						<option>20:30</option>
						<option>20:45</option>

						<option>21:00</option>
						<option>21:15</option>
						<option>21:30</option>
						<option>21:45</option>

						<option>22:00</option>
						<option>22:15</option>
						<option>22:30</option>
						<option>22:45</option>

						<option>23:00</option>
						<option>23:15</option>
						<option>23:30</option>
						<option>23:45</option>-
					</select>
					<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 pr-4 text-gray-700">
						<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
					</div>
				</div>
				<!-- <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
					<input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Flugnúmer á heimleið" name="flightNumber" v-model="booking.flightNumber">
				</div> -->
			</div>

            <div class="flex flex-wrap -mx-3 my-6">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Flugnúmer á heimleið" name="flightNumber" v-model="booking.flightNumber">
                </div>
            </div>

			<div class="flex flex-wrap -mx-3">
				<div class="w-full px-3 mb-6 md:mb-0">
					<ul class="flex float-right">
						<li class="pr-4">
							<button @click.prevent="prev()">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px" height="30px" fill="#fff"><path d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zm116-292H256v-70.9c0-10.7-13-16.1-20.5-8.5L121.2 247.5c-4.7 4.7-4.7 12.2 0 16.9l114.3 114.9c7.6 7.6 20.5 2.2 20.5-8.5V300h116c6.6 0 12-5.4 12-12v-64c0-6.6-5.4-12-12-12z"/></svg>
							</button>
						</li>
						<li>
							<button @click.prevent="checkDateForm(), numberOfDays(), next()">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px" height="30px" fill="#fff"><path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zM140 300h116v70.9c0 10.7 13 16.1 20.5 8.5l114.3-114.9c4.7-4.7 4.7-12.2 0-16.9l-114.3-115c-7.6-7.6-20.5-2.2-20.5 8.5V212H140c-6.6 0-12 5.4-12 12v64c0 6.6 5.4 12 12 12z"/></svg>
							</button>
						</li>
					</ul>
				</div>
			</div>
		</section>

		<section class="w-full my-8" id="service-form" v-if="step === 4">
			<div class="w-full">
				<h2 class="font-bold text-white text-4xl text-center">Klárum dæmið</h2>
				<p class="font-light text-white text-lg text-center italic">Hvaða þjónustu má bjóða þér?</p>
			</div>

			<div class="flex flex-wrap -mx-3 my-12">
				<div v-for="service in services">
					<div v-if="service.carMake === 'Fólksbíll'">
							<input class="mr-2 leading-tight" type="checkbox" :value="service.price" v-model="selectedServicesPrices" @click="addToArray(service.id)" :id="service.id">
						<label class="px-3 mb-6 md:mb-2 pr-8 block">

							<span class="font-normal text-white" v-text="service.description"></span>
						</label>
					</div>
				</div>
			</div>

			<div class="flex flex-wrap -mx-3">
				<div class="w-1/2">
					<h3 class="text-white uppercase font-regular text-xl"><span v-text="total"></span> kr.</h3>
				</div>
				<div class="w-1/2">
					<ul class="flex float-right">
						<li class="pr-4 self-center">
							<button @click.prevent="prev()" class="mt-1">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30px" height="30px" fill="#fff"><path d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zm116-292H256v-70.9c0-10.7-13-16.1-20.5-8.5L121.2 247.5c-4.7 4.7-4.7 12.2 0 16.9l114.3 114.9c7.6 7.6 20.5 2.2 20.5-8.5V300h116c6.6 0 12-5.4 12-12v-64c0-6.6-5.4-12-12-12z"/></svg>
							</button>
						</li>
						<li>
							<button @click.prevent="showPayment = true, addBookingToSession()" class="bg-orange-500 text-white font-bold text-center px-12 py-2 rounded-full">
								Klára Pöntun
							</button>
						</li>
					</ul>
				</div>
			</div>
		</section>

		<payment v-if="showPayment"
			@hide="hideModal"
			:userAge="userAge"
			:servicePrice="servicePrice"
			:numberOfDays="dataNumberOfDays"
			:priceForDays="priceForDays"
			:paidPrice="total"
			:sessionKey="sessionKey">
		</payment>
</div>
</template>

<script>
	import axios from 'axios';
	import kennitala from 'kennitala';
	import moment from 'moment';
	import payment from './Payment.vue';

	export default {
		components: { payment },

		data() {
			return {
				errors: [],

				services: [],
				selectedServicesId: [],
				selectedServicesPrices: [],

                selectedDeliveryDay: "Brottfaradagur",
                selectedPickUpDay: "Hvenær kemuru heim?",

                dropOff: null,
                pickUp: null,

                numberOfDaysData: null,

				step: 1,
				booking: {
					carNumber: null,
					carSize: "Bíltegund",
					carMake: null,
					carType: null,
					carColor: null,

					name: null,
					socialId: null,
					email: null,
					phone: null,

					dropOffDate: this.dropOffDate,
					pickUpDate: this.pickUpDate,
					dropOffTime: "Hvenær mættiru á Leifstöð",
					pickUpTime: "Hvenær viltu sækja bílinn?",
					flightNumber: null,
				},
				showPayment: false,
				price: 4000
			}
		},

		methods: {
			getCarInfo() {
				axios.get('/api/car/info/get?carNumber=' + this.booking.carNumber)
				.then(response => {
					this.booking.carMake = response.data.make;
					this.booking.carType = response.data.vehcom;
					this.booking.carColor = response.data.color;
				})
				.catch(function (error) {
					console.log(error);
				});
			},

			getServices() {
				axios.get('/api/services/get')
				.then(response => {
					this.services = response.data;
				})
			},

			hideModal () {
				return this.showPayment = false;
			},

            checkCarForm(e) {
                if (this.booking.carNumber && this.booking.carSize && this.booking.carMake && this.booking.carType && this.booking.carColor) {
                    return true;
                }

                this.errors = [];

                if (!this.booking.carNumber) {
                    this.errors.push('Vantar bílnúmer!');
                }
                if (!this.booking.carSize) {
                    this.errors.push('Veldu stærð!');
                }
                if (!this.booking.carMake) {
                    this.errors.push('Vantar tegund bíls!');
                }
                if (!this.booking.carType) {
                    this.errors.push('Vantar undirtegund bíls!');
                }
                if (!this.booking.carColor) {
                    this.errors.push('Vantar lit bíls!');
                }

                e.preventDefault();
            },

            checkUserForm(e) {
                if (this.booking.name && this.booking.socialId && this.booking.email && this.booking.phone) {
                    return true;
                }

                this.errors = [];

                if (!this.booking.name) {
                    this.errors.push('Vantar nafn!');
                }
                if (!this.booking.socialId) {
                    this.errors.push('Vandar kennitölu!');
                }
                if (!this.booking.email) {
                    this.errors.push('Vantar netfang!');
                }
                if (!this.booking.phone) {
                    this.errors.push('Vantar símanúmer!');
                }

                if (!kennitala.isPerson(this.booking.socialId)) {
                    this.errors.push('Kennitala er ekki lögleg');
                }

                e.preventDefault();
            },

            checkDateForm() {
                if (this.booking.dropOffDate && this.booking.dropOffTime && this.booking.pickUpDate && this.booking.pickUpTime && this.booking.flightNumber) {
                    return true;
                }

                this.errors = [];

                if (!this.booking.dropOffDate) {
                    this.errors.push('Vantar brottfarardag!');
                }
                if (!this.booking.socialId) {
                    this.errors.push('Vandar brottfarartíma!');
                }
                if (!this.booking.email) {
                    this.errors.push('Vantar komudag!');
                }
                if (!this.booking.phone) {
                    this.errors.push('Vantar komutíma!');
                }
                if (!this.booking.phone) {
                    this.errors.push('Vantar flugnúmer!');
                }
            },

			prev() {
				this.step--;
			},

			next() {
                this.errors = [];
				this.step++;
			},

			addToArray(id) {
				if (this.selectedServicesId.includes(id)) {
					this.selectedServicesId.splice(this.selectedServicesId.indexOf(id), 1)
				} else {
					this.selectedServicesId.push(id);
				}
			},

			addBookingToSession() {
				axios.post('/api/session/add/booking', {
					carNumber: this.booking.carNumber,
					carSize: this.booking.carSize,
					carMake: this.booking.carMake,
					carType: this.booking.carType,
					carColor: this.booking.carColor,

					name: this.booking.name,
					socialId: this.booking.socialId,
					email: this.booking.email,
					phone: this.booking.phone,

					dropOffDate: this.dropOff,
					dropOffTime: this.booking.dropOffTime,
					pickUpDate: this.pickUp,
					pickUpTime: this.booking.pickUpTime,
					flightNumber: this.booking.flightNumber,

					numberOfDays: this.dataNumberOfDays,
					priceForDays: this.priceForDays,

					paidPrice: this.total,

					selectedServicesId: this.selectedServicesId,

					sessionKey: this.sessionKey
				})
				.then(function (response) {})
				.catch(function (error) {});
			},
            dropOffDate: function () {
                return this.dropOff = moment(this.selectedDeliveryDay).format('DD/MM/YYYY');
            },
            pickUpDate: function () {
                return this.pickUp = moment(this.selectedPickUpDay).format('DD/MM/YYYY');
            },
            numberOfDays: function () {
                return this.numberOfDaysData = Math.abs(moment(this.selectedDeliveryDay).diff(moment(this.selectedPickUpDay), 'days'));
            },
		},

		computed: {
			total: function() {
				return (this.priceForDays + this.selectedServicesPrices.reduce((sum, item) => sum + item, this.price));
			},
            servicePrice: function () {
				return (this.total - this.price) - this.priceForDays;
			},
            userAge: function() {
				return kennitala.info(this.booking.socialId).age;
			},
            priceForDays: function () {
				return (this.numberOfDaysData * 500);
			},
            sessionKey: function () {
				return Math.random().toString(30).substring(2, 15) + Math.random().toString(30).substring(2, 15);
			},
		},

		mounted() {
			this.getServices();
		}
	}
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
</style>
