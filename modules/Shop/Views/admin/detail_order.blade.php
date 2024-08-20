<div class="modal fade" id="{{ $modalId ?? '' }}" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title ?? "" }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" id="id-variant">
                        <!-- Default Tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Detail</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Info</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="myTabContent">
                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row p-2">
                                        @include('Shop::common.table',[
                                            'field' => [
                                                'Ảnh' => 'thumbnail',
                                                'Giá bán' => 'sale_price',
                                                'Giá nhap' => 'sold',
                                                'Số lương' => 'sold',
                                                'Tổng tiền' => 'sold',
                                            ],
                                            'action' => false,
                                            'idTable' => 'data-detail',
                                        ])
                                    </div>

                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <ul class="list-group" id="info">
                                </ul>
                            </div>
                        </div><!-- End Default Tabs -->
            </div>
            <div class="modal-footer" id="modal-footer">
{{--                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>--}}
{{--                <button type="button" class="btn btn-primary" onclick="{{ $submit ?? "" }}">Lưu</button>--}}
            </div>
        </div>
    </div>
</div>
