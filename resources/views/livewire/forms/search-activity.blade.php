  <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <form class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-lg font-medium mb-4">What activity do you want to do?</h2>
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

        <x-input.date-time labelTitle="At what time do you want to start?"></x-input>

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

        <x-button.primary />
    </form>
</div>
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
            fetch(`/api/v1/weather/${latitude}/${longitude}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                });
        }

        // handle error case
        function onError() {
            console.log(`Failed to get your location!`);
        }
    })();

</script>
