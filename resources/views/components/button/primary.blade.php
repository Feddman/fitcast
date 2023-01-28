<button {{ $attributes->class([
    'bg-indigo-500 text-white py-4 px-6 rounded-lg hover:bg-indigo-600 w-full disabled:text-gray-600 disabled:bg-gray-400 disabled:cursor-not-allowed disabled:hover:bg-gray-400',
]) }}>
    {{ $slot }}
</button>
