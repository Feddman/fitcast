<div class="flex flex-col gap-2">
    <label class="block text-gray-700 font-medium" for="">
      {{ $slot }}
    </label>
    <input
      {{$attributes}}
      class="start-time border border-gray-400 p-2 w-full rounded"
      type="datetime-local"
      name="starttime"
      value="{{ now()->format('Y-m-d\TH:i') }}"
      step="60"
      min="{{ now()->format('Y-m-d\TH:i')  }}"
      max="{{ now()->addDay()->format('Y-m-d\TH:i') }}"
    />
</div>
