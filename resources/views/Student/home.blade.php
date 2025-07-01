<?php
$page = 'home';
?>
@include('Navigation-Student.app')
<!-- Body Start-->
<div class="wrapper">
    <div class="hero-banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-9 col-md-10">
                    <div class="hero-banner-content">
                        <h2>Empower Your Postgraduate Journey with Events at Your Fingertips!</h2>
                        <p>Discover and register for seminars, workshops, and conferences tailored for postgraduate studies in just a few simple steps with secure online registration.</p>
                        <a href="/events" class="main-btn btn-hover">Explore Academic Events <i class="fa-solid fa-arrow-right ms-3"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="explore-events p-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="main-title">
                        <h3>Explore Events</h3>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="event-filter-items">
                        <div class="featured-controls">
                            <div class="controls">
                                <button type="button" class="control" data-filter="all">All</button>
                                @foreach($category as $category)
                                    <button type="button" class="control" data-filter=".{{ \Illuminate\Support\Str::slug($category->category, '_') }}">{{ $category->category }}</button>
                                @endforeach
                            </div>
                            <div class="row" data-ref="event-filter-content">
                                @foreach($events as $event)
                                    @php
                                        $now = now();
                                    @endphp
                                    <div class="col-xl-4 col-lg-5 col-md-7 col-sm-12 mix {{ \Illuminate\Support\Str::slug($event->getcategory->category, '_') }}" data-ref="mixitup-target">
                                        <div class="main-card mt-4">
                                            <div class="event-thumbnail">
                                                <a href="viewEvent/{{ $event->event_id }}" class="thumbnail-img">
                                                    <img src="EventImage/{{ $event->event_image }}" alt="{{ $event->event_name }}">
                                                </a>
                                            </div>
                                            <div class="event-content">
                                                <a href="viewEvent/{{ $event->event_id }}" class="event-title">
                                                    {{ $event->event_name }} <br><b style="color:blue;">{{ $event->getcategory->category }}</b>
                                                </a>
                                            </div>
                                            <div class="event-footer">
                                                <div class="event-timing">
                                                    <div class="publish-date">
                                                        <span><i class="fa-solid fa-calendar-day me-2"></i>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</span>
                                                        <span class="dot"><i class="fa-solid fa-circle"></i></span>
                                                        @php
                                                            $diff = $event->created_at->diff(now());
                                                            $formattedDiff = $diff->h > 23 ? $diff->d . 'd' : $diff->h . 'h';
                                                        @endphp
                                                        <span>{{ \Carbon\Carbon::parse($event->event_date . ' ' . $event->event_time)->format('D, h.i A') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="browse-btn">
                                <a href="/events" class="main-btn btn-hover">Browse All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="feature-block p-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="main-title">
                        <h3>Discover Your Perfect Postgraduate Event Experience</h3>
                        <p>EventEase offers a curated selection of academic and networking events specifically for postgraduate students, designed to enhance your research and professional growth.</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="feature-group-list">
                        <div class="row">
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="feature-item mt-46">
                                    <div class="feature-icon">
                                        <img src="images/icons/feature-icon-1.png" alt="Research Seminars">
                                    </div>
                                    <h4>Research Seminars</h4>
                                    <p>Attend specialized seminars led by experts in your field of study.</p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="feature-item mt-46">
                                    <div class="feature-icon">
                                        <img src="images/icons/feature-icon-2.png" alt="Industry Workshops">
                                    </div>
                                    <h4>Industry Workshops</h4>
                                    <p>Participate in workshops that bridge academia and industry practices.</p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="feature-item mt-46">
                                    <div class="feature-icon">
                                        <img src="images/icons/feature-icon-3.png" alt="Networking Sessions">
                                    </div>
                                    <h4>Networking Sessions</h4>
                                    <p>Connect with peers, researchers, and professionals at our networking events.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('Navigation-Student.footer')
