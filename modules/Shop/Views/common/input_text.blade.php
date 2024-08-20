<div id="{{ $idParentInput ?? "" }}">
    <div  class=" {{ $classParent ?? 'row' }} {{ ($displayImage ?? false) === true ? 'mb-0' : '' }}">
        <label for="{{ $id ?? $name }}" class=" {{ $classLabel ?? 'col-sm-2 col-form-label' }} d-flex align-items-center">
            {{ ucfirst($label ?? $name) }}
            {!! ($required ?? false) ? '<span id="star-required">*</span>' : '' !!}
        </label>
        <div class="col-sm-10">
            <input class="{{ $classInput ?? 'form-control' }}" type="{{ $type ?? 'text' }}"
                   {{ ($required ?? false) ? 'required' : '' }}
                   name="{{ $name }}"
                   id="{{ $id ?? $name }}" onchange="{{ $change  ?? "" }}"
                   placeholder="{{ $placeholder ?? ($label ?? $name) }}"
                   oninput ="{{ $oninput ?? "" }}"
                   {{ (isset($min)  ?? false) ? 'min='.$min : '' }}
                   {{ (isset($max)  ?? false) ? 'max='.$max : '' }}
                   {{ (isset($step)  ?? false) ? 'step='.$step : '' }}
                {{ ($readonly ?? false) ? 'readonly' : '' }}
                value="{{ $value ?? null }}"
            >
            @if(str_contains(($type ?? ''),'file') && ($displayImage ?? false) === true)
                    <div class="{{ $classInput ?? '' }}">
                        <img src="#" id="blah" alt="your image" class="img-thumbnail mt-3" />
                    </div>
                <script>

                    function changeFile(element){
                        let parentElement = element.parentNode.parentNode
                        let blah = parentElement.querySelector("#blah")
                        const [file] = element.files
                        if (file) {
                            blah.src = URL.createObjectURL(file);
                            blah.width =150;
                            blah.height =150;
                        }
                    }
                    {{--console.log($('#' + '{{ ($modalId ?? '') . "-" .($id ?? $name) ?? '' }}'))--}}
                    {{--imgInp.on('change', function (){--}}
                    {{--    console.log("a")--}}

                    {{--})--}}

                </script>
            @endif

        </div>
    </div>

</div>
