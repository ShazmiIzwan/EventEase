<?php
$page = 'users';
?>
@include('Navigation-Admin.app')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

<style>
.btn:hover {
    color: white !important;
}
#myTable_wrapper {
    padding: 20px !important;
}
</style>

<div class="wrapper wrapper-body">
    <div class="dashboard-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-main-title">
                        <h3><i class="fa-solid fa-users me-3"></i>User Management</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="conversion-setup">
                        <div class="main-card mt-5">
                            <div class="dashboard-wrap-content p-4">
                                <div class="d-md-flex flex-wrap align-items-center">
                                    <div class="rs ms-auto mt_r4">
                                        <button class="main-btn btn-hover h_40 w-100 create"
                                                data-bs-toggle="modal"
                                                data-bs-target="#userModal">
                                            Add New User
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <strong>Whoops !</strong> {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            <strong>Success !</strong> {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="overview-tab" role="tabpanel">
                                <div class="table-card mt-4">
                                    <div class="main-table">
                                        <div class="table-responsive">
                                            <table class="table" id="myTable">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Phone</th>
                                                        <th scope="col">Role</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Created At</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($users as $key => $user)
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>{{ $user->role }}</td>
                                                        <td>{{ $user->status }}</td>
                                                        <td>{{ $user->created_at }}</td>
                                                        <td>
                                                            <a class="view" data-id="{{ $user->id }}"
                                                               data-bs-toggle="modal"
                                                               data-bs-target="#userModal">
                                                                <span class="action-btn">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </span>
                                                            </a>
                                                            <a class="edit" data-id="{{ $user->id }}"
                                                               data-bs-toggle="modal"
                                                               data-bs-target="#userModal">
                                                                <span class="action-btn">
                                                                    <i class="fa-solid fa-pencil"></i>
                                                                </span>
                                                            </a>
                                                            <a href="{{ url('removeUser/'.$user->id) }}">
                                                                <span class="action-btn">
                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                </span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>                                    
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Create/Edit/View User Modal -->
                        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel"
                             aria-hidden="true" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="userModalLabel">Create User</h5>
                                    </div>
                                    <form action="{{ url('postUser') }}" method="POST">
                                        @csrf
                                        <input type="hidden" id="id" name="id">
                                        <input type="hidden" id="type" name="type">
                                        <div class="modal-body">
                                            <div class="model-content main-form">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group mt-4">
                                                            <label class="form-label">Name*</label>
                                                            <input class="form-control h_40" type="text"
                                                                   name="name" id="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group mt-4">
                                                            <label class="form-label">Email*</label>
                                                            <input class="form-control h_40" type="email"
                                                                   name="email" id="email" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group mt-4">
                                                            <label class="form-label">Phone</label>
                                                            <input class="form-control h_40" type="text"
                                                                   name="phone" id="phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group mt-4">
                                                            <label class="form-label">Role*</label>
                                                            <select class="form-control" name="role" id="role" required>
                                                                <option value="" selected disabled>-- Select Role --</option>
                                                                <option value="Admin">Admin</option>
                                                                <option value="Committee">Committee</option>
                                                                <option value="Student">Student</option>
                                                                <option value="Lecturer">Lecturer</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group mt-4">
                                                            <label class="form-label">Status*</label>
                                                            <select class="form-control" name="status" id="status" required>
                                                                <option value="A">Active</option>
                                                                <option value="I">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 password-field">
                                                        <div class="form-group mt-4">
                                                            <label class="form-label">Password*</label>
                                                            <input class="form-control h_40" type="password"
                                                                   name="password" id="password">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 password-field">
                                                        <div class="form-group mt-4">
                                                            <label class="form-label">Confirm Password*</label>
                                                            <input class="form-control h_40" type="password"
                                                                   name="password_confirmation" id="password_confirmation">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="co-main-btn min-width btn-hover h_40"
                                                    data-bs-dismiss="modal">Cancel
                                            </button>
                                            <button type="submit" id="submibtn"
                                                    class="main-btn min-width btn-hover h_40">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Body End -->

<script src="js/vertical-responsive-menu.min.js"></script>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/OwlCarousel/owl.carousel.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/night-mode.js"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script>
$(document).ready(function() {
    $('#myTable').DataTable();

    // Create
    $('.create').click(function() {
        $('#id, #name, #email, #phone').val('').prop('disabled', false);
        $('#role, #status').val('A').prop('disabled', false);
        $('#password, #password_confirmation').val('').prop('required', true).show();
        $('#type').val('C');
        $('.modal-title').text('Create User');
        $('#submibtn').text('Submit').show();
    });

    // Fetch & Populate
    function fetchUser(id, mode) {
        $.get('{{ url("fetchUser") }}', { id }, function(u) {
            $('#id').val(u.id);
            $('#name').val(u.name);
            $('#email').val(u.email);
            $('#phone').val(u.phone);
            $('#role').val(u.role);
            $('#status').val(u.status);

            if (mode === 'V') {
                $('#name,#email,#phone,#role,#status').prop('disabled', true);
                $('#password, #password_confirmation').hide().prop('required', false);
                $('#submibtn').hide();
                $('.modal-title').text('View User');
            } else {
                $('#name,#email,#phone,#role,#status').prop('disabled', false);
                $('#password, #password_confirmation').show().prop('required', false).val('');
                $('#submibtn').text('Update').show();
                $('.modal-title').text('Edit User');
            }
            $('#type').val(mode === 'E' ? 'E' : 'V');
        });
    }

    $('.edit').click(function() {
        fetchUser($(this).data('id'), 'E');
    });
    $('.view').click(function() {
        fetchUser($(this).data('id'), 'V');
    });
});
</script>
