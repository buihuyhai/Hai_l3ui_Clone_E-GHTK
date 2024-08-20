<a
    href="{{$url ?? ""}}"
    onclick="event.preventDefault(); document.getElementById('{{$id ?? ""}}').submit()"
    class="{{$classes ?? ""}} btn">
    {!! $icon ?? "" !!}
    {{$title ?? ""}}
    {{$attrs ?? ""}}
</a>
<form
    action="{{$url ?? ""}}"
    id="{{$id ?? ""}}"
    method="POST"
    class="hidden">
    @csrf
</form>
