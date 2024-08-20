@extends("Layout::admin.app")

@push("css")

    <style>
        .border-input {
            border: 1px solid #333;
        }
    </style>

@endpush

@section("content")

    @include("Layout::admin.components.messages.index")
    <form
        action=""
        method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><strong>{{__("Vai trò")}}</strong></th>
                            @foreach($roles as $role)
                                <th class="text-center">
                                    <strong>
                                        {{$role?->title}}
                                    </strong>
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>

                        @if(!empty($permissionsGroup))
                            @foreach($permissionsGroup as $groupName => $permissions)
                                <tr class="">
                                    <td><i class="bi bi-caret-right-fill"></i></td>
                                    <td><strong>{{\Modules\Core\Hooks\ModuleHook::MODULES[$groupName]}}</strong></td>
                                    @foreach($roles as $role)
                                        <td></td>
                                    @endforeach
                                </tr>
                                @if(!empty($permissions))
                                    @foreach($permissions as $permission => $title)
                                        <tr>
                                            <td></td>
                                            <td>{{$title}}</td>
                                            @foreach($roles as $role)
                                                <td class="text-center">
                                                    <input
                                                        data-role="{{$role->id}}"
                                                        class="form-check-input border-input permission-input"
                                                        type="checkbox"
                                                        @if(in_array($permission, $selectedIds[$role->id])) checked
                                                        @endif
                                                        name="matrix[{{$role->id}}][]"
                                                        value="{{$permission}}"
                                                    >
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr/>

        <div class="d-flex justify-content-end">
            <button
                type="submit"
                class="btn btn-primary">{{__("Lưu thay đổi")}}</button>
        </div>

    </form>

@endsection

@push("js")
    <script>

        $(document).ready(function() {
            const permissionInputs = $('.permission-input');

            permissionInputs.change(function(e) {
                const module = $(this).val().split('_').pop();

                const role = $(this).data('role');

                const isChecked = this.checked;

                const filteredInputs = $('input[data-role="' + role + '"]').filter(function() {
                    return this.value.includes(module) && !this.value.includes('manage_');
                });

                const filteredInputsChecked = filteredInputs.filter(function() {
                    return this.checked;
                });

                if ($(this).val().includes('manage_')) {
                    filteredInputs.prop('checked', isChecked);
                } else {
                    const value = `manage_${module}`;

                    if (value && role) {
                        const manageModuleInputs = $('input[type="checkbox"][data-role="' + role + '"][value="' + value + '"]');

                        if (manageModuleInputs.length > 0) {

                            const manageModuleInput = manageModuleInputs[0];

                            if (manageModuleInput.checked && filteredInputsChecked.length === 0) {
                                manageModuleInput.checked = false;
                            } else {
                                manageModuleInput.checked = true;
                            }
                        }
                    }
                }
            });
        });

    </script>
@endpush


