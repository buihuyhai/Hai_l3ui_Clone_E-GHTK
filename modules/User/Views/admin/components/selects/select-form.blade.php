<div class="form-group">
    <select
        class="form-select {{$classes ?? ""}}"
        name="{{$name ?? ""}}"
        id="{{$id ?? ""}}">
        @if(isset($options) && !empty($options))
            @foreach($options as $option)
                <option
                    value="{{$option['value'] ?? ''}}"
                    {{$option['selected'] ?? ''}}
                >
                    {{$option['title'] ?? ''}}
                </option>
            @endforeach
        @endif
    </select>
</div>
