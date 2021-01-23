<div class="relative px-5" style="overflow: hidden; width: 100%">
    <div id="sidebar">
        <div class="gradient-line"></div>

        <div class="header">
            <h1 class="mb-3">Odaberite lokaciju za dostavu</h1>

            <label for="current" class="block mb-3" wire:click.stop>
                <input type="radio" class="inline-block ml-2" name="address" id="current" value="current">
                Trenutna lokacija
            </label>
            {{--                        @if(auth()->user()->address !== "")--}}
            <div class="gradient-line"></div>
            <label for="registred" class="block mb-3 mt-3" wire:click.stop>
                <input type="radio" class="inline-block ml-2" name="address" id="registred" value="registred">
                <input type="hidden" name="registered" value="{{ auth()->user()->address }}">
                Registrovanu adresu ({{ auth()->user()->address }})
            </label>
            {{--                        @endif--}}
            <div class="gradient-line"></div>
            <div class="search-container" wire:ignore>
                <h2 class="city-label">Unesite vašu adresu</h2>
                <div class="outer-city-field-container">
                    <img src="/map/resources/outline-search-24px.svg">
                    <div class="inner-city-field-container">
                        <div contenteditable="true" class="city-field"></div>
                        <div class="city-field-suggestion"></div>
                    </div>
                </div>
            </div>

            <div class="gradient-line"></div>

            <p class="py-4">
                Ukoliko želite da dostavite na trenutnu adresu, odaberite "trenutna adresa"
            </p>
            <div class="gradient-line"></div>
            <p class="py-4">
                Ukoliko niste pronašli vašu tačnu adresu, možete nam pomoći tako što ćete kliknuti na kuću,
                zgradu ili površinu. Na taj način ste 100% sigruni da je to adresa gdje želite da dostavimo.
            </p>
            <div class="gradient-line"></div>

        </div>
        <div class="tabs">
            <div class="tab-container" style="display: none;">
                <div class="tab tab-active" id="tab-1">
                    Isoline Options
                </div>
            </div>
            <div class="tab-bar"></div>
        </div>
        <div class="content">
            <div class="content-group" id="content-group-1">
                <div class="group columns" style="display: none;">
                    <div class="col">
                        <h2>Mode</h2>
                        <label class="radio-container">
                            <input class="isoline-controls" type="radio" id="car" name="mode" checked>
                            <span class="checkmark"></span>
                            Car
                        </label>
                    </div>
                </div>

                <div class="group" style="display: none;">
                    <h2>Date</h2>
                    <input class="isoline-controls text-input" id="date-value" type="date" name="date">
                </div>

                <div class="group" style="display: none;">
                    <div class="h2-row">
                        <h2>Time</h2>
                        <div id="hour-slider-val" class="h2-val"></div>
                    </div>
                    <div class="graph-container">
                        <div class="no-graph-text">Distribution is only available in range type time and
                            mode car.
                        </div>
                        <div class="graph"></div>
                    </div>
                    <input class="isoline-controls slider" id="hour-slider" type="range" min="0" max="23"
                           value="10"/>
                </div>
            </div>

        </div>
    </div>
    <div id="map" wire:ignore></div>
</div>
