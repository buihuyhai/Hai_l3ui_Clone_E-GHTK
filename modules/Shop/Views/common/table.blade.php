<table class="{{$classTable ?? "table table-striped"}}" style="overflow-x: scroll " id="{{ $idTable ?? ""}}">
    <thead>
    <tr>
        @if( $usingIndex ?? true )
            <th scope="col">#</th>
        @endif
        @foreach($field as $head => $value)
            <th scope="col">{{ $head }}</th>
        @endforeach
        @if($action ?? false )
            <th scope="col">Action</th>
        @endif
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
