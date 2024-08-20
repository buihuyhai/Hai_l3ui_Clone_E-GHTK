<button class="{{ $classButton ?? 'btn' }} "
        data-toggle="modal" data-target="{{ '#'.($modalId ?? '')}}"
        onclick="{{ $onclick ?? '' }}"
        data-id="{{ $dataId ?? null }}"
        title="{{ $title ?? '' }}"
        type="{{ $type ?? 'button' }}"
>
    <a href="{{ ($router ?? null) !== null ? route($router) : "#" }}">
        {{ $title ?? "Button" }}
    </a>
</button>
