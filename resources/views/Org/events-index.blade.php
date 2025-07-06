<?php
$page = 'events';
?>
@include('Navigation-Org.app')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

<style>
.btn:hover {
color: white !important;
}

#myTable_wrapper{
	padding: 20px !important;
}
</style>

<div class="wrapper wrapper-body">
		<div class="dashboard-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="d-main-title">
							<h3><i class="fa-solid fa-map-marker me-3"></i>Event Management</h3>
						</div>
					</div>
					<div class="col-md-12">
						<div class="conversion-setup">
							<div class="main-card mt-5">
								<div class="dashboard-wrap-content p-4">
									<div class="d-md-flex flex-wrap align-items-center">
										
										<div class="rs ms-auto mt_r4">
											<button class="main-btn btn-hover h_40 w-100 create" data-bs-toggle="modal" data-bs-target="#singleTicketModal">Add New Event</button>
										</div>
									</div>
								</div>
							</div>
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
															<th scope="col">#</th>
															<th scope="col">Event</th>
															<th scope="col">Category</th>
                                                            <th scope="col">Event Date & Time</th>
                                                            <th scope="col">Total Registration</th>
															<th scope="col">Last Updated</th>
															<th scope="col">Action</th>
														</tr>
													</thead>
													<tbody>
                                                        @foreach($events as $key => $event)
														<?php
														$totalregistration = DB::table('registrations')
														->where('event_id',$event->event_id)
														->count();
														?>
														<tr>										
															<td>{{ ++$key }}</td>	
															<td>{{ $event->event_name }}</td>	
															<td>{{ $event->getcategory->category }}</td>	
                                                            <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }} {{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}</td>
                                                            <td>{{ $totalregistration }}</td>	
															<td>{{ $event->updated_at }}</td>	
															<td>
                                                                <a class="view" data-id="{{ $event->event_id }}" data-bs-toggle="modal" data-bs-target="#singleTicketModal"><span class="action-btn"><i class="fa-solid fa-eye"></i></span></a>
                                                                <a class="edit" data-id="{{ $event->event_id }}" data-bs-toggle="modal" data-bs-target="#singleTicketModal"><span class="action-btn"><i class="fa-solid fa-pencil"></i></span></a>
                                                                <a href="removeEvent/{{ $event->event_id }}"><span class="action-btn"><i class="fa-solid fa-trash-can"></i></span></a>
                                                        	</td>	
														</tr>
                                                        @endforeach
														
													</tbody>									
												</table>
											</div>
										</div>
									</div>
								</div>
							<!-- Create Single Ticket Model Start-->
	<div class="modal fade" id="singleTicketModal" tabindex="-1" aria-labelledby="singleTicketModalLabel" aria-hidden="false" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="singleTicketModalLabel">Create Single Ticket</h5>
				</div>
            <form action="postEvent" method="POST" enctype="multipart/form-data">
			@csrf
			<input type="text" id="id" name="id" hidden>
			<input type="text" id="type" name="type" hidden>
				<div class="modal-body">
					<div class="model-content main-form">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group mt-4">
									<label class="form-label">Event Name*</label>
									<input class="form-control h_40" type="text" name="event_name" id="event_name" placeholder="Event Name" required>																								
								</div>
							</div>
                            <div class="col-lg-6 col-md-12">
								<div class="form-group mt-4">
									<label class="form-label">Event Date*</label>
									<input class="form-control h_40" type="date" name="event_date" id="event_date" required>																								
								</div>
							</div>
                            <div class="col-lg-6 col-md-12">
								<div class="form-group mt-4">
									<label class="form-label">Event Time*</label>
									<input class="form-control h_40" type="time" name="event_time" id="event_time" required>																								
								</div>
							</div>
                            <div class="col-lg-6 col-md-12">
								<div class="form-group mt-4">
									<label class="form-label">Event Duration (Hours)*</label>
									<input class="form-control h_40" type="number" min="1" step=".01" name="event_duration_hours" id="event_duration_hours" required>																								
								</div>
							</div>
							<div class="col-lg-6 col-md-12">
								<div class="form-group mt-4">
									<label class="form-label">Event Category *</label>
                                    <select class="form-control" name="category" id="category" required>
                                        <option value="" selected disabled>-- Select Category --</option>
                                        @foreach($category as $category)
                                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                                        @endforeach
                                    </select>
																											
								</div>
							</div>
                            <div class="col-lg-6 col-md-12">
								<div class="form-group mt-4">
									<label class="form-label">Event Image*</label>
									<input class="form-control h_40" type="file" name="event_image" id="event_image" accept="image/png, image/gif, image/jpeg" required>			
                                    <br>
            
            <img id="uploadedimgview" width="300" height="200" style=" border: 5px solid #555;  object-fit: contain;">																					
								</div>
							</div>
                          
                            
						
							<div class="col-lg-12 col-md-12">
									<div class="form-group mt-4">
										<label class="form-label mb-2 fs-14">Event Description*</label>
										<textarea class="form-textarea" name="event_description" id="event_description" maxlength="1000" placeholder="Description will go here" required></textarea>
									</div>
							</div>
						
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="co-main-btn min-width btn-hover h_40" data-bs-target="#aboutModal" data-bs-toggle="modal" data-bs-dismiss="modal">Cancel</button>
					<button type="submit" id="submibtn" class="main-btn min-width btn-hover h_40">Submit</button>
				</div>
                </form>
			</div>
		</div>
	</div>
	<!-- Create Single Ticket Model End-->
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
       




        $(".create").click(function(){

        $('#event_name').val('').prop('disabled',false);
        $('#event_date').val('').prop('disabled',false);
        $('#event_venue').val('').prop('disabled',false);
		$('#category').val('').prop('disabled',false);
        $('#event_time').val('').prop('disabled',false);
        $('#event_duration_hours').val('').prop('disabled',false);
        $('#event_description').val('').prop('disabled',false);
        $('#submibtn').html('Submit');
        $('#submibtn').show();
        $("#uploadedimgview").hide();

        $('#event_image').show().val('').prop('required',true);

        $('#type').val('C');

        $('.modal-title').html('Create New Event');

        });




        $(".edit").click(function(){
    var id = $(this).data('id');

    $('#id').val(id);

    $.ajax({
        url: '/fetchEvent',
        type: 'GET',
        data: { id: id },
        dataType: 'json',
        success: function(data) {


        // Populate input fields with the retrieved data
        $('#event_name').val(data.event_name).prop('disabled',false);
        $('#event_date').val(data.event_date).prop('disabled',false);
        $('#event_venue').val(data.event_venue).prop('disabled',false);
        $('#category').val(data.category).prop('disabled',false);
		
        
        $('#event_time').val(data.event_time).prop('disabled',false);
        $('#event_duration_hours').val(data.event_duration_hours).prop('disabled',false);;
        $('#event_description').val(data.event_description).prop('disabled',false);


        $('#event_image').show().val('').prop('required',false);

        $("#uploadedimgview").show();
        $("#uploadedimgview").attr('src', 'EventImage/' + data.event_image);

        $('#submibtn').html('Update');
        $('#submibtn').show();
        $('#type').val('E');
        $('.modal-title').html('Update Event Details');

        },
        error: function() {
            alert('Error fetching Event details.');
        }
    });
	
  });


  $(".view").click(function(){
    var id = $(this).data('id');

    $('#id').val(id);

    $.ajax({
        url: '/fetchEvent',
        type: 'GET',
        data: { id: id },
        dataType: 'json',
        success: function(data) {


        // Populate input fields with the retrieved data
        $('#event_name').val(data.event_name).prop('disabled',true);
        $('#event_date').val(data.event_date).prop('disabled',true);
        $('#event_venue').val(data.event_venue).prop('disabled',true);
        
		$('#category').val(data.category).prop('disabled',true);
		

        $('#event_time').val(data.event_time).prop('disabled',true);
        $('#event_duration_hours').val(data.event_duration_hours).prop('disabled',true);
        $('#event_description').val(data.event_description).prop('disabled',true);



        $('#event_image').show().val('').prop('required',false);

        $("#uploadedimgview").show();
        $("#uploadedimgview").attr('src', 'EventImage/' + data.event_image);

        $('#submibtn').html('Update');
        $('#submibtn').hide();
        $('#type').val('V');
        $('.modal-title').html('View Event Details');

        },
        error: function() {
            alert('Error fetching Venue details.');
        }
    });
	
  });
    </script>
	<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

<script>
	$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>