<div class="modal fade" id="{{ $modalId ?? '' }}" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title ?? "" }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id-variant-import">

                @include('Shop::common.input_text',[
                    'name' => 'number-import',
                    'required' => true,
                    'classParent' => 'row mb-3',
                    'label' => 'Số lượng',
                    'type' => 'number',
                ])

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="{{ $submit ?? "" }}">Lưu</button>
            </div>
        </div>
    </div>
</div>
