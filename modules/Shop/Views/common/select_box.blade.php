<div class="{{ $classParent ?? 'row mb-3' }} ">
    <label for="{{ $id ?? $name }}" class=" {{ $classLabel ?? 'col-sm-2 col-form-label' }} d-flex align-items-center">
        {{ ucfirst($label ?? $name) }}
        {!! ($required ?? false) ? '<span id="star-required">*</span>' : '' !!}
    </label>
    <div class="{{ $classSelect ?? 'col-sm-10' }}">
        <select {{ ($multipleSelect ?? false) ? 'multiple' : '' }} class="form-select" id="{{ (($id ?? $name) ?? '') }}" name="{{ $name ?? '' }}">
                        {!! ($required ?? false) ? '' : '<option value="">Select value</option>' !!}
            @foreach($data as $text => $each)
                <option value="{{ isset($nameValue) ? ($each->$nameValue ?? $each[$nameValue]) ?? '' : $each }}">{{ isset($nameDisplay) ? ($each->$nameDisplay ?? $each[$nameDisplay] )  ?? '' : $text}}</option>
            @endforeach
        </select>
    </div>
</div>
@push('js')
    <script>
        $("#" + "{{ $id ?? $name }}").select2({
            placeholder: '{{ $name ?? '' }}', // placeholder phải là một chuỗi
            {{--closeOnSelect : {{ $closeOnSelect ?? false }},--}}
            tags: {{ $createTag ?? 'false' }},
        });
    </script>
@endpush
