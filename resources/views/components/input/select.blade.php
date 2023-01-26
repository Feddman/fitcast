<div class="mb-4">
    <label class="block text-gray-700 font-medium mb-2" for="">
        {{ $labelTitle }}
    </label>
    <select {{$attributes->only(['wire:model', 'id'])}} class="border border-gray-400 p-2 w-full" name="" id="">
          <option value="">Please select</option>
        @foreach($options as $option)
            <option value="{{$option['id']}}">{{$option['name']}}</option>
        @endforeach
    </select>
</div>
