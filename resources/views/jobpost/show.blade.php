@extends('layouts.app')


@section('title')
    {{$job->title}}
@endsection


@section('content')

<section class="post-area section-gap">
                <div class="container">
                    <div class="row justify-content-center">
                    
                        <div class="col-lg-7">
                            <div class="container callto-action-area">
                            <h3 class="h3 text-white mb-4 p-3 text-center">{{$job->title}}</h3>
                            </div>
                              <p><b>Overview:</b></p>
                               {!! $job->body !!}
                        </div>

                        <div class="col-lg-5">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <span class="text-success">
                                        <i class="fas fa-clock"></i> Posted: 
                                    </span>
                                    {{$job->created_at->diffForHumans()}}
                                </li>
                                <li class="mb-2">
                                    <span class="text-success">
                                        <i class="fas fa-briefcase"></i> Position : 
                                    </span>
                                    {{ucwords($job->position_type)}}
                                </li>
                                <li class="mb-2">
                                    <span class="text-success">
                                        <i class="fas fa-hourglass-end"></i> Project Duration:  
                                    </span>
                                    {{ ucwords($job->project_duration) }}
                                </li>
                                <li class="mb-2">
                                    <span class="text-success">
                                        <i class="fas fa-tags"></i> Category: 
                                    </span>
                                    {{ ucwords($job->category->category_name) }}
                                </li>
                                <li class="mb-2">
                                    <span class="text-success">
                                        <i class="fas fa-dollar-sign"></i> Budget: 
                                    </span>
                                    {{number_format($job->budget)}}
                                </li>
                            </ul>
                            <hr>

                            <ul class="list-unstyled">
                                <li class="mb-2 h5 text-info">About the Client</li>
                                <li class="mb-2">
                                    <span class="text-primary">Job Posting History: </span>{{$jobcount}} jobs posted</li>
                                <li class="mb-2">
                                    <span class="text-primary">Member Since: </span>{{date("M Y", strtotime($job->user->created_at))}}
                                </li>
                            </ul>
                            @guest
                            @else
                                @if(Auth::user()->role == 1)
                                    @if ($result == 'exist')
                                       <button class="btn btn-success btn-block"><i class="fas fa-check"></i>Applied</button>
                                    @else
                                    <a href="{{url("/job/application/$job->id")}}"><button class="btn btn-primary btn-block"> Apply to this Job</button></a>
                                    @endif
                                @endif
                            @endguest

                        </div>

                    </div>
                </div>
</section>




























@endsection
