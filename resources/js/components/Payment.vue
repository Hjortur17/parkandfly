<template>
	<transition name="modal">
		<div class="modal-mask">
			<div class="modal-wrapper">
				<div class="modal-container">
					<div class="modal-header">
						<slot name="header">
							<div class="flex mb-12">
								<div class="w-20 self-center">
									<button @click="hideModal()">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="20px" height="20px"><path d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"/></svg>
									</button>
								</div>
								<div class="flex-1">
									<h2 class="font-bold text-3xl text-center">Klára pöntun</h2>
								</div>
								<div class="w-20"></div>
							</div>

							<div>
								<div class="block flex justify-between mb-4">
									<div class="flex-1 text-left text-sm md:text-base">Grunngjald</div>
									<div class="flex-1 text-right text-sm md:text-base">4500kr</div>
								</div>
								<div class="block flex justify-between mb-4">
									<div class="flex-1 text-left text-sm md:text-base">Geymsla (<span v-text="numberOfDays"></span> dagar)</div>
									<div class="flex-1 text-right text-sm md:text-base"><span v-text="priceForDays + 'kr'"></span></div>
								</div>
								<div class="block flex justify-between mb-4">
									<div class="flex-1 text-left text-sm md:text-base">Þjónusta</div>
									<div class="flex-1 text-right text-sm md:text-base"><span v-text="servicePrice + 'kr'"></span></div>
								</div>

								<div class="block flex justify-between mb-8">
									<div class="flex-1 text-left text-sm md:text-base"><strong class="font-bold">Lokaverð</strong></div>
									<div class="flex-1 text-right text-sm md:text-base"><strong class="font-bold" v-text="amount + 'kr'"></strong></div>
								</div>

								<div class="block flex justify-between mb-8">
									<div class="w-0 md:flex-1 text-left text-xs md:text-base self-center invisible md:visible"><strong class="font-normal">Afsláttarkóði</strong></div>
									<div class="flex-1 text-right text-sm md:text-base">
										<form class="w-full">
											<div class="flex items-center border-b border-b-2 border-orange-500 py-2">
												<input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Afsláttarkóði" v-model="couponInput">
												<button class="flex-shrink-0 border-transparent border-4 text-orange-500 hover:text-orange-800 text-sm py-1 px-2 rounded outline-none" type="button" @click="couponApplied($event)">
													Nota
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</slot>
					</div>

					<div class="modal-footer">
						<slot name="footer">
							<div>
								<div class="text-center mt-8 mb-6">
									<form action="https://netgreidslur.korta.is" method="POST" @submit.prevent="checkPaymentForm($event)">
										<p class="my-4 text-sm">
											<input class="mr-2 leading-tight" type="checkbox" v-model="termsChecked">Ég samþykki <a href="/skilmalar" target="_blank" class="font-bold hover:text-orange-500 transition">skilmála</a> Park and fly</p>
										</p>

										<p class="mb-6 text-sm">
											<small>Það skal hafa í huga að þú hefur 10 mínútur til þess að borga, annars verður bókunin gerð ógild.</small>
										</p>

										<input type="submit" value="Borga" class="bg-orange-500 text-white font-bold text-center px-12 py-2 rounded-full"/>
									</form>
								</div>
							</div>
						</slot>
					</div>
				</div>				
			</div>
		</div>
	</transition>
</template>

<script>
import axios from 'axios';
import kennitala from 'kennitala';
import moment from 'moment';
import md5 from 'md5';
import sha256 from 'sha256';

