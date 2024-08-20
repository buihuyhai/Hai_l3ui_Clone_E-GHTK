@if ($message = Session::get('success'))
    <div
        class="alert alert-success alert-block alert-dismissible fade show"
        role="alert">
        <button
            type="button"
            class="close btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
            data-dismiss="alert">
        </button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('danger'))
    <div
        class="alert alert-danger alert-block alert-dismissible fade show"
        role="alert">
        <button
            type="button"
            class="close btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
            data-dismiss="alert">
        </button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div
        class="alert alert-danger alert-block alert-dismissible fade show"
        role="alert">
        <button
            type="button"
            class="close btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
            data-dismiss="alert">
        </button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('warning'))
    <div
        class="alert alert-warning alert-block alert-dismissible fade show"
        role="alert">
        <button
            type="button"
            class="close btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
            data-dismiss="alert">
        </button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('info'))
    <div
        class="alert alert-info alert-block alert-dismissible fade show"
        role="alert">
        <button
            type="button"
            class="close btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
            data-dismiss="alert">
        </button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($errors->any())
    <div
        class="alert alert-danger alert-block alert-dismissible fade show"
        role="alert">
        <button
            type="button"
            class="close btn-close"
            data-bs-dismiss="alert"
            aria-label="Close"
            data-dismiss="alert">
            <i
                class="fa fa-times"
                aria-hidden="true"></i>
        </button>
        {{__("Dữ liệu không hợp lệ!")}}
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
