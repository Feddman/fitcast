<div class="flex flex-col gap-2">
    <label class="block text-gray-700 font-medium" for="">
        {{ $labelTitle }}
    </label>
    <select {{$attributes->only(['wire:model', 'id'])}} class="border border-gray-400 p-2 w-full rounded" name="" id="">
          <option value="" disabled selected>Select {{ $labelTitle }}</option>
        @foreach($options as $option)
            <option value="{{$option['id']}}">{{$option['name']}}</option>
        @endforeach
    </select>
</div>
