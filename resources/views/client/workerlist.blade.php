@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')

<section class="post-area section-gap">

				<div class="container callto-action-area">
					<div class="row d-flex justify-content-center">
						<div class="menu-content col-lg-9">
							<div class="title text-center">
								<h1 class="mb-10 mt-20 text-white">Jobseeker List</h1>
							</div>	
						</div>
					</div>	
				</div><br>

				<div class="container">

					<div class="row justify-content-center d-flex">
						<div class="col-lg-8 post-list">
							@if(count($jobs) > 0)
		                    @foreach ($jobs as $job)
							<div class="single-post flex-row">
								<div class="details">
									<div class="title flex-row justify-content-between row">
										<div class="col-lg-10">
										<div class="titles">
											<a href="/applicant/profile/{{$job->user_id}}"><h4>{{$job->name}}</h4></a>			
										</div>
									</div>
									<div class="col-lg-2">
										<ul class="btns">
											<li><a href="/applicant/profile/{{$job->user_id}}">View</a></li>
										</ul>
									</div>
								</div>
									<p>
										{!! str_limit($job->overview, 150)!!}
									</p>
									<span><span class=""><i class="fas fa-briefcase"></i> Job Type:</span> {{ ucwords($job->position_type) }}</span>	
			                        <br>
			                        <span><span class=""><i class="fas fa-hourglass-end"></i> Industry:</span> {{ ucwords($job->category_name) }}</span>
			                        <br>
			                        <span><span class=""><i class="fas fa-tags"></i> Salary:</span> {{ $job->salary_from }} - {{ $job->salary_from }}</span>
								</div>
							</div>
							@endforeach
		                    {{ $jobs->links() }}
		                @else 
		                	<h2 class="h2 text-muted text-center">NO RESULT FOUND</h2>
		                @endif
						</div>


						
						<div class="col-lg-4 sidebar">
							<div class="single-slidebar">
								<h4 class="h4 text-info">Select Category</h4>
		            		<form method="get">
			            		<div class="form-check">
								 <input class="form-check-input catFilter" type="checkbox"  value="all" id="filterall" name="cat"
								 @if($cat > 0)
									{{'unchecked'}}
								 @else 
								 	{{'checked'}}	 	
								 @endif
								 >
								  <label class="form-check-label" for="filterall">All
								  </label>
								</div>
			            		@foreach($categories as $category)
				            		<div class="form-check">
									 <input class="form-check-input catFilter" type="checkbox" value="{{$category->id}}" id="defaultCheck1{{$category->id}}" name="cat"
									 @if($cat == $category->id)
									 	{{'checked'}}
									 @endif	
									 >
									  <label class="form-check-label" for="defaultCheck1{{$category->id}}">
									   {{$category->category_name}}
									  </label>
									</div>
			            		@endforeach


			            		<input type="text" name="search" class="form-control mt-2" placeholder="Search Job" value="{{$search}}">
			            		<button class="btn btn-info mt-2" id="searchCat">Seach</button>
		            		</form>
							</div>							

							<div class="single-slidebar">
								<h4>Jobs by Category</h4>
								<ul class="cat-list">
									<li><a class="justify-content-between d-flex" href="category.html"><p>Technology</p><span>37</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Media & News</p><span>57</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Goverment</p><span>33</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Medical</p><span>36</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Restaurants</p><span>47</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Developer</p><span>27</span></a></li>
									<li><a class="justify-content-between d-flex" href="category.html"><p>Accounting</p><span>17</span></a></li>
								</ul>
							</div>						

						</div>

					</div>
				</div>
	</section>


@endsection
