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
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Útskrá') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
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


                        @if (!$booking->services->isEmpty())
                            <hr class="border border-grey-100 w-full my-6">

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
				</div>
			</div>
		</div>
	</section>
@endsection
