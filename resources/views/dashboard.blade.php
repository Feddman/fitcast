<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-medium leading-tight text-2xl mt-0 mb-2 text-blue-600 ">Your personal page </h2>
                    <div class="dashboard-items p-5">
                        <a href="" class="ring-blue-400 ring-1 rounded text-white bg-blue-500 p-2.5 hover:bg-blue-600">Your profile</a>
                        <a href="{{route('userActivities.index')}}" class="ring-blue-400 ring-1 rounded text-white bg-blue-500 p-2.5 hover:bg-blue-600">My preferred activities</a>
                    </div>
                 

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
