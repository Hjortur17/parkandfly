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
												<button class="flex-shrink-0 border-transparent border-4 text-orange-500 hover:text-orange-800 text-sm py-1 px-2 rounded outline-none" type="button" @click="couponApplied()">
													Nota
												</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</slot>
					</div>

					<!-- <div class="modal-body">
						<div class="flex px-12">
							<div class="flex-1 px-2">
								<div class="flex">
									<div class="flex-1 self-center">
										<input type="radio" id="one" value="Netgiro" v-model="paymentPicked">
									</div>
									<div class="w-full px-4">
										<img src="/images/netgiro.png">
									</div>
								</div>
							</div>
							<div class="flex-1 px-2 self-center">
								<input type="radio" id="two" value="Korta" v-model="paymentPicked">
								<label for="two">Kort</label>
							</div>
						</div>
					</div> -->

					<div class="modal-footer">
						<slot name="footer">
							<!-- <div class="text-center my-8" v-if="this.paymentPicked === 'Netgiro'">
								<form method="post" action="https://test.netgiro.is/securepay">
									<input type="hidden" name="ApplicationID" :value="this.netgiroId">
									<input type="hidden" name="Iframe" value="false">
									<input type="hidden" name="Signature" :value="netgiro_signature">
									<input type="hidden" name="PaymentSuccessfulURL" :value="ne°tgiro_link">

									<input type="hidden" name="ReferenceNumber" :value="this.netgiro_reference">
									<input type="hidden" name="TotalAmount" :value="this.amount">

									<input type="hidden" name="Items[0].ProductNo" value='1'>
									<input type="hidden" name="Items[0].Name" value="Bíl">
									<input type="hidden" name="Items[0].UnitPrice" :value="this.amount">
									<input type="hidden" name="Items[0].Amount" :value="this.amount">
									<input type="hidden" name="Items[0].Quantity" value="1">

									<button type="submit" class="bg-orange-500 text-white font-bold text-center px-12 py-2 rounded-full">Borga</button>
								</form>
							</div> -->

							<div class="text-center mt-8">
								<form action="https://netgreidslur.korta.is" method="post">
									<input name="amount" type="hidden" :value="this.amount">
									<input name="currency" type="hidden" value="ISK">
									<input name="merchant" type="hidden" value="8190444">
									<input name="terminal" type="hidden" value="52176">
									<input name="description" type="hidden" value="Park and fly">
									<input name="checkvaluemd5" type="hidden" :value="checkvaluemd5">

									<input name="look" type="hidden" value="SIMPLE">
									<input name="readonly" type="hidden" value="Y">

									<input name="refermethod" type="hidden" value="post">
									<input name="refertarget" type="hidden" value="_top">
									<input name="downloadurl" type="hidden" value="https://parkandfly.is/api/database/booking/update">

									<input name="reference" type="hidden" :value="this.bookingId">
								</form>

								<p class="mt-8 mb-6 text-sm">
									<input class="mr-2 leading-tight" type="checkbox" v-model="termsChecked">Ég samþykki <a href="/skilmalar" class="font-bold">skilmála</a> Park and fly</p>
								</p>

								<a :href="korta_link" class="bg-orange-500 text-white font-bold text-center px-12 py-2 rounded-full" @click="checkPaymentForm()">Borga</a>
							</div>
						</slot>
					</div>
				</div>				
			</div>
		</div>
	</transition>
</template>

<script>
	import md5 from 'md5';
	import sha256 from 'sha256';

	export default {
		props: [
			'userAge',
			'servicePrice',
			'numberOfDays',
			'priceForDays',
			'paidPrice',
			'bookingId'
		],

		data() {
			return {
				netgiro_reference: 1,
				couponInput: '',
				amount: this.paidPrice,
				netgiroId: '881E674F-7891-4C20-AFD8-56FE2624C4B5',
				termsChecked: false,
				discounts: [],
			}
		},

		methods: {
			hideModal() {
				this.$emit('hide');
			},

			getDiscounts() {
				axios.get('/api/discounts/get')
				.then(response => {
					this.discounts = response.data;
				})
			},

			couponApplied() {
				for (var i = 0; i < this.discounts.length; i++) {
					if (this.couponInput.toLowerCase().trim() === this.discounts[i].discount_title) {
						return this.amount = this.paidPrice - (this.paidPrice *(this.discounts[i].discount_value)/100);
					}
				}
			},

			checkPaymentForm: function (e) {
				if (this.termsChecked) {
					return true;
				} else {
					alert('Upps! Þú þarft að samþykkja skilmálana!');
				}

				e.preventDefault();
			},

			checkUserAge() {
				if (this.userAge >= 65) {
					return this.couponPrice = this.paidPrice - (this.paidPrice *(15)/100)
				}
			}
		},

		computed: {
			netgiro_signature: function () {
				return String(sha256("YCFd6hiA8lUjZejVcIf/LhRXO4wTDxY0JhOXvQZwnMSiNynSxmNIMjMf1HHwdV6cMN48NX3ZipA9q9hLPb9C1ZIzMH5dvELPAHceiu7LbZzmIAGeOf/OUaDrk2Zq2dbGacIAzU6yyk4KmOXRaSLi8KW8t3krdQSX7Ecm8Qunc/A=" + this.netgiro_reference + this.amount + "881E674F-7891-4C20-AFD8-56FE2624C4B5"));
			},
			checkvaluemd5: function () {
			//return md5(this.amount + "ISK819009450719Park and fly6ADcgKHhfeG4fBvD4r37A2cjLSrn2aFVBiVFR5MXTEST"); // TEST
				return md5(this.amount + "ISK819044452176Park and flyE54AYVXe8vF6GtwZ9hRFqYbTx4NAIp5kHXI8J8AG");
			},
			korta_link: function () {
				return 'https://netgreidslur.korta.is/?amount=' + this.amount + '&currency=ISK&merchant=8190444&terminal=52176&description=Park and fly&lang=is&checkvaluemd5=' + this.checkvaluemd5 + '&downloadurl=https://parkandfly.is/api/database/booking/update&refermethod=POST&refertarget=_top&reference=' + this.bookingId + '&startnewpayment=y';
			},
			netgiro_link: function () {
				return 'https://parkandfly.is/api/database/booking/update?bookingId=' + this.bookingId;
			}
		},

		mounted() {
			this.checkUserAge();	
			this.getDiscounts();
		},
	}
</script>

<style>
    .modal-mask {
	 position: fixed;
	 z-index: 9998;
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
