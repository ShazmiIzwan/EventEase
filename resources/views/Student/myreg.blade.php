<?php
$page = 'myreg';
?>
@include('Navigation-Student.app')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<style>
	:root {
		--bg: #e3e4e8;
		--fg: #17181c;
		--primary: #255ff4;
		--yellow: #f4a825;
		--yellow-t: rgba(244, 168, 37, 0);
		--bezier: cubic-bezier(0.42, 0, 0.58, 1);
		--trans-dur: 0.3s;

	}

	.btn:hover {
		color: white !important;
	}

	.rating {
		margin: auto;
	}

	.rating__display {
		font-size: 1em;
		font-weight: 500;
		min-height: 1.25em;
		position: absolute;
		top: 100%;
		width: 100%;
		text-align: center;
	}

	.rating__stars {
		display: flex;
		padding-bottom: 0.375em;
		position: relative;
		font-size: calc(18px + (30 - 24) * (100vw - 320px) / (1280 - 320));
	}

	.rating__star {
		display: block;
		overflow: visible;
		pointer-events: none;
		width: 2em;
		height: 2em;
	}

	.rating__star-ring,
	.rating__star-fill,
	.rating__star-line,
	.rating__star-stroke {
		animation-duration: 1s;
		animation-timing-function: ease-in-out;
		animation-fill-mode: forwards;
	}

	.rating__star-ring,
	.rating__star-fill,
	.rating__star-line {
		stroke: var(--yellow);
	}

	.rating__star-fill {
		fill: var(--yellow);
		transform: scale(0);
		transition: fill var(--trans-dur) var(--bezier), transform var(--trans-dur) var(--bezier);
	}

	.rating__star-line {
		stroke-dasharray: 12 13;
		stroke-dashoffset: -13;
	}

	.rating__star-stroke {
		stroke: #c7cad1;
		transition: stroke var(--trans-dur);
	}

	.rating__label {
		cursor: pointer;
		padding: 0.125em;
	}

	.rating__label--delay1 .rating__star-ring,
	.rating__label--delay1 .rating__star-fill,
	.rating__label--delay1 .rating__star-line,
	.rating__label--delay1 .rating__star-stroke {
		animation-delay: 0.05s;
	}

	.rating__label--delay2 .rating__star-ring,
	.rating__label--delay2 .rating__star-fill,
	.rating__label--delay2 .rating__star-line,
	.rating__label--delay2 .rating__star-stroke {
		animation-delay: 0.1s;
	}

	.rating__label--delay3 .rating__star-ring,
	.rating__label--delay3 .rating__star-fill,
	.rating__label--delay3 .rating__star-line,
	.rating__label--delay3 .rating__star-stroke {
		animation-delay: 0.15s;
	}

	.rating__label--delay4 .rating__star-ring,
	.rating__label--delay4 .rating__star-fill,
	.rating__label--delay4 .rating__star-line,
	.rating__label--delay4 .rating__star-stroke {
		animation-delay: 0.2s;
	}

	.rating__input {
		position: absolute;
		-webkit-appearance: none;
		appearance: none;
	}

	.rating__input:hover~[data-rating]:not([hidden]) {
		display: none;
	}

	.rating__input-1:hover~[data-rating="1"][hidden],
	.rating__input-2:hover~[data-rating="2"][hidden],
	.rating__input-3:hover~[data-rating="3"][hidden],
	.rating__input-4:hover~[data-rating="4"][hidden],
	.rating__input-5:hover~[data-rating="5"][hidden],
	.rating__input:checked:hover~[data-rating]:not([hidden]) {
		display: block;
	}

	.rating__input-1:hover~.rating__label:first-of-type .rating__star-stroke,
	.rating__input-2:hover~.rating__label:nth-of-type(-n + 2) .rating__star-stroke,
	.rating__input-3:hover~.rating__label:nth-of-type(-n + 3) .rating__star-stroke,
	.rating__input-4:hover~.rating__label:nth-of-type(-n + 4) .rating__star-stroke,
	.rating__input-5:hover~.rating__label:nth-of-type(-n + 5) .rating__star-stroke {
		stroke: var(--yellow);
		transform: scale(1);
	}

	.rating__input-1:checked~.rating__label:first-of-type .rating__star-ring,
	.rating__input-2:checked~.rating__label:nth-of-type(-n + 2) .rating__star-ring,
	.rating__input-3:checked~.rating__label:nth-of-type(-n + 3) .rating__star-ring,
	.rating__input-4:checked~.rating__label:nth-of-type(-n + 4) .rating__star-ring,
	.rating__input-5:checked~.rating__label:nth-of-type(-n + 5) .rating__star-ring {
		animation-name: starRing;
	}

	.rating__input-1:checked~.rating__label:first-of-type .rating__star-stroke,
	.rating__input-2:checked~.rating__label:nth-of-type(-n + 2) .rating__star-stroke,
	.rating__input-3:checked~.rating__label:nth-of-type(-n + 3) .rating__star-stroke,
	.rating__input-4:checked~.rating__label:nth-of-type(-n + 4) .rating__star-stroke,
	.rating__input-5:checked~.rating__label:nth-of-type(-n + 5) .rating__star-stroke {
		animation-name: starStroke;
	}

	.rating__input-1:checked~.rating__label:first-of-type .rating__star-line,
	.rating__input-2:checked~.rating__label:nth-of-type(-n + 2) .rating__star-line,
	.rating__input-3:checked~.rating__label:nth-of-type(-n + 3) .rating__star-line,
	.rating__input-4:checked~.rating__label:nth-of-type(-n + 4) .rating__star-line,
	.rating__input-5:checked~.rating__label:nth-of-type(-n + 5) .rating__star-line {
		animation-name: starLine;
	}

	.rating__input-1:checked~.rating__label:first-of-type .rating__star-fill,
	.rating__input-2:checked~.rating__label:nth-of-type(-n + 2) .rating__star-fill,
	.rating__input-3:checked~.rating__label:nth-of-type(-n + 3) .rating__star-fill,
	.rating__input-4:checked~.rating__label:nth-of-type(-n + 4) .rating__star-fill,
	.rating__input-5:checked~.rating__label:nth-of-type(-n + 5) .rating__star-fill {
		animation-name: starFill;
	}

	.rating__input-1:not(:checked):hover~.rating__label:first-of-type .rating__star-fill,
	.rating__input-2:not(:checked):hover~.rating__label:nth-of-type(2) .rating__star-fill,
	.rating__input-3:not(:checked):hover~.rating__label:nth-of-type(3) .rating__star-fill,
	.rating__input-4:not(:checked):hover~.rating__label:nth-of-type(4) .rating__star-fill,
	.rating__input-5:not(:checked):hover~.rating__label:nth-of-type(5) .rating__star-fill {
		fill: var(--yellow-t);
	}

	.rating__sr {
		clip: rect(1px, 1px, 1px, 1px);
		overflow: hidden;
		position: absolute;
		width: 1px;
		height: 1px;
	}

	@media (prefers-color-scheme: dark) {
		:root {
			--bg: #17181c;
			--fg: #e3e4e8;
		}

		.rating {
			margin: auto;
		}

		.rating__star-stroke {
			stroke: #454954;
		}
	}

	@keyframes starRing {

		from,
		20% {
			animation-timing-function: ease-in;
			opacity: 1;
			r: 8px;
			stroke-width: 16px;
			transform: scale(0);
		}

		35% {
			animation-timing-function: ease-out;
			opacity: 0.5;
			r: 8px;
			stroke-width: 16px;
			transform: scale(1);
		}

		50%,
		to {
			opacity: 0;
			r: 16px;
			stroke-width: 0;
			transform: scale(1);
		}
	}

	@keyframes starFill {

		from,
		40% {
			animation-timing-function: ease-out;
			transform: scale(0);
		}

		60% {
			animation-timing-function: ease-in-out;
			transform: scale(1.2);
		}

		80% {
			transform: scale(0.9);
		}

		to {
			transform: scale(1);
		}
	}

	@keyframes starStroke {
		from {
			transform: scale(1);
		}

		20%,
		to {
			transform: scale(0);
		}
	}

	@keyframes starLine {

		from,
		40% {
			animation-timing-function: ease-out;
			stroke-dasharray: 1 23;
			stroke-dashoffset: 1;
		}

		60%,
		to {
			stroke-dasharray: 12 13;
			stroke-dashoffset: -13;
		}
	}
