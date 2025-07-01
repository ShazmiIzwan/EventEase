<?php
$page = 'registrations';
?>
@if(auth()->user()->role == 'Admin')
@include('Navigation-Admin.app')
@else
@include('Navigation-Org.app')
@endif
<!-- Body Start -->
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
					<h3><i class="fa-solid fa-ticket me-3"></i>Registration Management</h3>
				</div>
			</div>
			<div class="col-md-12">
				<div class="conversion-setup">

					@if($message = Session::get('error'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Whoops !</strong> {{ session()->get('error') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					@endif

					@if($message = Session::get('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>Yay !</strong> {{ session()->get('success') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
												<th scope="col">No</th>
													<th scope="col">Event</th>
													<th scope="col">Student</th>
													<th scope="col">Registration Date</th>
													<th scope="col">Status</th>
													@if(auth()->user()->role == 'Admin')
													<th scope="col">Certificate</th>
													@endif
													<th scope="col">Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach($registrations as $key => $reg)
												<tr>
												<td>{{ ++$key }}<br>
													<td>{{ $reg->events->event_name }}<br>
														<b style="color:blue;">{{ $reg->events->getcategory->category }}</b><br>
														{{ \Carbon\Carbon::parse($reg->events->event_date . ' ' . $reg->events->event_time)->format('d M Y, h.i A') }}<br>
													</td>
													<td>{{ $reg->student?->name }}</td>
													<td>{{ $reg->created_at }}</td>
													<td>{{ $reg->status }}</td>

													@if(auth()->user()->role == 'Admin')
													@if($reg->certificate == 'N')
													<td>Not Generated</td>
													@else
													<td>Generated at <p style="color:blue;">{{$reg->certificate_issued_at}}</p></td>
													@endif
													@endif

													<td>
														<a class="view"
															data-event="{{ $reg->events->event_name }}"
															data-id="{{ $reg->registrations_id }}" data-bs-toggle="modal" data-bs-target="#inviteTeamModal"><span class="action-btn"><i class="fa-solid fa-eye"></i></span></a>

															@if(auth()->user()->role == 'Admin' && $reg->certificate == 'N')
															<a class="view" href="generateCert/{{ $reg->registrations_id }}"><span class="action-btn"><i class="fa-solid fa-refresh" onclick="return confirm('Are you sure you want to generate certificate?');"></i></span></a>
															@endif
													</td>
												</tr>
												@endforeach

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- Venue Model Start-->
						<div class="modal fade" id="inviteTeamModal" tabindex="-1" aria-labelledby="inviteTeamModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="inviteTeamModalLabel"></h5>
										<button type="button" class="close-model-btn" data-bs-dismiss="modal" aria-label="Close"><i class="uil uil-multiply"></i></button>
									</div>
									<form action="#" method="POST" enctype="multipart/form-data">
										@csrf
										<div class="modal-body">

											<div class="model-content main-form">
												<div class="row">
													<div class="col-lg-8 col-md-12">
														<div class="form-group mt-4">
															<label class="form-label">Event*</label>
															<input class="form-control h_50" type="text" name="event_name" id="event_name" disabled>
														</div>
													</div>
												</div>
												<div class="row">

													<div class="col-lg-6 col-md-12">
														<div class="form-group mt-4">
															<label class="form-label">First Name*</label>
															<input class="form-control h_50" type="text" name="first_name" id="first_name" disabled>
														</div>
													</div>
													<div class="col-lg-6 col-md-12">
														<div class="form-group mt-4">
															<label class="form-label">Last Name*</label>
															<input class="form-control h_50" type="text" name="last_name" id="last_name" disabled>
														</div>
													</div>
													<div class="col-lg-6 col-md-12">
														<div class="form-group mt-4">
															<label class="form-label">Email*</label>
															<input class="form-control h_50" type="email" name="email" id="email" disabled>
														</div>
													</div>
													<div class="col-lg-6 col-md-12">
														<div class="form-group mt-4">
															<label class="form-label">Phone Number*</label>
															<input class="form-control h_50" type="number" name="phone" id="phone" disabled>
														</div>
													</div>
													<div class="col-lg-12 col-md-12">
														<div class="form-group mt-4">
															<label class="form-label">Address*</label>
															<textarea class="form-control h_50" name="address" id="address" maxlength="255" style="height:100px;" disabled></textarea>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="co-main-btn min-width btn-hover h_40" data-bs-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<!-- Venue Model End-->
					</div>
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

</body>

</html>


<script>
$(".view").click(function() {
	var id = $(this).data('id');
	var event = $(this).data('event');

	$.ajax({
		url: '/fetchReg',
		type: 'GET',
		data: {
			id: id
		},
		dataType: 'json',
		success: function(data) {
			$('#event_name').val(event);
			$('#first_name').val(data.first_name).prop('disabled', true);
			$('#last_name').val(data.last_name).prop('disabled', true);
			$('#email').val(data.email).prop('disabled', true);
			$('#phone').val(data.phone).prop('disabled', true);
			$('#address').val(data.address).prop('disabled', true);
			$('.modal-title').html('View Registration Details');

		},
		error: function() {
			alert('Error fetching Registration details.');
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