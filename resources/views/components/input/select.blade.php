<div class="flex flex-col gap-2">
    <label class="block text-gray-700 font-medium" for="">
        {{ $labelTitle }}
    </label>
    <select class="border border-gray-400 p-2 w-full rounded" name="" id="">
          <option value="">Please select</option>
        @foreach($options as $option)
            <option value="{{$option['id']}}">{{$option['name']}}</option>
        @endforeach
    </select>
</div>
