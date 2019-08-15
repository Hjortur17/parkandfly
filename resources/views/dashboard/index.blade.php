@extends ('layouts.master')

@section ('header')
	<header class="pt-20 pb-10">
		<div class="container max-w-5xl mx-auto px-6">
			<nav>
				<div class="flex">
					<div class="flex-1">
						<h1 class="font-bold text-4xl mb-8 pr-3">
							<img src="/images/logo.png" width="60%" height="auto">
						</h1>
					</div>
					<div class="flex-1">
						<ul class="flex float-right">
							<li class="pr-4">
								<a href="#">Stillingar</a>
							</li>
							<li>
								<a href="#">Útskrá</a>
							</li>
						</ul>			
					</div>
				</div>
			</nav>
		</div>
	</header>
@endsection

@section ('main')
	<section>
		<div class="container max-w-5xl mx-auto px-6">
			<div class="flex">
				<div class="w-1/4">
					<h4 class="font-bold mb-2 uppercase text-lg">Í dag</h4>

					<ul class="ml-6 mb-8">
						<li class="mb-1">
							<a href="#" class="hover:text-orange-500 transition">Koma inn</a>
						</li>
						<li>
							<a href="#" class="hover:text-orange-500 transition">Fara út</a>
						</li>
					</ul>

					<h4 class="font-bold mb-2 uppercase text-lg">Á morgun</h4>

					<ul class="ml-6 mb-20">
						<li class="mb-1">
							<a href="#" class="hover:text-orange-500 transition">Koma inn</a>
						</li>
						<li>
							<a href="#" class="hover:text-orange-500 transition">Fara út</a>
						</li>
					</ul>

					<ul>
						<li class="mb-1">
							<a href="#" class="hover:text-orange-500 transition">Leita</a>
						</li>
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

							@if (!$booking->services->isEmpty())
								<hr class="border border-grey-100 w-full my-6">
							@endif

							<div class="flex my-4">
								<div class="flex-1 text-right self-center">
									<ul>
										@foreach ($booking->services as $service)
											<li>
												<p>{{ $service->description }}</p>
											</li>
										@endforeach
									</ul>
								</div>
							</div>

							<hr class="border border-grey-100 w-full my-6">

							<div class="flex">
								<div class="flex-1">
									<p class="text-lg mb-2">{{ $booking->name}} <span class="text-gray-600 text-base ml-8">{{ $booking->socialId }}</span></p>
									
									<ul>
										<li>
											<a href="tel:{{ $booking->phone }}" class="text-orange-500">{{ $booking->phone }}</a>
										</li>
										<li>
											<a href="mailto:{{ $booking->email }}" class="text-orange-500">{{ $booking->email }}</a>
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