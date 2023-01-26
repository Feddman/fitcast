<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-medium leading-tight text-2xl mt-0 mb-2 text-blue-600">My preferred activities </h2>
                    @if(!isset($activities))
                        <p class="text-x0.5 font-light leading-relaxed mt-4 mb-2 text-gray-800">You currently have no preferred activities!</p>
                        <a href="{{route('activities.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add a new preferred activity</a>
                        @endif
                 

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
