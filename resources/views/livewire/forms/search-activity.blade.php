<div class="w-full">
    @if($chosenActivity)
        <div class="p-6 flex flex-col gap-4 items-center justify-center bg-white shadow-md rounded-lg">
            <div class="text-center">
                <h3 class="font-bold text-2xl">How about {{$chosenActivity->name}}?</h3>
                @error('noFavoriteActivities')
                    <p class="text-gray-400 italic text-sm">{{ $message }}</p>
                    <a href="{{ route('userActivities.index') }}" class="text-blue-500 italic text-sm">Add some activities</a>
                @enderror
            </div>
            <p>This is an activity for {{ $chosenActivity->type }} {{$chosenActivity->type == 'both' ? 'inside and outside' : ''}} so that would be great for your chosen time!</p>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-4">
                    <h4 class="font-bold text-lg">Average duration</h4>
                    <p>This would take you roughly {{ $chosenActivity->average_duration }} minutes</p>
                </div>
                <div class="flex flex-col gap-4">
                    <h4 class="font-bold text-lg">Equipment</h4>
                    <p>{{$chosenActivity->equipment_required}}</p>
                </div>
                <div class="flex flex-col gap-4">
                    <h4 class="font-bold text-lg">Calories</h4>
                    <p>You will be burning <b> {{$chosenActivity->calories_burned}} calories </b> when performing at <b> {{ $chosenActivity->intensity }} </b> intensity</p>
                </div>
            </div>
        </div>
    @else
    <form class="flex flex-col gap-4 bg-white p-6 rounded-lg shadow-md"
        wire:submit.prevent="findActivities">
        <div>
            <h2 class="text-lg font-medium">Get recommended an activity</h2>
            <p class="text-gray-500">Taking the weather into account</p>

        </div>
        <input type="hidden" id="weatherCode" wire:model="weatherCode">
        <x-input.select wire:model="activityType" labelTitle="Activity Type" :options="[
        [
            'id' => 'cardio',
            'name' => 'Mostly Cardio'
        ],
        [
            'id' => 'strength',
            'name' => 'Mostly Strength'
        ]
        ]" />

        <x-input.date-time wire:model="startTime">At what time do you want to start?</x-input.date-time>
        <div wire:ignore class="grid place-items-center grid-cols-1 grid-rows-1 border border-gray-200 rounded-lg shadow relative h-32">
            <p class="row-start-1 col-start-1 italic text-gray-400">
                Loading weather for selected time...
            </p>
            <div class="flex flex-col -space-y-10 row-start-1 col-start-1 w-full h-full rounded-lg bg-white gap-4 items-center transition opacity-0 text-center p-4 weather-result">
                <img src="" alt="" class="h-full animate-hover -pb-2">
                <p class="weather-description font-bold text-lg pb-2"></p>
                <span class="weather-cache-time italic text-gray-400 bottom-2 right-4 text-xs absolute"></span>
            </div>
        </div>

        <x-input.select wire:model="intensity" labelTitle="Intensity" :options="[
            [
                'id' => 'high',
                'name' => 'High Intensity'
            ],
            [
                'id' => 'medium',
                'name' => 'Medium Intensity'
            ],
            [
                'id' => 'low',
                'name' => 'Low Intensity'
            ]
        ]" />
        <div>
            @error('chosenActivity')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror

            <x-button.primary type="submit"
                :disabled="empty($weatherCode) || empty($activityType) || empty($startTime) || empty($intensity)">
                Find Activities!
            </x-button.primary>
        </div>
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
                        weatherResultEl.querySelector('img').src = `http://openweathermap.org/img/wn/${data.code}@2x.png`;
                        weatherResultEl.querySelector('.weather-description').innerHTML = data.description;

                        let dataState = 'Fresh data';

                        if (data.fromCacheOriginalTime) {
                            dataState = `Data fetched at ${new Date(data.fromCacheOriginalTime * 1000).toLocaleTimeString()}`;
                        }

                        document.querySelector('#weatherCode').value = data.code;
                        document.querySelector('#weatherCode').dispatchEvent(new Event('input'));
                        weatherResultEl.querySelector('.weather-cache-time').innerText = dataState;

                        backgroundImageEl.addEventListener('load', () => {
                            backgroundImageEl.classList.remove('opacity-0');
                            backgroundImageEl.classList.add('opacity-100');
                        });

                        backgroundImageEl.src = `{{ url('images/') }}/${data.code}.jpg`;
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
                            document.querySelector('.weather-result img').src = data.code;
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
        })();
    </script>
    @endif

</div>
