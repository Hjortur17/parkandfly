@extends ('layouts.master')

@section ('main')
    <section id="home" class="relative h-auto w-full background">
        <navbar></navbar>

        <div class="container max-w-4xl mx-auto px-6 py-24">
            <div class="md:min-h-screen p-0 flex flex-col flex-no-wrap justify-center md:items-center">

                <div class="flex flex-col">
                    <h1 class="text-left text-5xl text-white font-bold mb-6">Algengar spurningar</h1>

                    <h3 class="text-white text-left font-bold mb-1 text-lg">Hvernig virkar Park And Fly? </h3>
                    <p class="text-left text-white leading-normal mb-6">
                        Viðskiptavinir bóka bílastæði ásamt þjónustu sem þeir óska eftir inn á www.parkandfly.is eða á appi fyrirtækisins. Við sendum þér svo smáskilaboð (sms) um klukkutíma áður en þú kemur upp á Leifsstöð og biðjum við þig að senda okkur smáskilaboð (sms) í síma 680-0000 þegar það eru 15 mín. áður en þú mætir fyrir utan Brottfarir í Leifsstöð. Þar tekur svo starfsmaður við bílnum þínum og kemur honum á öruggan stað. Á heimleið mun starfsmaður bíða við komusal þangað til þú mætir. með lyklana að bifreið þinni sem stendur fyrir utan komusal Leifsstöð.
                    </p>

                    <h3 class="text-white text-left font-bold mb-1 text-lg">Hversu langt er farið með bíllinn minn? </h3>
                    <p class="text-left text-white leading-normal mb-6">
                        Bílastæðalóð okkar ásamt bónstöðinni eru staðsettar aðeins 5.5 kílómetrum frá Leifsstöð. En ef keypt er aukaþjónusta eins smurning, dekkjaskipti eða bifreiðaskoðun, þurfum við að koma bílnum á þær þjónustustöðvar sem eru í um 5 km fjarlægð frá geymslusvæði okkar.
                    </p>

                    <h3 class="text-white text-left font-bold mb-1 text-lg">Þarf að panta bílastæði og þjónustu sem í boði er hjá ykkur með löngum fyrirvara?</h3>
                    <p class="text-left text-white leading-normal mb-6">
                        Nei, þú getur pantað þjónustu okkar samdægurs bæði á heimasíðu okkar og á app-inu. Best er hins vegar að hringja ef bókað er bílastæði með minna en átta tíma fyrirvara.
                    </p>

                    <h3 class="text-white text-left font-bold mb-1 text-lg">Á hvernig svæði er bílnum mínum lagt?</h3>
                    <p class="text-left text-white leading-normal mb-6">
                        Við bjóðum upp á inni og úti svæði. Öll svæðin eru vöktuð, upplýst og afgirt ásamt góðu myndavélakerfi.
                    </p>

                    <h3 class="text-white text-left font-bold mb-1 text-lg">Eruð þið tryggðir fyrir bílnum mínum á meðan hann er í ykkar umsjá?</h3>
                    <p class="text-left text-white leading-normal mb-6">
                        Bíllinn þinn er fulltryggður í okkar vörslu sem og í akstri á meðan hann er í okkar umsjá. Við tökum einnig myndir af öllum bílum sem við tökum á móti þegar þeir eru komnir inn á okkar geymslusvæði.
                    </p>

                    <h3 class="text-white text-left font-bold mb-1 text-lg">Hvað þarf ég að bíða lengi fyrir utan brottfarir eða komusal eftir starfsmanni ykkar?</h3>
                    <p class="text-left text-white leading-normal mb-6">
                        Okkar markmið er að þú þurfir EKKI að bíða meira en 60 sekúndur.
                    </p>

                    <h3 class="text-white text-left font-bold mb-1 text-lg">Spurningar varðandi bón og aukaþjónustu</h3>
                    <p class="text-left text-white leading-normal mb-6">
                        Við rekum okkar eigin bónstöð til að hámarka gæði þjónustunnar. Við erum í góðu samstarfi við önnur fyrirtæki sem sérhæfa sig í þeirri þjónustu sem við bjóðum upp á, en sjáum ekki sjálf um þjónustu eins og skoðun, olíuskipti og dekkjaskipti.
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
