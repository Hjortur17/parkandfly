@extends ('layouts.master')

@section ('main')
	<section id="home" class="relative w-full background">
		<div class="container max-w-4xl mx-auto px-6 min-h-screen">
			<div class="flex flex-col flex-no-wrap">
				<navbar></navbar>

				<div class="flex flex-col pb-24">
					<h1 class="text-left text-5xl text-white font-bold mb-6">Hvernig virkar Park and fly?</h1>

					<p class="text-left text-lg text-white text-lg leading-normal">
						Þjónustuferlið virkar þannig að viðskiptavinir bóka bílastæði á heimasíðu okkar www.parkandfly.is eða í gegnum appið Park And Fly sem þú getur nálgast í snjallsímanum þínum í Appstore (iOS) eða Playstore (Android).
					</p>

					<p class="text-left text-lg text-white text-lg leading-normal my-4">
						Við sendum þér fyrst smáskilaboð klukkutíma fyrir áætlaðan komutíma á Leifsstöð. Það er MIKILVÆGT að þú látir okkur vita hvort komutími þinn sé á áætlun. Við komuna mun starfsmaður hjá Park And Fly vera fyrir utan brottfararsal Leifsstöðvar við svokallað ,,drop off,, svæði. Það eru bílastæðin þar sem þú leggur bílnum þegar þú keyrir aðra í flug. Starfsmaðurinn aðstoðar þig við að afferma bílinn og ekur honum síðan á geymslusvæði okkar sem er einungis 5.5 km frá Leifsstöð.
					</p>

					<p class="text-left text-lg text-white text-lg leading-normal">
						Við heimkomuna fá viðskiptavinir smáskilaboð (sms) frá okkur um að láta okkur vita þegar það eru 15 mínútur þangað til þú kemur í komusalinn. Þar tekur starfsmaður, merktur Park And Fly, á móti þér og afhendir þér bílykilinn og bíllinn þinn mun standa á skammtímasvæði ISAVIA við komusal.
					</p>
				</div>
			</div>
		</div>
		<ul class="fixed bottom-0 left-0 p-6">
			<li>
				<a href="mailto:parkandfly@parkandfly.is" title="Hafa samband">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="30px" width="30px" fill="#fff"><path d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 2.7 466 2.2 466.5c-2.2 2.3-2.8 5.7-1.5 8.7S4.8 480 8 480c66.3 0 116-31.8 140.6-51.4 32.7 12.3 69 19.4 107.4 19.4 141.4 0 256-93.1 256-208S397.4 32 256 32zm64 133.2c14.8 0 26.8 12 26.8 26.8s-12 26.8-26.8 26.8-26.8-12-26.8-26.8 12-26.8 26.8-26.8zm-128 0c14.8 0 26.8 12 26.8 26.8s-12 26.8-26.8 26.8-26.8-12-26.8-26.8 12-26.8 26.8-26.8zm164.2 140.9C331.3 335.3 294.8 352 256 352c-38.8 0-75.3-16.7-100.2-45.9-5.8-6.7-5-16.8 1.8-22.5 6.7-5.7 16.8-5 22.5 1.8 18.8 22 46.5 34.6 75.8 34.6 29.4 0 57-12.6 75.8-34.7 5.8-6.7 15.9-7.5 22.6-1.8 6.8 5.8 7.6 15.9 1.9 22.6z"/></svg>
				</a>
			</li>
		</ul>
	</section>
@endsection
