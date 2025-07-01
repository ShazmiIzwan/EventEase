<?php
$page = 'events';
?>
@include('Navigation-Student.app')
<form action="/confirmregister" method="POST">
                        @csrf
	<!-- Body Start-->
	<div class="wrapper">
		<div class="breadcrumb-block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-10">
						<div class="barren-breadcrumb">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="/student-home">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Registration Details</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="event-dt-block p-80">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="main-title checkout-title">
							<h3>Registration Confirmation</h3>
						</div>
					</div>
                   
                 
					<div class="col-xl-8 col-lg-12 col-md-12">
						<div class="checkout-block">
							<div class="main-card">
								<div class="bp-title">
									<h4>Student Information</h4>
								</div>
								<div class="bp-content bp-form">
									<div class="row">
										<div class="col-lg-6 col-md-12">
											<div class="form-group mt-4">
												<label class="form-label">First Name*</label>
												<input class="form-control h_50" type="text" name="first_name" value="{{ auth()->user()->name }}" required>																								
											</div>
										</div>
										<div class="col-lg-6 col-md-12">
											<div class="form-group mt-4">
												<label class="form-label">Last Name*</label>
												<input class="form-control h_50" type="text" name="last_name" required>																								
											</div>
										</div>
										<div class="col-lg-6 col-md-12">
											<div class="form-group mt-4">
												<label class="form-label">Email*</label>
												<input class="form-control h_50" type="email" name="email" value="{{ auth()->user()->email }}" readonly>																								
											</div>
										</div>
                                        <div class="col-lg-6 col-md-12">
											<div class="form-group mt-4">
												<label class="form-label">Phone Number*</label>
												<input class="form-control h_50" type="number" name="phone" value="{{ auth()->user()->phone }}"  required>																								
											</div>
										</div>
										<div class="col-lg-6 col-md-12">
											<div class="form-group mt-4">
												<label class="form-label">Address*</label>
                                                <textarea class="form-control h_50" name="address" maxlength="255" style="height:100px; line-height: 3;" required></textarea>																							
											</div>
										</div>
										
									</div>
								</div>
							</div>
							
						</div>
					</div>
					
					<div class="col-xl-4 col-lg-12 col-md-12">
						<div class="main-card order-summary">
							<div class="bp-title">
								<h4>Event information</h4>
							</div>
							<div class="order-summary-content p_30">
								<div class="event-order-dt">
									<div class="event-thumbnail-img">
										<img src="{{ asset("EventImage/$event->event_image") }}" alt="">
									</div>
									<div class="event-order-dt-content">
										<h5>{{ $event->event_name }}</h5>
										<span>{{ \Carbon\Carbon::parse($event->event_date . ' ' . $event->event_time)->format('D, M j, Y g:i A') }}</span>
									</div>
								</div>
                                <input type="text" name="id" id="id" value="{{ $event->event_id }}" hidden>

								<div class="confirmation-btn">
									<button class="main-btn btn-hover h_50 w-100 mt-5" type="submit" >Confirm Registration</button>
								</div>
							</div>
						</div>
					</div>
                   
				</div>
			</div>
		</div>
	</div>
	<!-- Body End-->
    </form>
	@include('Navigation-Student.footer')


  