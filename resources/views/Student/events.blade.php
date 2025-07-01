<?php
$page = 'events';
?>
@include('Navigation-Student.app')
<!-- Body Start-->
<div class="wrapper">
    <div class="hero-banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-8 col-md-10">
                    <div class="hero-banner-content">
                        <h2>Discover Academic Events for Postgraduate Scholars</h2>
                        <p>Explore seminars, workshops, and conferences curated to enhance your postgraduate research and professional growth.</p>
                        <div class="col-lg-12 col-md-12" style="margin-top: 50px;">
                            <div class="form-group">
                                <input type="text" class="form-control" name="search" id="search" placeholder="Search academic events here..." style="text-align: center; height:50px;"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="explore-events p-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="event-filter-items">
                        <div class="featured-controls">
                            <div class="controls">
                                <button type="button" class="control" data-filter="all">All</button>
                                @foreach($category as $category)
                                    <button type="button" class="control" data-filter=".{{ \Illuminate\Support\Str::slug($category->category, '_') }}">{{ $category->category }}</button>
                                @endforeach
                            </div>
                            <div class="row event-filter-content" data-ref="event-filter-content">
                                @foreach($events as $event)
                                    @php
                                        $now = now();
                                    @endphp
                                    <div class="col-xl-4 col-lg-5 col-md-7 col-sm-12 mix {{ \Illuminate\Support\Str::slug($event->getcategory->category, '_') }} " data-ref="mixitup-target">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Body End-->
@include('Navigation-Student.footer')

<script>
    $(document).ready(function(){
        $("#search").keyup(function(){
            var filter = $(this).val();
            $(".event-filter-content > .mix").each(function(){
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).fadeOut();
                } else {
                    $(this).show();
                }
            });
        });
    });
</script>
