<!DOCTYPE html>
<html lang="is">
<head>
	<meta charset="utf-8">

	<title>Bókun Staðfest | #{{ $result['bookingRef']}}</title>

	<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500&display=swap" rel="stylesheet">

	<style type="text/css">
		body {
			font-family: 'Rubik', sans-serif;
			font-weight: 400;
			font-size: 16px;
		}

		strong {
			font-weight: 500;
		}

		.text-bold {
			font-weight: 500;
		}

		.flex {
			display: flex;
		}

		.px-6 {
			padding-right: 1.5rem;
			padding-left: 1.5rem;
		}

		.mb-4 {
			margin-bottom: 1rem;
		}

		.mb-6 {
			margin-bottom: 1.5rem;
		}

		.mb-8 {
			margin-bottom: 2rem;
		}

		.my-6 {
			margin-top: 1.5rem;
			margin-bottom: 1.5rem;
		}

		.text-right {
			text-align: right;
		}

		.flex-1 {
			flex: 1 1 0%;
		}

		.w-60 {
			width: 43%;
		}

		.header {
			font-size: 1.3rem;
			font-weight: 300;
		}

		.self-center {
			align-self: center;
		}

		.list-none {
			list-style-type: none;
		}

		.text-bold {
			font-weight: 400;
		}

		li {
			margin-bottom: 0.5rem;
		}

		.mt-10 {
			margin-top: 50px;
		}
	</style>
</head>
<body>
	<header>
		<div class="px-6 py-8">
			<div class="flex">
				<div class="w-60 mt-10">
					<img src="{{ asset('/images/logo.png') }}" width="100%" height="auto" style="padding-right: 1rem; padding-left: 1rem">
				</div>
				<div class="flex-1 self-center text-right">
					<h2 class="header">{{ $result['bookingRef'] }}</h2>
				</div>
			</div>
		</div>

		<hr class="my-6">

		<div class="px-6">
			<ul class="list-none">
				<strong style="font-size: 20px;">Upplýsingar um þig:</strong>
				<li style="padding-top: 1.5rem;">{{ $result['name'] }}</li>
				<li>{{ $result['socialId'] }}</li>
				<li>{{ $result['email'] }}</li>
				<li>{{ $result['phone'] }}</li>
			</ul>
		</div>

		<hr class="my-6">

		<div class="px-6">
			<ul class="list-none">
				<strong style="font-size: 20px;">Upplýsingar um bílinn þinn:</strong>
				<li style="padding-top: 1.5rem;">{{ $result['carNumber'] }} | {{ $result['carSize'] }}</li>
				<li>{{ $result['carMake'] }}</li>
				<li>{{ $result['carType'] }}</li>
				<li>{{ $result['carColor'] }}</li>
			</ul>
		</div>

		<hr class="my-6">

		<div class="px-6">
			<ul class="list-none">
				<strong style="font-size: 20px;">Upplýsingar um flugið þitt:</strong>
				<li style="padding-top: 1.5rem;">Áætlaður komutími á Leifsstöð - {{ $result['dropOffDate'] }} {{ $result['dropOffTime'] }}</li>
				<li>Áætlaður lendingartími á Leifsstöð - {{ $result['pickUpDate'] }} {{ $result['pickUpTime'] }}</li>
				<li>Flugnúmer - {{ $result['flightNumber'] }}</li>
			</ul>
		</div>

		@if (!empty($result['servicesSelected']))
			<hr class="my-6">

			<div class="px-6">
				<ul class="list-none">
					<strong style="font-size: 20px;">Þjónustur sem þú hefur greitt fyrir:</strong>

					<div style="padding-top: 1.5rem;">
						@foreach ($result['servicesSelected'] as $service)
							<li>{{ $service['description'] }}</li>
						@endforeach
					</div>
				</ul>
			</div>
		@else
			<hr class="my-6">

			<div class="px-6">
				<ul class="list-none">
					<strong style="font-size: 20px;">Þjónustur sem þú hefur greitt fyrir:</strong>

					<div style="padding-top: 1.5rem;">
						<p>Þú valdir einga þjónustu hjá okkur.</p>
					</div>
				</ul>
			</div>
		@endif

		<hr class="my-6">

		<div class="px-6">
			@if (!empty($result['discountCode']))
				<ul class="list-none">
					<li style="font-size: 20px; font-weight: 300"><strong style="font-size: 20px">Afsláttarkóði:</strong> {{ $result['discountCode'] }}</li>

					<li style="font-size: 20px; font-weight: 300"><strong style="font-size: 20px">Fullt verð:</strong> {{ $result['priceTotalNoDiscount'] }}</li>
					<li style="font-size: 20px; font-weight: 300"><strong style="font-size: 20px">Greitt verð:</strong> {{ $result['priceTotalDiscount'] }}kr.</li>
					<li style="font-size: 12px; font-weight: 300">Athuga skal að greitt hefur verið 500kr minna fyrir útgöngumiða á bílastæði Isavia.</li>
				</ul>
			@else
				<ul class="list-none">
					<li style="font-size: 20px; font-weight: 300"><strong style="font-size: 20px">Greitt verð:</strong> {{ $result['priceTotalDiscount'] }}kr.</li>
					<li style="font-size: 12px; font-weight: 300">Athuga skal að greitt hefur verið 500kr minna fyrir útgöngumiða á bílastæði Isavia.</li>
				</ul>	
			@endif

		</div>
	</header>
</body>
</html>
