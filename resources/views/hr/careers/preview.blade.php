@extends('layouts.app_job')

@section('page_title')
{{ $data->title }}
@endsection

@section('content')

    <!-- Header Section End -->

    <!-- Page Header Start -->
    <div class="page-header" style="background: url({{ asset('assets/img/banner1.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="product-title">{{ $data->title }}</h2>
                        <ol class="breadcrumb">
                            <li class="current">{{ $data->department->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <section class="job-detail section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="header-detail">
                        <div class="header-content pull-left">
                            <h3><a href="#">{{ $data->title }}</a></h3>
                            <p><span>Date Posted: {{ $data->created_at->format('M d, Y') }}</span></p>
                            @if ($data->salary)
                                <p>Monthly Salary: <strong class="price">{{ $data->salary }}</strong></p>
                            @endif
                        </div>
                        <div class="detail-company pull-right text-right">

                            <div class="name">
                                <h4>&nbsp;</h4>
                                <h5>{{ $data->location }}</h5>
                            </div>
                        </div>
                        <div class="clearfix">
                            {{-- <div class="meta">
                                <span><a class="btn btn-border btn-sm" href="#"><i class="ti-email"></i> Email</a></span>
                                <span><a class="btn btn-border btn-sm" href="#"><i class="ti-info-alt"></i> Job
                                        Aleart</a></span>
                                <span><a class="btn btn-border btn-sm" href="#"><i class="ti-save"></i> Save This
                                        job</a></span>
                                <span><a class="btn btn-border btn-sm" href="#"><i class="ti-alert"></i> Report
                                        Abuse</a></span>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div class="content-area">
                        <div class="clearfix">
                            <div class="box">
                                <h4>Job Responsibility</h4>
                                <div class="job_res">
                                    {!! nl2br($data->description) !!}
                                </div>
                                <h4>Educational Requirements</h4>
                                <div class="job_res">
                                {!! nl2br($data->educational_requirements) !!} 
                                </div>
                                <a href="{{ route('careers.apply', $data->slug) }}" class="btn btn-common">Apply for this Job Now</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <aside>
                        <div class="sidebar">
                            <div class="box">
                                <h2 class="small-title">Job Details</h2>
                                <ul class="detail-list">
                                    
                                    <li>
                                        <a href="#">Location</a>
                                        <span class="type-posts">{{ $data->location }}</span>
                                    </li>
                                    <li>
                                        <a href="#">Employment Status</a>
                                        <span class="type-posts">{{  $data->employment_status }}</span>
                                    </li>
                                    
                                    <li>
                                        <a href="#">Positions</a>
                                        <span class="type-posts">{{ $data->no_of_vacancy }}</span>
                                    </li>

                                    <li>
                                        <a href="#">Department</a>
                                        <span class="type-posts">{{ $data->department->name }}</span>
                                    </li>
                                </ul>
                            </div>


                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    
@endsection

@section('script')
<script>
    var job_res = $(".job_res")
    var bullets = job_res.find('li')
    
    bullets.each(function( index ) {
      var txt = $(this).text()
      $(this).html(`<i class="ti-check-box"></i> ${txt}`)
      
    });

</script>
@endsection
