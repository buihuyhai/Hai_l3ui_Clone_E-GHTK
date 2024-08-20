<form
    id="bulk-action-form"
    action="{{$url ?? ""}}"
    method="POST">
    @csrf
    <div class="row">
        <div class="col-2">
            <select
                name="action"
                class="form-select select-bulk-action"
                aria-label="Hành động">
                <option value="">Nhiều hành động</option>
                @yield("actions")
            </select>
        </div>

        <div class="col-2">
            @include("User::admin.components.buttons.button-submit",
                 [
                     "classes" => "btn-info text-white btn-bulk-action",
                     "title" => "Áp dụng",
                     "type" => "button"
                 ]
             )
        </div>
    </div>
</form>

