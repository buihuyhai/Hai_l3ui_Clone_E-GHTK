<div id="{{ $idParentInput ?? "" }}">
    <div  class=" {{ $classParent ?? 'row' }} {{ ($displayImage ?? false) === true ? 'mb-0' : '' }}">
        <label for="{{ $id ?? $name }}" class=" {{ $classLabel ?? 'col-sm-2 col-form-label' }} d-flex align-items-center">
            {{ ucfirst($label ?? $name) }}
            {!! ($required ?? false) ? '<span id="star-required">*</span>' : '' !!}
        </label>
        <div class="col-sm-10">
            <textarea class="{{ $classInput ?? 'form-control' }}" type="{{ $type ?? 'text' }}"
                   {{ ($required ?? false) ? 'required' : '' }}
                   name="{{ $name }}"
                   id="{{ $id ?? $name }}" onchange="{{ $change  ?? "" }}"
                   placeholder="{{ $placeholder ?? ($label ?? $name) }}"
                   oninput ="{{ $oninput ?? "" }}"
                {{ ($readonly ?? false) ? 'readonly' : '' }}
            ></textarea>
        </div>
    </div>
</div>
