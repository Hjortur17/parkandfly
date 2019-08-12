@extends ('layouts.master')

@section ('main')
	<section class="py-12">
		<div class="container max-w-6xl mx-auto px-6">
			<div class="flex">
				<div class="w-1/4 h-full">
					<h1 class="font-bold text-4xl mb-8 pr-3">
						<img src="/images/invoice_logo.png" width="100%" height="auto">
					</h1>

					<ul>
						<li><a href="#" class="font-normal">Yfirlit</a></li>
						<li>Koma inn</li>
						<li>Fara út</li>
					</ul>
				</div>
				<div class="w-3/4 flex flex-wrap">
					@foreach ($bookings as $booking)
						<div class="w-full rounded shadow px-8 py-12 border-t-8 border-green-400 bg-white m-2 hover:shadow-md transition">
							<div class="flex">
								<div class="flex-1">
									<h1 class="font-bold text-4xl text-grey-900">{{ $booking->carNumber }}</h1>
									<p>{{ $booking->carType}} {{ $booking->carSubtype}} ({{ $booking->carColor }})</p>
								</div>
								<div class="flex-1 text-right self-center">
									<p><strong>Brottför:</strong> {{ $booking->dropOffDate }} {{ $booking->dropOffTime }}</p>
									<p><strong>Koma:</strong> {{ $booking->pickUpDate }} {{ $booking->pickUpTime }}</p>
								</div>
							</div>

							<hr class="border border-grey-100 w-full my-6">

							<div class="flex">
								<div class="flex-1">
									<p class="text-2xl mb-4">{{ $booking->name}}</p>
									<ul>
										<li>
											<a href="tel:{{ $booking->phone }}" class="text-orange-500 text-lg">{{ $booking->phone }}</a>
										</li>
										<li>
											<a href="mailto:{{ $booking->email }}" class="text-orange-500 text-lg">{{ $booking->email }}</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>
@endsection