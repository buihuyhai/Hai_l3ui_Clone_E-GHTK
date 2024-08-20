<div class="form-group">
    <input
        id="{{$id ?? ""}}"
        type="{{$type ?? "text"}}"
        name="{{$name ?? ""}}"
        value="{{$value ?? ""}}"
        placeholder="{{$placeholder ?? ""}}"
        class="form-control {{$classes ?? ""}}"
        {{$attrs ?? ""}}
    >
</div>
