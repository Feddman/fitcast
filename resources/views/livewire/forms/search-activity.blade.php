
  <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <form class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-lg font-medium mb-4">What activity do you want to do?</h2>
        <x-input.select id="activity" wire:model="activity" labelTitle="Activity" :options="[
        [
            'id' => 1,
            'name' => 'Mostly Cardio'
        ],
        [
            'id' => 2,
            'name' => 'Mostly Strength'
        ]
        ]" />

        <x-input.date-time wire:model="startTime" labelTitle="At what time do you want to start?"></x-input>
        <div class="flex text-center p-4 weather-result hidden border border-gray-200 rounded-lg shadow ">
            <img src="" alt="">
            <p class="weather-description font-bold "></p>
        </div>

        <x-input.select id="intensity" wire:model="intensity" labelTitle="Intensity" :options="[
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


        <x-button.primary />
    </form>
    <script>
        (()=>{

            if (!navigator.geolocation) {
                console.error(`Your browser doesn't support Geolocation`);
            } else {
                navigator.geolocation.getCurrentPosition(onSuccess, onError);
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
