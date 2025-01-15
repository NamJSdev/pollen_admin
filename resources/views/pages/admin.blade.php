@extends('layouts.app')
@section('title', 'Tài Khoản Quản Trị')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Tài Khoản Quản Trị Viên</h4>
                    </div>
                    <a href="" class="btn btn-primary add-list" data-toggle="modal" data-target="#createModal"><i
                        class="las la-plus"></i>Tạo Tài Khoản</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="data-table table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Quyền</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @foreach ($datas as $data)
                                <tr data-id="{{ $data->id }}">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $data->info->ten }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->role->ten }}</td>
                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge bg-success mr-2 edit" href="#" title="Edit"
                                                data-toggle="modal" data-target="#editModal" data-id="{{ $data->id }}"
                                                data-name="{{ $data->info->ten }}" data-email="{{ $data->email }}"
                                                data-desc="{{ $data->info->moTa }}"><i class="ri-pencil-line mr-0"></i></a>
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
    </div>

    <!-- Create Modal HTML -->
    <div id="createModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createForm" action="{{ route('CreateAccount') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm Tài Khoản Quản Trị</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tên Tài Khoản</label>
                            <input type="text" class="form-control" name="ten" required>
                            <input type="hidden" name="role" value="2">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="example@gmail.com">
                        </div>
                        <div class="form-group">
                            <label>Mật Khẩu</label>
                            <input type="text" class="form-control" name="matKhau">
                        </div>
                        <div class="form-group">
                            <label>Mô Tả</label>
                            <input type="text" class="form-control" name="moTa">
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
                <form id="editForm" action="{{ route('UpdateAccount') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Chỉnh Sửa Tài Khoản</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="hidden" name="id">
                            <input type="text" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Tên Người Dùng</label>
                            <input type="text" class="form-control" name="ten" required>
                        </div>
                        <div class="form-group">
                            <label>Mô Tả</label>
                            <input type="text" class="form-control" name="moTa">
                        </div>
                        <div class="form-group">
                            <label>Mật Khẩu Mới</label>
                            <input type="text" class="form-control" name="mauKhau">
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
                <form id="deleteForm" action="{{ route('DeleteAccount') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Xóa Tài Khoản</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa tài khoản này?</p>
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
                var email = button.data('email');
                var desc = button.data('desc');
                var modal = $(this);
                modal.find('input[name="id"]').val(id);
                modal.find('input[name="ten"]').val(name);
                modal.find('input[name="email"]').val(email);
                modal.find('input[name="moTa"]').val(desc);
            });

            // Populate delete modal with id
            $('.delete').click(function() {
                var id = $(this).data('id');
                console.log(id)
                $('#delete-id').val(id);
            });
        });
    </script>
@endsection
