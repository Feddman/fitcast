<div class="mx-4 sm:mx-6 lg:mx-8 w-full max-w-prose">
    <form class="flex flex-col gap-4 bg-white p-6 rounded-lg shadow-md">
        <div>
            <h2 class="text-lg font-medium">Get recommended an activity</h2>
            <p class="text-gray-500">Taking the weather into account</p>
        </div>
        <x-input.select id="activity" labelTitle="Activity Type" :options="[
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
            <div class="flex flex-col -space-y-10 row-start-1 col-start-1 w-full h-full rounded-lg bg-white gap-4 items-center transition opacity-0 text-center p-4 weather-result">
                <img src="" alt="" class="h-full animate-hover -pb-2">
                <p class="weather-description font-bold text-lg pb-2"></p>
                <span class="weather-cache-time italic text-gray-400 bottom-2 right-4 text-sm absolute"></span>
            </div>
        </div>

        <x-input.select id="intensity" labelTitle="Intensity" :options="[
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

                        let dataState = 'Fresh data';

                        if (data.fromCacheOriginalTime) {
                            dataState = `Data fetched at ${new Date(data.fromCacheOriginalTime * 1000).toLocaleTimeString()}`;
                        }

                        weatherResultEl.querySelector('.weather-cache-time').innerText = dataState;

                        backgroundImageEl.addEventListener('load', () => {
                            backgroundImageEl.classList.remove('opacity-0');
                            backgroundImageEl.classList.add('opacity-100');
                        });

                        backgroundImageEl.src = `{{ url('images/') }}/${data.icon}.jpg`;
                    });
            }

            // handle success case
            function onSuccess(position) {
                const {
                    latitude,
                    longitude
                } = position.coords;

                console.log(`Your location: (${latitude},${longitude})`);
                document.querySelector('.start-time').addEventListener('change', (e) => {
                    console.log(e.target.value);
                    let unixTime = Math.floor(new Date(e.target.value).getTime() / 1000);
                    console.log(unixTime);
                    fetch(`/api/v1/weather/${latitude}/${longitude}/${unixTime}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            document.querySelector('.weather-result').classList.remove('hidden');
                            document.querySelector('.weather-result img').src = data.icon;
                            document.querySelector('.weather-result .weather-description').innerHTML = data.description;
                        });
                });
                startTimeEl.addEventListener('change', (e) => {
                    console.log('test');
                    refreshWeather(latitude, longitude);
                });

                refreshWeather(latitude, longitude);
            }

            // handle error case
            function onError() {
                console.log(`Failed to get your location!`);
            }

            document.querySelector('.btn-submit').addEventListener('click', (e) => {
                e.preventDefault();
                console.log('submit');
                let activity = document.querySelector('#activity').value;
                let startTime = document.querySelector('.start-time').value;
                let intensity = document.querySelector('#intensity').value;
                console.log(activity, startTime, intensity);
                fetch(`/api/v1/activity/proposal/${activity}/${intensity}/${startTime}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                    });
            });
        })();
    </script>
</div>
