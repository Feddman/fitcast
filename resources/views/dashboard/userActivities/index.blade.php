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
                    @if(session('status'))
                    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3">
                        <p class="font-bold text-sm">{{ session('status') }}</p>
                    </div>
                    @endif

                    @if(!isset($userActivities))
                        <p class="text-x0.5 font-light leading-relaxed mt-4 mb-2 text-gray-800">You currently have no preferred activities!</p>
                        <a href="{{route('userActivities.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add a new preferred activity</a>
                    @endif
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3 text-xs text-gray-700 uppercase bg-gray-50 dark:text-gray-400">Activity</th>
                            <th class="px-6 py-3 text-xs text-gray-700 uppercase bg-gray-50 dark:text-gray-400">Delete</th>
                        </tr>

                        @foreach(auth()->user()->favoriteActivities as $favoriteActivity)
                            <tr>
                                <td class="px-6 py-4">{{$favoriteActivity->name}}</td>
                                <td class="px-6 py-4"><form action="{{ route('userActivities.destroy', $favoriteActivity->pivot->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                </form>
                                </td>
                               
                            </tr>
                        @endforeach
                    </table>

                    <a href="{{route('userActivities.create')}}" class="mt-30 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add new preferred activity</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
