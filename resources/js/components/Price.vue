<template>
	<div>
		<div class="flex flex-col w-full">
			<h1 class="text-center text-5xl text-white font-bold mb-2">Verðskrá</h1>
			<p class="italic text-white text-center mb-6">4.500kr þjónustugjald</p>
		</div>

		<div class="w-full">
			<div class="bg-white shadow rounded my-6 overflow-x-auto">
				<table class="text-left w-full border-collapse">
					<thead>
						<th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"></th>
						<th class="py-4 px-6 bg-grey-lightest text-center font-bold uppercase text-sm text-grey-dark border-b border-grey-light"
						v-for="(items, carMake) in groupedByMake"
						:key="carMake" 
						v-text="carMake">
					</th>
				</thead>
				<tbody>
					<tr v-for="(items, description) in groupedByDescription" :key="description" class="bg-white hover:bg-gray-100 transiton">
						<td class="py-4 px-6 border-b border-grey-light font-bold text-left">{{ description }}</td>

						<td v-for="(items, carMake) in groupedByMake" :key="carMake" class="py-4 text-center border-b border-grey-light">
							{{ filter(items, item => item.description === description)[0].price }}kr.
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="flex flex-col w-full pb-16">
		<small class="text-white text-base mb-1">* Verð á inni geymslu er reiknaður fyrir hvern dag.</small>
		<small class="text-white text-base mb-1">* Það skal hafa það í huga að við rukkum 500kr á dag fyrir geymslu.</small>
	</div>
</div>
</template>

<script>
import axios from 'axios';
import groupBy from "lodash.groupby";
import lodashFilter from "lodash.filter";

export default {
	data() {
		return {
			data: []
		};
	},
	computed: {
		groupedByMake() {
			return groupBy(this.data, item => item.carMake);
		},
		groupedByDescription() {
			return groupBy(this.data, item => item.description);
		}
	},
	methods: {
		getPricesFromDatabase() {
			axios.get("/api/services/get").then(response => {
				this.data = response.data;
			});
		},
		filter(items, prop) {
			return lodashFilter(items, prop);
		}
	},
	mounted() {
		this.getPricesFromDatabase();
	}
};
</script>

