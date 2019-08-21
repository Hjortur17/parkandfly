@extends ('layouts.dashboard')

@section ('main')
@foreach ($bookings as $booking)
<div class="w-full rounded shadow px-8 py-12 border-t-8 border-green-400 bg-white m-2 hover:shadow-md transition">
	<div class="flex">
		<div class="flex-1">
			<h1 class="font-bold text-4xl text-grey-900">{{ strtoupper($booking->carNumber) }}</h1>
			<p>{{ $booking->carType}} {{ $booking->carSubtype}} ({{ $booking->carColor }})</p>
		</div>
		<div class="flex-1 text-right self-center">
			<p><strong>Brottför:</strong> {{ $booking->dropOffDate }} {{ $booking->dropOffTime }}</p>
			<p><strong>Koma:</strong> {{ $booking->pickUpDate }} {{ $booking->pickUpTime }}</p>
		</div>
	</div>

	<hr class="border border-grey-100 w-full my-6">

	<div class="flex my-4">
		<div class="w-64 self-center">
			<h3 class="font-light text-xl">Flugupplýsingar:</h3>
		</div>
		<div class="flex-1 text-right self-center">
			<p><strong>Flugnúmer:</strong> {{ $booking->flightNumber }}</p>
			<p><strong>Áætlaður brottfarartími:</strong> {{ $booking->flightTime }}</p>
		</div>
	</div>

	<hr class="border border-grey-100 w-full my-6">

	@if (!$booking->services->isEmpty())
		<div class="flex my-4">
			<div class="w-64 self-center">
				<h3 class="font-light text-xl">Þjónusta:</h3>
			</div>
			<div class="flex-1 text-right">
				<ul>
					@foreach ($booking->services as $service)
						<li>
							<p class="font-bold">{{ $service->description }}</p>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	@else
		<div class="flex my-4">
			<h3 class="font-light text-xl italic">Ekki var valið þjónusta</h3>
		</div>
	@endif

	<hr class="border border-grey-100 w-full my-6">

	<div class="flex">
		<div class="w-64 self-center">
			<h3 class="font-light text-xl">Eigandi bíls:</h3>
		</div>
		<div class="flex-1 text-right">
			<p><strong>Nafn:</strong> {{ $booking->name }}</p>
			<p><strong>Kennitala:</strong> {{ substr_replace($booking->socialId, "-", 6, 0) }}</p>

			<ul>
				<li>
					<p><strong>Sími:</strong> <a href="tel:{{ $booking->phone }}" title="Hringja í viðkomandi" class="text-orange-500 hover:text-orange-300 transition">{{ $booking->phone }}</a></p>
				</li>
				<li>
					<p><strong>Netfang:</strong> <a href="mailto:{{ $booking->email }}" title="Senda tölvupóst á viðkomandi" class="text-orange-500 hover:text-orange-300 transition">{{ $booking->email }}</a></p>
				</li>
			</ul>
		</div>
	</div>
</div>
@endforeach
@endsection
