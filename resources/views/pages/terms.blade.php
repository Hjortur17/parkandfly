@extends ('layouts.master')

@section ('main')
    <section id="home" class="relative h-screen w-full background">
        <navbar></navbar>

        <div class="container max-w-4xl mx-auto px-6">
            <div class="md:min-h-screen p-0 flex flex-col flex-no-wrap justify-center md:items-center py-16 mb:py-0">

                <div class="flex flex-col">
                    <h1 class="text-left text-5xl text-white font-bold mt-16 mb-6">Skilmálar</h1>

                    <h3 class="font-bold text-left text-lg text-white text-xl">Persónuupplýsingar: </h3>
                    <p class="text-left text-lg text-white text-lg mb-6">
                        Viðskiptavinir gefa upp nafn sitt, kennitölu, upplýsingar um bílinn og ferðaáætlun. Þessar upplýsingar verða einungis notaðar til að aðstoða þig á sem bestan hátt.  Allar upplýsingar um greiðslur fara í gegnum Korta og Netgíró. Park And Fly hefur ekki aðgang að þeim upplýsingum. 
                    </p>

                    <h3 class="font-bold text-left text-lg text-white text-xl">Endurgreiðsla: </h3>
                    <p class="text-left text-lg text-white text-lg mb-6">
                        Ekki er hægt að fá endurgreitt ef afbókað er innan við 24 klst. fyrir brottför!
                    </p>

                    <h3 class="font-bold text-left text-lg text-white text-xl">Ábyrgðarmál: </h3>
                    <p class="text-left text-lg text-white text-lg">
                        Tjón á bílum viðskiptavina eru að fullu tryggð meðan þeir eru í vörslu hjá Park And Fly. Svæðin okkar eru afgirt og varinn með öryggismyndavélakerfum og flóðlýsingum.  Enginn umgangur er leyfð á svæðum okkar nema fyrir starfsmenn. 
                    </p>
                    <p class="text-left text-lg text-white text-lg mb-6">
                         Ef sannarlegt tjón verður á bíl meðan hann er í umsjá starfmanns Park And Fly þá greiðir fyrirtækið allan kostnað. Komi upp bilun í bifreið sem er í umsjá Park And Fly sem rekja má til eðlilegar bilunar í bílnum sjálfum ber Park And Fly ENGA ÁBYRGÐ á því tjóni. Dæmi um slíka bilun gæti verið slit á tímareim eða önnur eðlileg slit á eldri bílum.
                    </p>

                    <h3  class="font-bold text-left text-lg text-white text-xl">Lög og varningur: </h3>
                    <p class="text-left text-lg text-white text-lg leading-normal mb-6">
                        Ákvæði og skilmálar þessir ber að túlka í samræmi við íslensk lög.  Komi upp ágreiningur eða telji einhver að hann eigi kröfu á hendur Park And Fly ehf. á grundvelli þessara ákvæða og skilmála verður slíkum ágreiningi eða kröfu vísað til meðferðar hjá íslenskum dómstólum.
                    </p>

                    <p class="text-left text-lg text-white text-lg leading-normal mb-6 font-bold">
                        Athuga þegar greitt er fyrir þjónustu hjá okkur er greitt 500kr minna en upplagt verð fyrir útgöngumiða á bílastæði Isavia. 
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
