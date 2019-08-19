@extends ('layouts.master')

@section ('main')
    <section id="home" class="relative md:h-screen w-full background">
        <navbar></navbar>

        <div class="container max-w-4xl mx-auto px-6 mt-16 md:mt-0 pb-24 md:pb-0">
            <div class="md:min-h-screen p-0 flex flex-col flex-no-wrap md:justify-center md:items-center">
                <div class="flex flex-col">
                    <h1 class="text-left text-5xl text-white font-bold mb-6">Um Okkur</h1>

                    <p class="text-left text-lg text-white text-lg leading-normal">
                        Park And fly var stofnað í mars 2019. Stofnendur þess eru Reynir Bergmann Reynisson og Sólveig Ýr Sigurjónsdóttir.
                    </p>

                    <p class="text-left text-lg text-white text-lg leading-normal my-4">
                        Fyrirtækið var stofnað vegna þess að það vantaði betri og skilvirkari þjónustu fyrir geymslu á bílum fyrir viðskiptavini og farþega Leifsstöðvar.
                    </p>

                    <p class="text-left text-lg text-white text-lg leading-normal">
                        Tilgangur fyrirtækisins er að veita viðskiptavinum hágæða þjónustu við vörslu á bílum þeirra á meðan þeir ferðast erlendis. Aðeins er boðið upp á lokuð, varinn og upplýst svæði!
                    </p>

                    <p class="text-left text-lg text-white text-lg leading-normal mt-10">
                        Park And Fly ehf.
                    </p>
                    <p class="text-left text-lg text-white text-lg leading-normal">
                         Helguvíkurvegi 5
                    </p> 

                    <p class="text-left text-lg text-white text-lg leading-normal">251 Suðurnesjabær </p>

                    <p><a href="mailto:parkandfly@parkandfly.is" class="text-left text-white text-lg leading-normal hover:bg-orange-400">parkandfly@parkandfly.is</a></p>

                    <p><a href="tel:+3546800000" class="text-left text-white text-lg leading-normal hover:bg-orange-400"> 680-0000 </a></p>

                    <p class="text-left text-lg text-white text-lg leading-normal my-4">
                        Kt. 650119-1340
                        Vsk.nr 135267
                    </p>

                    <p class="text-left text-lg text-white text-lg leading-normal">
                        Opið allan sólahringinn allt árið um kring.
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
