<div class="form-group">
    <label for="{{$id??""}}">{{$label ?? ""}} <span style="color: red">*</span></label>
    <input
        class="form-control {{$classes ?? ""}}"
        id="{{$id ?? ""}}"
        type="{{$type ?? "text"}}"
        name="{{$name ?? ""}}"
        value="{{$value ?? ""}}"
        placeholder="{{$placeholder ?? ""}}"
        {{$required ?? ""}}
        {{$attrs ?? ""}}
    >
    @error($name)
    <span style="color: red">{{$message}}</span>
    @enderror
</div>
