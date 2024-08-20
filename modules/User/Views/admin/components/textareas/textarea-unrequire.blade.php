<div class="form-group">
    <label for="{{$id ?? ""}}">{{$label ?? ""}}
    </label>
    <textarea
        class="form-control {{$classes ?? ""}}"
        name="{{$name ?? ""}}"
        rows="{{$rows ?? 10}}"
        cols="{{$cols ?? ""}}"
        id="{{$id ?? ""}}"
        placeholder="{{$placeholder ?? ""}}"
        {{$attrs ?? ""}}
    >
        {{$value ?? ""}}
    </textarea>
</div>
