<!DOCTYPE html>
<html lang="is">
<head>
	<meta charset="utf-8">

	<title>Bókun Staðfest | #{{ $booking->id}}</title>

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
			width: 45%;
		}

		.header {
			font-size: 3rem;
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
					<h2 class="header">#{{ $booking->id }}</h2>
				</div>
			</div>
		</div>

        <hr class="my-6">

		<div class="px-6">
			<ul class="list-none">
				<strong style="font-size: 20px;">Upplýsingar um þig:</strong>
				<li style="padding-top: 1.5rem;">{{ $booking->name }}</li>
				<li>{{ $booking->socialId }}</li>
				<li>{{ $booking->email }}</li>
				<li>{{ $booking->phone }}</li>
			</ul>
		</div>

		<hr class="my-6">

		<div class="px-6">
			<ul class="list-none">
				<strong style="font-size: 20px;">Upplýsingar um bílinn þinn:</strong>
				<li style="padding-top: 1.5rem;">{{ $booking->carNumber }} | {{ $booking->carSize }}</li>
				<li>{{ $booking->carMake }}</li>
				<li>{{ $booking->carType }}</li>
				<li>{{ $booking->carColor }}</li>
			</ul>
		</div>

		<hr class="my-6">

		<div class="px-6">
			<ul class="list-none">
				<strong style="font-size: 20px;">Upplýsingar um flugið þitt:</strong>
				<li style="padding-top: 1.5rem;">Áætlaður komutími á Leifsstöð - {{ $booking->dropOffDate }} {{ $booking->dropOffTime }}</li>
				<li>Áætlaður lendingartími á Leifsstöð - {{ $booking->pickUpDate }} {{ $booking->pickUpTime }}</li>
				<li>Flugnúmer - {{ $booking->flightNumber }}</li>
			</ul>
		</div>


        @if (!$booking->services->isEmpty())
            <hr class="my-6">

            <div class="px-6">
                <ul class="list-none">
                    <strong style="font-size: 20px;">Þjónustur sem þú hefur greitt fyrir:</strong>

                    @foreach ($booking->services as $service)
                        <li>{{ $service->description }}</li>
                    @endforeach
                </ul>
            </div>
        @else
            <p>Þú valdir einga þjónustu hjá okkur.</p>
        @endif

        <hr class="my-6">

		<div class="px-6">
			<ul class="list-none">
				<li style="font-size: 20px; font-weight: 300"><strong style="font-size: 20px">Heildarverð:</strong> {{ $booking->paidPrice }}kr.</li>
				<li style="font-size: 12px; font-weight: 300">Athuga skal að greitt hefur verið 500kr minna fyrir útgöngumiða á bílastæði Isavia.</li>
			</ul>
		</div>
	</header>
</body>
</html>