</style>


<!-- Body Start-->
<div class="wrapper">
	<div class="breadcrumb-block">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-10">
					<div class="barren-breadcrumb">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item active" aria-current="page">My Registration</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="event-dt-block p-80">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12">
					<h1 style="text-align: center;">My Registration</h1>
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

					<table class="table table-striped" id="myTable">
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Event</th>
								<th scope="col">Date & Time</th>
								<th scope="col">Registered At</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($registrations as $key => $reg)
							<tr>
								<th scope="row">{{ ++$key }}</th>
								<td> <a href="viewEvent/{{ $reg->event_id }}">{{ $reg->events->event_name }}</a><br><b style="color:blue;">{{ $reg->events->getcategory->category }}</b></td>
								<td>{{ \Carbon\Carbon::parse($reg->events->event_date . ' ' . $reg->events->event_time)->format('d M Y, h.i A') }}</td>
								<td>{{ \Carbon\Carbon::parse($reg->created_at)->format('d M Y, h.i A') }}</td>
								<td>{{ $reg->status }}</td>
								<td>
								@if($reg->status != 'Cancelled')

								@if($reg->status != 'Completed')
  <!-- Cancel: submits a POST form with JS confirm -->
  <form action="{{ route('registrations.cancel', $reg->registrations_id) }}"
        method="POST"
        class="d-inline"
        onsubmit="return confirm('Are you sure you want to withdraw your registration?');">
    @csrf
    <button type="submit" class="btn btn-sm btn-danger">
      <i class="fa-solid fa-times me-1"></i> Withdraw
    </button>
  </form>
  @endif

  @if($reg->status == 'Completed')
  <!-- Print Certificate: opens PDF in new tab -->
  <a href="{{ route('registrations.certificate', $reg->registrations_id) }}"
     target="_blank"
     class="btn btn-sm btn-primary">
    <i class="fa-solid fa-print me-1"></i> Certificate
  </a>
  @endif

  @else
	-
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
</div>
<!-- Body End-->


<!-- About Details Model End-->
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

	});
</script>