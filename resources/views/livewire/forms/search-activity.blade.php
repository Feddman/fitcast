<div class="mx-4 sm:mx-6 lg:mx-8 w-full max-w-prose">
    <form class="flex flex-col gap-4 bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-lg font-medium">What activity do you want to do?</h2>
        <x-input.select labelTitle="Activity" :options="[
        [
            'id' => 1,
            'name' => 'Mostly Cardio'
        ],
        [
            'id' => 2,
            'name' => 'Mostly Strength'
        ]
        ]" />

        <x-input.date-time>At what time do you want to start?</x-input.date-time>
        <div class="grid place-items-center grid-cols-1 grid-rows-1 border border-gray-200 rounded-lg shadow relative h-32">
            <p class="row-start-1 col-start-1 italic text-gray-400">
                Loading weather for selected time...
            </p>
            <div class="flex flex-col -space-y-10 row-start-1 col-start-1 w-full h-full bg-white gap-4 items-center transition opacity-0 text-center p-4 weather-result">
                <img src="" alt="" class="h-full animate-hover -pb-2">
                <p class="weather-description font-bold text-lg pb-2"></p>
            </div>
        </div>

        <x-input.select labelTitle="Intensity" :options="[
            [
                'id' => 1,
                'name' => 'High Intensity'
            ],
            [
                'id' => 2,
                'name' => 'Medium Intensity'
            ],
            [
                'id' => 3,
                'name' => 'Low Intensity'
            ]
        ]" />
        <x-button.primary>
            Find Activities!
        </x-button.primary>
    </form>
    <script>
        (()=>{
            const startTimeEl = document.querySelector('.start-time');
            const backgroundImageEl = document.querySelector('#backgroundImage');
            const weatherResultEl = document.querySelector('.weather-result');

            if (!navigator.geolocation) {
                console.error(`Your browser doesn't support Geolocation`);
            } else {
                navigator.geolocation.getCurrentPosition(onSuccess, onError);
            }

            function refreshWeather(latitude, longitude) {
                let unixTime = Math.floor(new Date(startTimeEl.value).getTime() / 1000);
                console.log(`Your location: (${latitude},${longitude})`);
                console.log(unixTime);
                fetch(`/api/v1/weather/${latitude}/${longitude}/${unixTime}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        weatherResultEl.classList.remove('opacity-0');
                        weatherResultEl.classList.add('opacity-100');
                        weatherResultEl.querySelector('img').src = `http://openweathermap.org/img/wn/${data.icon}@2x.png`;
                        weatherResultEl.querySelector('.weather-description').innerHTML = data.description;

                        let icon = data.icon;

                        // TODO: night time images
                        if(icon.endsWith('n')){
                            icon = icon.replace('n', 'd');
                        }

                        backgroundImageEl.addEventListener('load', () => {
                            backgroundImageEl.classList.remove('opacity-0');
                            backgroundImageEl.classList.add('opacity-100');
                        });
                        
                        backgroundImageEl.src = `{{ url('images/') }}/${icon}.jpg`;
                    });
            }

            // handle success case
            function onSuccess(position) {
                const {
                    latitude,
                    longitude
                } = position.coords;

                startTimeEl.addEventListener('change', (e) => {
                    refreshWeather(latitude, longitude);
                });

                refreshWeather(latitude, longitude);
            }

            // handle error case
            function onError() {
                console.log(`Failed to get your location!`);
            }
        })();
    </script>
</div>
