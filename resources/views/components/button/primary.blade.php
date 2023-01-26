<button {{ $attributes->class([
    'bg-indigo-500 text-white py-2 px-4 sm:py-4 sm:px-6 rounded-lg hover:bg-indigo-600 w-full disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-indigo-500',
]) }}>
    {{ $slot }}
</button>