export default {
	props: [
		'userAge',
		'servicePrice',
		'numberOfDays',
		'priceForDays',
		'paidPrice',
		'bookingId',
		'booking',
		'selectedServicesId'
	],

	data() {
		return {
			amount: this.paidPrice,
			netgiroId: '881E674F-7891-4C20-AFD8-56FE2624C4B5',

			discounts: [],
			errors: [],

			paymentPicked: null,
			termsChecked: false,

			couponInput: '',
			discountCode: this.couponInput,
			discountValid: null,
			priceTotalDiscount: null,

			kortaMerchant: null,
			kortaTerminal: null,
			kortaDescription: '',
			providerKeyMethod: null,
			providerKey: null
		}
	},

	methods: {
		hideModal() {
			this.$emit('hide');
		},

		couponApplied(e) {
			e.preventDefault();
			e.stopPropagation();

			axios.post('/api/database/booking/checkbooking', {
				carNumber: this.booking.carNumber,
				carSize: this.booking.carSize,
				carMake: this.booking.carMake,
				carType: this.booking.carType,
				carColor: this.booking.carColor,

				name: this.booking.name,
				socialId: this.booking.socialId,
				email: this.booking.email,
				phone: this.booking.phone,

				dropOffDate: String(moment(this.selectedDeliveryDay).format('DD/MM/YYYY')),
				dropOffTime: this.booking.dropOffTime,
				pickUpDate: String(moment(this.selectedPickUpDay).format('DD/MM/YYYY')),
				pickUpTime: this.booking.pickUpTime,
				flightNumber: this.booking.flightNumber,

				numberOfDays: this.numberOfDays,
				priceForDays: this.priceForDays,

				paidPrice: this.amount,

				selectedServicesId: this.selectedServicesId,

				discountCode: this.couponInput,

				step: 1
			})
			.then(response => {
				if (response.data.discountValid == false) {
					alert('Afsláttarkóði ekki til!');
				} else {
					this.amount = response.data.priceTotalDiscount;
					this.discountValid = response.data.discountValid;
					this.providerKey = response.data.providerKey;
				}
			})
			.catch(function (error) {

			});
		},

		checkPaymentForm(e) {
			e.preventDefault();
			e.stopPropagation();
			
			this.checkData();

			if (!this.termsChecked) {
				alert('Úpps! Þú þarft að samþykkja skilmálana!');
				return false;
			}

			if (this.errors.length > 0) {
				alert('Úpps! Þú fylltir ekki formið rétt inn!');
				return false;
			}


			axios.post('/api/database/booking/create', {
				carNumber: this.booking.carNumber,
				carSize: this.booking.carSize,
				carMake: this.booking.carMake,
				carType: this.booking.carType,
				carColor: this.booking.carColor,

				name: this.booking.name,
				socialId: this.booking.socialId,
				email: this.booking.email,
				phone: this.booking.phone,

				dropOffDate: String(moment(this.selectedDeliveryDay).format('DD/MM/YYYY')),
				dropOffTime: this.booking.dropOffTime,
				pickUpDate: String(moment(this.selectedPickUpDay).format('DD/MM/YYYY')),
				pickUpTime: this.booking.pickUpTime,
				flightNumber: this.booking.flightNumber,

				numberOfDays: this.numberOfDays,
				priceForDays: this.priceForDays,

				paidPrice: this.amount,

				selectedServicesId: this.selectedServicesId,

				discountCode: this.couponInput,

				step: 1
			})
			.then(response => {
				this.amount = response.data.priceTotalDiscount;
				this.discountValid = response.data.discountValid;

				this.kortaMerchant = response.data.ProviderMerchant;
				this.kortaTerminal = response.data.ProviderTerminal;
				this.kortaDescription = response.data.ProviderDescription;
				this.providerKeyMethod = response.data.ProviderKeyMethod;
				this.providerKey = response.data.providerKey;

				if (this.amount == 0) {
					window.location.href = 'https://parkandfly.is?status=1';
				} else {
					var key = response.data.bookingRef + '-' + response.data.tokenKorta;

					var kortaLinkUrl = 'https://netgreidslur.korta.is/?amount=' + this.amount + '&currency=ISK&merchant=' + response.data.providerMerchant + '&terminal=' + response.data.providerTerminal + '&description=' + response.data.providerDescription + '&lang=is&' + response.data.providerKeyMethod + '=' + response.data.providerKey + '&downloadurl=https://parkandfly.is/api/database/booking/update&refermethod=POST&refertarget=_top&reference=' + key + '&startnewpayment=y';

					window.location.href = kortaLinkUrl;

					return false;
				}
			})
			.catch(function (error) {
				
			});

			return false;
		},

		checkUserAge() {
			if (this.userAge >= 65) {
				return this.couponPrice = this.paidPrice - (this.paidPrice *(15)/100)
			}
		},

		checkData() {
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

			if (!this.booking.name) {
				this.errors.push('Vantar nafn!');
			}
			if (!this.booking.socialId) {
				this.errors.push('Vantar kennitölu!');
			} 
			if (!this.booking.email) {
				this.errors.push('Vantar netfang!');
			}

			if (!this.booking.phone) {
				this.errors.push('Vantar símanúmer!');
			}

			if (!this.booking.dropOffDate) {
				this.errors.push('Vantar brottfarardag!');
			}
			if (!this.booking.dropOffTime) {
				this.errors.push('Vantar brottfarartíma!');
			}
			if (!this.booking.pickUpDate) {
				this.errors.push('Vantar komudag!');
			}
			if (!this.booking.pickUpTime) {
				this.errors.push('Vantar komutíma!');
			}
			if (!this.booking.flightNumber) {
				this.errors.push('Vantar flugnúmer!');
			}
		},
	},

	computed: {
		netgiro_signature: function () {
			return String(sha256("YCFd6hiA8lUjZejVcIf/LhRXO4wTDxY0JhOXvQZwnMSiNynSxmNIMjMf1HHwdV6cMN48NX3ZipA9q9hLPb9C1ZIzMH5dvELPAHceiu7LbZzmIAGeOf/OUaDrk2Zq2dbGacIAzU6yyk4KmOXRaSLi8KW8t3krdQSX7Ecm8Qunc/A=1" + this.amount + "881E674F-7891-4C20-AFD8-56FE2624C4B5"));
		},
		netgiro_link: function () {
			return 'https://parkandfly.is/api/database/booking/update?bookingId=' + this.bookingId;
		}
	},

	mounted() {
		this.checkUserAge();
	},
}
</script>

<style>
.modal-mask {
	position: fixed;
	z-index: 49;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: rgba(0, 0, 0, .5);
	display: table;
	transition: opacity .3s ease;
}

.modal-wrapper {
	display: table-cell;
	vertical-align: middle;
}

.modal-container {
	width: 500px;
	margin: 0px auto;
	padding: 20px 30px;
	background-color: #fff;
	border-radius: 2px;
	box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
	transition: all .3s ease;
}

.modal-header h3 {
	margin-top: 0;
	color: #42b983;
}

.modal-body {
	margin: 20px 0;
}

.modal-default-button {
	float: right;
}


.modal-enter {
	opacity: 0;
}

.modal-leave-active {
	opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
	-webkit-transform: scale(1.1);
	transform: scale(1.1);
}

@media only screen and (max-width: 600px) {
	.modal-container {
		width: 325px;
	}

	.modal-mask {
		height: 100vh;
	}
}
</style>
