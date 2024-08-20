@extends("Layout::admin.app")

@section("content")

    <div class="row d-flex justify-content-end">
        <div class="col-2">
            <a
                href="{{route("auth.admin.permission.matrix")}}"
                class="btn btn-warning mb-3 w-100"
            > {{__("Phân quyền")}}</a>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0">
                    <thead>
                    <tr>
                        <th>{{__("ID")}}</th>
                        <th>{{__("Vai trò")}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($rows->count()>0)
                        @foreach($rows as $key => $row)
                            <tr>
                                <td>{{__("#:id", ["id" => $key+1])}}</td>
                                <td><a href="#">{{$row->title}}</a></td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
