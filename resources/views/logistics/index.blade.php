<?php
$page = 'logistics';
?>
@if(auth()->user()->role == 'Admin')
@include('Navigation-Admin.app')
@else
@include('Navigation-Org.app')
@endif
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
                        <h3><i class="fa-solid fa-truck me-3"></i>Logistic Management</h3>
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
                                                data-bs-target="#logisticModal">
                                            Add New Logistic
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Whoops !</strong> {{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                                                        <th scope="col">Event</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Quantity</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Last Updated</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($logistics as $key => $log)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $log->event->event_name }}</td>
                                                        <td>{{ $log->name }}</td>
                                                        <td>{{ $log->quantity }}</td>
                                                        <td>{{ $log->status }}</td>
                                                        <td>{{ $log->updated_at }}</td>
                                                        <td>
                                                            <a class="view" data-id="{{ $log->logistic_id }}" 
                                                               data-bs-toggle="modal" 
                                                               data-bs-target="#logisticModal">
                                                                <span class="action-btn">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </span>
                                                            </a>
                                                            <a class="edit" data-id="{{ $log->logistic_id }}" 
                                                               data-bs-toggle="modal" 
                                                               data-bs-target="#logisticModal">
                                                                <span class="action-btn">
                                                                    <i class="fa-solid fa-pencil"></i>
                                                                </span>
                                                            </a>
                                                            <a href="{{ url('removeLogistic/'.$log->logistic_id) }}">
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

                            <!-- Create/Edit/View Logistic Modal -->
                            <div class="modal fade" id="logisticModal" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form action="{{ url('postLogistic') }}" method="POST">
                                            @csrf
                                            <input type="hidden" id="id" name="id">
                                            <input type="hidden" id="type" name="type">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="logisticModalLabel">Create Logistic</h5>
                                            </div>

                                            <div class="modal-body">
                                                <div class="model-content main-form">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group mt-4">
                                                                <label class="form-label">Event*</label>
                                                                <select class="form-control" name="event_id" id="event_id" required>
                                                                    <option value="" selected disabled>-- Select Event --</option>
                                                                    @foreach($events as $ev)
                                                                    <option value="{{ $ev->event_id }}">{{ $ev->event_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group mt-4">
                                                                <label class="form-label">Name*</label>
                                                                <input class="form-control h_40" type="text" name="name" id="name" placeholder="Logistic Name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group mt-4">
                                                                <label class="form-label">Quantity*</label>
                                                                <input class="form-control h_40" type="number" name="quantity" id="quantity" min="1" value="1" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group mt-4">
                                                                <label class="form-label">Status*</label>
                                                                <select class="form-control" name="status" id="status" required>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="In Progress">In Progress</option>
                                                                    <option value="Completed">Completed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="co-main-btn min-width btn-hover h_40" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" id="submibtn" class="main-btn min-width btn-hover h_40">Submit</button>
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
    </div><!-- /.wrapper-body -->
</div><!-- /.wrapper -->

<script src="js/vertical-responsive-menu.min.js"></script>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/OwlCarousel/owl.carousel.js"></script>
<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>  
<script src="js/custom.js"></script>
<script src="js/night-mode.js"></script>

<script>
    $(".create").click(function(){
        $('#id').val('');
        $('#event_id, #name, #quantity, #status').val('').prop('disabled', false);
        $('#submibtn').text('Submit').show();
        $('#type').val('C');
        $('.modal-title').text('Create Logistic');
    });

    $(".edit").click(function(){
        var id = $(this).data('id');
        $('#id').val(id);

        $.ajax({
            url: '/fetchLogistic',
            type: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(data) {
                $('#event_id').val(data.event_id).prop('disabled', false);
                $('#name').val(data.name).prop('disabled', false);
                $('#quantity').val(data.quantity).prop('disabled', false);
                $('#status').val(data.status).prop('disabled', false);

                $('#submibtn').text('Update').show();
                $('#type').val('E');
                $('.modal-title').text('Update Logistic Details');
            },
            error: function() {
                alert('Error fetching logistic details.');
            }
        });
    });

    $(".view").click(function(){
        var id = $(this).data('id');
        $('#id').val(id);

        $.ajax({
            url: '/fetchLogistic',
            type: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(data) {
                $('#event_id').val(data.event_id).prop('disabled', true);
                $('#name').val(data.name).prop('disabled', true);
                $('#quantity').val(data.quantity).prop('disabled', true);
                $('#status').val(data.status).prop('disabled', true);

                $('#submibtn').hide();
                $('#type').val('V');
                $('.modal-title').text('View Logistic Details');
            },
            error: function() {
                alert('Error fetching logistic details.');
            }
        });
    });
</script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
