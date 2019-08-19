@extends ('layouts.master')

@section ('main')
    <section id="home" class="relative min-h-screen w-full background">
        <navbar></navbar>

        <div class="container max-w-4xl mx-auto px-6 pt-16 md:pt-32 pb-24 md:pb-0">
                <div class="flex flex-col w-full">
                    <h1 class="text-center text-5xl text-white font-bold mb-2">Verðskrá</h1>
                    <p class="italic text-white text-center mb-6">4.500kr þjónustugjald</p>

                    <div class="w-full">
                        <div class="bg-white shadow rounded my-6 overflow-x-auto">
                            <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                                <thead>
                                    <tr>
                                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light"></th>
                                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Fólksbíll</th>
                                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Jepplingur</th>
                                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Jeppi</th>
                                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Yfirstærð</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light font-bold">Geymslugjald</td>

                                    <td class="py-4 px-6 border-b border-grey-light">500kr (á dag)</td>
                                    <td class="py-4 px-6 border-b border-grey-light">500kr (á dag)</td>
                                    <td class="py-4 px-6 border-b border-grey-light">500kr (á dag)</td>
                                    <td class="py-4 px-6 border-b border-grey-light">500kr (á dag)</td>
                                </tr>
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light font-bold">Rúðuvökvi</td>

                                    <td class="py-4 px-6 border-b border-grey-light">1.490kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">1.490kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">1.490kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">1.490kr</td>
                                </tr>
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light font-bold">Alþrif & Bón</td>

                                    <td class="py-4 px-6 border-b border-grey-light">14.500kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">16.500kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">17.500kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">22.500kr</td>
                                </tr>
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light font-bold">Þrif að utan & Bón</td>

                                    <td class="py-4 px-6 border-b border-grey-light">8.900kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">10.900kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">11.900kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">16.900kr</td>
                                </tr>
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light font-bold">Þrif að innan</td>

                                    <td class="py-4 px-6 border-b border-grey-light">5.900kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">6.900kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">7.900kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">8.900kr</td>
                                </tr>
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light font-bold">Vélarþvottur</td>

                                    <td class="py-4 px-6 border-b border-grey-light">4.000kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">4.000kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">4.000kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">4.000kr</td>
                                </tr>

                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light font-bold">Olíuskipti</td>

                                    <td class="py-4 px-6 border-b border-grey-light">16.900kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">18.900kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">22.900kr</td>
                                    <td class="py-4 px-6 border-b border-grey-light">26.900kr</td>
                                </tr>

                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light font-bold">Inni geymsla</td>

                                    <td class="py-4 px-6 border-b border-grey-light">1.290kr (á dag)</td>
                                    <td class="py-4 px-6 border-b border-grey-light">1.290kr (á dag)</td>
                                    <td class="py-4 px-6 border-b border-grey-light">1.290kr (á dag)</td>
                                    <td class="py-4 px-6 border-b border-grey-light">1.290kr (á dag)</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="w-full md:pb-16">
                    <h3 class="font-bold text-white text-2xl mb-2">Aðrar þjónustur:</h3>

                    <p class="text-white text-lg">Aðalskoðun: 15.000kr</p>
                    <p class="text-white text-lg">Dekkjaskipti: 11.000kr</p>
                    <p class="text-white text-lg">Rafhleðsla: 3.000kr</p>
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
