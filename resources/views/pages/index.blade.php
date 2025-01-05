@extends('layouts.app')
@section('title', 'Danh sách các loài hoa')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Danh Sách Loài Hoa</h4>
                    </div>
                    <a href="" class="btn btn-primary add-list" data-toggle="modal" data-target="#createModal"><i
                            class="las la-plus"></i>Thêm Mới Loài Hoa</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="data-table table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>STT</th>
                                <th>Ảnh Hoa</th>
                                <th>Tên</th>
                                <th>Tên Khoa Học</th>
                                <th>Bộ</th>
                                <th>Họ</th>
                                <th>Chi</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @php
                                // Tính số thứ tự bắt đầu của bản ghi đầu tiên trên trang hiện tại
                                $startIndex = ($datas->currentPage() - 1) * $datas->perPage() + 1;
                            @endphp
                            @foreach ($datas as $index => $data)
                                <tr data-id="{{ $data->id }}">
                                    <td>{{ $startIndex + $index }}</td>
                                    <td>
                                        <img src="{{ $data->anhHoa }}" class="img-fluid rounded avatar-50 mr-3"
                                            alt="image" />
                                    </td>
                                    <td>{{ $data->ten }}</td>
                                    <td>{{ $data->tenKhoaHoc }}</td>
                                    <td>{{ optional(optional(optional($data->chi)->ho)->bo)->ten ?? 'Không có dữ liệu' }}
                                    </td>
                                    <td>{{ optional(optional($data->chi)->ho)->ten ?? 'Không có dữ liệu' }}</td>
                                    <td>{{ optional($data->chi)->ten ?? 'Không có dữ liệu' }}</td>
                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge badge-info mr-2" data-toggle="modal" data-target="#viewModal"
                                                data-placement="top" title="View" href="#"
                                                data-id="{{ $data->id }}" data-ten="{{ $data->ten }}"
                                                data-anh_hoa="{{ $data->anhHoa }}"
                                                data-anh_phan_hoa="{{ $data->anhPhanHoa }}"
                                                data-ten_kh="{{ $data->tenKhoaHoc }}"
                                                data-kich_thuoc="{{ $data->kichThuoc }}"
                                                data-dac_diem="{{ $data->dacDiem }}"
                                                data-be_mat="{{ $data->beMat ? $data->beMat->ten : 'Không có thông tin' }}"
                                                data-chi="{{ $data->chi ? $data->chi->ten : 'Không có thông tin' }}"
                                                data-phan="{{ $data->phan ? $data->phan->ten : 'Không có thông tin' }}"
                                                data-khau_do="{{ $data->khauDo ? $data->khauDo->ten : 'Không có thông tin' }}"
                                                data-model="{{ $data->model ? $data->model->ten : 'Không có thông tin' }}">
                                                <i class="ri-eye-line mr-0"></i></a>
                                            <a class="badge bg-success mr-2 edit" href="#" title="Edit"
                                                data-toggle="modal" data-target="#editModal" data-id="{{ $data->id }}"
                                                data-ten="{{ $data->ten }}" data-ten_kh="{{ $data->tenKhoaHoc }}"
                                                data-kich_thuoc="{{ $data->kichThuoc }}"
                                                data-dac_diem="{{ $data->dacDiem }}"
                                                data-be_mat="{{ $data->beMat ? $data->beMat->id : 'Không có thông tin' }}"
                                                data-chi="{{ $data->chi ? $data->chi->id : 'Không có thông tin' }}"
                                                data-phan="{{ $data->phan ? $data->phan->id : 'Không có thông tin' }}"
                                                data-khau_do="{{ $data->khauDo ? $data->khauDo->id : 'Không có thông tin' }}"
                                                data-model="{{ $data->model ? $data->model->id : 'Không có thông tin' }}"><i
                                                    class="ri-pencil-line mr-0"></i></a>
                                            <a class="badge bg-warning mr-2 delete" href="#" title="Delete"
                                                data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{ $data->id }}"><i class="ri-delete-bin-line mr-0"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Page end  -->
    </div>

    <!-- View Modal HTML -->
    <div id="viewModal" class="modal fade">
        <div class="modal-dialog" style="max-width: 675px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Thông tin chi tiết loài Hoa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="card card-block card-stretch card-height-helf mb-0" style="border: none">
                    <div class="card-body card-item-right">
                        <div class="align-items-top row">
                            <div class="rounded w-100 col-md-5">
                                <img id="anh_hoa" class="style-img img-fluid m-auto" alt="image">
                            </div>
                            <div class="style-text text-left col-md-7 ml-0">
                                <h5 id="ten" class="mb-2"></h5>
                                <hr>
                                <p class="mb-2">Tên Khoa Học : <span id="ten_kh"></span></p>
                                <p class="mb-2">Kích Thước : <span id="kich_thuoc"></span></p>
                                <hr>
                                <p class="mb-2">Đặc Điểm : <span id="dac_diem"></span></p>
                                <p class="mb-0">Bề Mặt : <span id="be_mat"></span></p>
                                <hr>
                                <p class="mb-2">Chi : <span id="chi"></span></p>
                                <p class="mb-2">Phần : <span id="phan"></span></p>
                                <p class="mb-0">Khẩu Độ : <span id="khau_do"></span></p>
                                <hr>
                                <p class="mb-0">Model Training : <span id="model"></span></p>
                            </div>
                            <div id="list-anh-phan-hoa" class="d-flex flex-wrap justify-content-center w-100 mt-2"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-danger" data-dismiss="modal" value="Đóng">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Create Modal HTML -->
    <div id="createModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createForm" action="{{ route('ThemHoa') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm Loài Hoa Mới</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group d-flex flex-col">
                            <div class="w-50 pr-1">
                                <label>Chi</label>
                                <select name="chi" class="selectpicker form-control" data-style="py-0"
                                    data-live-search="true">
                                    <option value="">Chọn Chi</option>
                                    @foreach ($chi_datas as $data)
                                        <option value="{{ $data->id }}">{{ $data->ten }} ({{ $data->ho->ten }})
                                            ({{ $data->ho->bo->ten }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-50">
                                <label>Bề Mặt</label>
                                <select name="be_mat" class="selectpicker form-control" data-style="py-0"
                                    data-live-search="true">
                                    <option value="">Chọn Bề Mặt</option>
                                    @foreach ($be_mat_datas as $data)
                                        <option value="{{ $data->id }}">{{ $data->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex flex-col">
                            <div class="w-50 pr-1">
                                <label>Phần</label>
                                <select name="phan" class="selectpicker form-control" data-style="py-0"
                                    data-live-search="true">
                                    <option value="">Chọn Phần</option>
                                    @foreach ($phan_datas as $data)
                                        <option value="{{ $data->id }}">{{ $data->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-50">
                                <label>Loại Khẩu Độ</label>
                                <select name="khau_do" class="selectpicker form-control" data-style="py-0"
                                    data-live-search="true">
                                    <option value="">Chọn Khẩu Độ</option>
                                    @foreach ($khau_do_datas as $data)
                                        <option value="{{ $data->id }}">{{ $data->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tên Model Train</label>
                            <select name="model" class="selectpicker form-control" data-style="py-0"
                                data-live-search="true">
                                <option value="">Chọn Model</option>
                                @foreach ($model_datas as $data)
                                    <option value="{{ $data->id }}">{{ $data->ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group d-flex flex-col">
                            <div class="w-50 pr-1">
                                <label>Tên</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="w-50">
                                <label>Tên Khoa Học</label>
                                <input type="text" class="form-control" name="ten_kh" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kích thước</label>
                            <input type="text" class="form-control" name="kich_thuoc" required>
                        </div>
                        <div class="form-group">
                            <label>Đặc điểm</label>
                            <input type="text" class="form-control" name="dac_diem" required>
                        </div>
                        <div class="form-group d-flex flex-col">
                            <div class="w-50 pr-1">
                                <label>Ảnh Loài Hoa</label>
                                <input type="file" class="form-control image-file" name="anh_hoa" accept="image/*" />
                            </div>
                            <div class="w-50">
                                <label>Các ảnh phấn hoa</label>
                                <input type="file" class="form-control image-file" name="anh_phan_hoa[]"
                                    accept="image/*" multiple />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-info" value="Thêm Mới">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal HTML -->
    <div id="editModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" action="{{ route('SuaHoa') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Cập nhật loài hoa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group d-flex flex-col">
                            <div class="w-50 pr-1">
                                <label>Chi</label>
                                <select name="chi" class="selectpicker form-control" data-style="py-0"
                                    data-live-search="true">
                                    <option value="">Chọn Chi</option>
                                    @foreach ($chi_datas as $data)
                                        <option value="{{ $data->id }}">{{ $data->ten }} ({{ $data->ho->ten }})
                                            ({{ $data->ho->bo->ten }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-50">
                                <label>Bề Mặt</label>
                                <select name="be_mat" class="selectpicker form-control" data-style="py-0"
                                    data-live-search="true">
                                    <option value="">Chọn Bề Mặt</option>
                                    @foreach ($be_mat_datas as $data)
                                        <option value="{{ $data->id }}">{{ $data->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group d-flex flex-col">
                            <div class="w-50 pr-1">
                                <label>Phần</label>
                                <select name="phan" class="selectpicker form-control" data-style="py-0"
                                    data-live-search="true">
                                    <option value="">Chọn Phần</option>
                                    @foreach ($phan_datas as $data)
                                        <option value="{{ $data->id }}">{{ $data->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-50">
                                <label>Loại Khẩu Độ</label>
                                <select name="khau_do" class="selectpicker form-control" data-style="py-0"
                                    data-live-search="true">
                                    <option value="">Chọn Khẩu Độ</option>
                                    @foreach ($khau_do_datas as $data)
                                        <option value="{{ $data->id }}">{{ $data->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tên Model Train</label>
                            <select name="model" class="selectpicker form-control" data-style="py-0"
                                data-live-search="true">
                                <option value="">Chọn Model</option>
                                @foreach ($model_datas as $data)
                                    <option value="{{ $data->id }}">{{ $data->ten }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group d-flex flex-col">
                            <div class="w-50 pr-1">
                                <label>Tên</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="w-50">
                                <label>Tên Khoa Học</label>
                                <input type="text" class="form-control" name="ten_kh" required>
                                <input type="hidden" name="id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kích thước</label>
                            <input type="text" class="form-control" name="kich_thuoc" required>
                        </div>
                        <div class="form-group">
                            <label>Đặc điểm</label>
                            <input type="text" class="form-control" name="dac_diem" required>
                        </div>
                        <div class="form-group d-flex flex-col">
                            <div class="w-50 pr-1">
                                <label>Ảnh Loài Hoa</label>
                                <input type="file" class="form-control image-file" name="anh_hoa" accept="image/*" />
                            </div>
                            <div class="w-50">
                                <label>Các ảnh phấn hoa</label>
                                <input type="file" class="form-control image-file" name="anh_phan_hoa[]"
                                    accept="image/*" multiple />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-info" value="Cập Nhật">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal HTML -->
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" action="{{ route('XoaHoa') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Xóa Loài Hoa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa loài hoa này?</p>
                        <input type="hidden" name="id" id="delete-id">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-danger" value="Xóa">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            // Populate edit modal fields with existing data
            $('#viewModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var ten = button.data('ten');
                var ten_kh = button.data('ten_kh');
                var kich_thuoc = button.data('kich_thuoc');
                var dac_diem = button.data('dac_diem');
                var be_mat = button.data('be_mat');
                var chi = button.data('chi');
                var phan = button.data('phan');
                var khau_do = button.data('khau_do');
                var model = button.data('model');
                var anh_hoa = button.data('anh_hoa');
                var anh_phan_hoa = button.data('anh_phan_hoa');
                $('#viewModal #ten').text(ten);
                $('#viewModal #ten_kh').text(ten_kh);
                $('#viewModal #kich_thuoc').text(kich_thuoc);
                $('#viewModal #dac_diem').text(dac_diem);
                $('#viewModal #be_mat').text(be_mat);
                $('#viewModal #chi').text(chi);
                $('#viewModal #phan').text(phan);
                $('#viewModal #khau_do').text(khau_do);
                $('#viewModal #model').text(model);
                $('#viewModal #anh_hoa').attr('src', anh_hoa);
                var anh_phan_hoa = button.data('anh_phan_hoa'); // Danh sách ảnh phấn hoa (chuỗi hoặc mảng)

                // Gán thông tin vào modal
                $('#viewModal #ten').text(ten);
                $('#viewModal #ten_kh').text(ten_kh);
                $('#viewModal #kich_thuoc').text(kich_thuoc);
                $('#viewModal #dac_diem').text(dac_diem);
                $('#viewModal #be_mat').text(be_mat);
                $('#viewModal #chi').text(chi);
                $('#viewModal #phan').text(phan);
                $('#viewModal #khau_do').text(khau_do);
                $('#viewModal #model').text(model);
                $('#viewModal #anh_hoa').attr('src', anh_hoa);

                // Xử lý danh sách ảnh phấn hoa
                var listContainer = $('#viewModal #list-anh-phan-hoa');
                listContainer.empty(); // Xóa các ảnh cũ

                // Nếu anh_phan_hoa là chuỗi, tách nó thành mảng
                if (typeof anh_phan_hoa === 'string') {
                    anh_phan_hoa = anh_phan_hoa.split(','); // Giả sử ngăn cách bởi dấu phẩy
                }

                // Thêm từng ảnh vào container
                anh_phan_hoa.forEach(function(imageUrl) {
                    const img = $('<img>')
                        .attr('src', imageUrl.trim())
                        .attr('alt', 'Ảnh phấn hoa')
                        .addClass('img-thumbnail')
                        .css({
                            width: '100px',
                            height: '100px',
                            marginRight: '2px',
                            marginBottom: '2px'
                        });

                    listContainer.append(img);
                });

                $('#viewModal').modal('show');
            });
            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var ten = button.data('ten');
                var ten_kh = button.data('ten_kh');
                var kich_thuoc = button.data('kich_thuoc');
                var dac_diem = button.data('dac_diem');
                var be_mat = button.data('be_mat');
                var chi = button.data('chi');
                var phan = button.data('phan');
                var khau_do = button.data('khau_do');
                var model = button.data('model');

                var modal = $(this);
                modal.find('input[name="id"]').val(id);
                modal.find('input[name="name"]').val(ten);
                modal.find('input[name="ten_kh"]').val(ten_kh);
                modal.find('input[name="kich_thuoc"]').val(kich_thuoc);
                modal.find('input[name="dac_diem"]').val(dac_diem);

                modal.find('select[name="chi"]').val(chi).change();
                modal.find('select[name="be_mat"]').val(be_mat).change();
                modal.find('select[name="phan"]').val(phan).change();
                modal.find('select[name="khau_do"]').val(khau_do).change();
                modal.find('select[name="model"]').val(model).change();
            });


            // Populate delete modal with id
            $('.delete').click(function() {
                var id = $(this).data('id');
                console.log(id)
                $('#delete-id').val(id);
            });
        });
    </script>

    <!-- Hiển thị phân trang -->
    @if ($datas->lastPage() > 1)
        <nav class="d-flex justify-content-center">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($datas->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $datas->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- Numbered Page Links --}}
                @php
                    $currentPage = $datas->currentPage();
                    $lastPage = $datas->lastPage();
                    $maxPages = 5; // Số lượng trang tối đa hiển thị
                    $halfMaxPages = floor($maxPages / 2);
                    $startPage = max($currentPage - $halfMaxPages, 1);
                    $endPage = min($currentPage + $halfMaxPages, $lastPage);
                @endphp

                @if ($startPage > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $datas->url(1) }}">1</a>
                    </li>
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                @endif

                @for ($i = $startPage; $i <= $endPage; $i++)
                    <li class="page-item {{ $datas->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $datas->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                @if ($endPage < $lastPage)
                    <li class="page-item disabled">
                        <span class="page-link">...</span>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="{{ $datas->url($lastPage) }}">{{ $lastPage }}</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($datas->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $datas->nextPageUrl() }}" rel="next">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
@endsection
