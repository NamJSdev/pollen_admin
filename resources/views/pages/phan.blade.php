@extends('layouts.app')
@section('title', 'Danh sách cấu hình phần')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Danh Sách Cấu Hình Phần</h4>
                    </div>
                    <div class="iq-search-bar device-search w-50 d-flex flex-wrap justify-content-end">
                        <form id="searchForm" action="{{route('Phan')}}" method="GET"
                            class="searchbox d-flex">
                            <div>
                                <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                                <input type="text" id="searchInput"
                                    style="border-top-right-radius: 0%;border-bottom-right-radius: 0%;"
                                    class="text search-input" placeholder="Tìm kiếm theo tên phần..." name="search"
                                    value="" />
                            </div>
                            <button type="submit" class="btn btn-info float-left"
                                style="border-top-left-radius: 0%;border-bottom-left-radius: 0%;">Tìm
                                Kiếm</button>
                        </form>
                        <a href="" class="btn btn-primary add-list" data-toggle="modal" data-target="#createModal"><i
                                class="las la-plus"></i>Thêm Mới Phần</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="data-table table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Mô Tả</th>
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
                                    <td>{{ $data->ten }}</td>
                                    <td>{{ $data->moTa }}</td>
                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge bg-success mr-2 edit" href="#" title="Edit"
                                                data-toggle="modal" data-target="#editModal"
                                                data-id="{{ $data->id }}" data-name="{{$data->ten}}" data-desc="{{$data->moTa}}"><i class="ri-pencil-line mr-0"></i></a>
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
    <!-- Create Modal HTML -->
    <div id="createModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createForm" action="{{ route('ThemPhan') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm Phần</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Mô Tả</label>
                            <input type="text" class="form-control" name="desc">
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
                <form id="editForm" action="{{ route('SuaPhan') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Chỉnh Sửa Thông Tin</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tên</label>
                            <input type="hidden" name="id">
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Mô Tả</label>
                            <input type="text" class="form-control" name="desc">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-info" value="Lưu">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" action="{{ route('XoaPhan') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Xóa Phần</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa phần này?</p>
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
            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var desc = button.data('desc');
                var modal = $(this);
                modal.find('input[name="id"]').val(id);
                modal.find('input[name="name"]').val(name);
                modal.find('input[name="desc"]').val(desc);
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
