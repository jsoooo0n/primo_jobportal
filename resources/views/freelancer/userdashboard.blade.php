@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')

<section class="post-area section-gap">
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
											<a href="jobs/{{$job->id}}"><h4>{{$job->title}}</h4></a>
											<h6>Budget: &#36;{{$job->budget}} - Posted: {{$job->created_at->diffForHumans()}}</h6>					
										</div>
									</div>
									<div class="col-lg-2">
										<ul class="btns">
											<li><a href="#">Apply</a></li>
										</ul>
									</div>
								</div>
									<p>
										{!! str_limit($job->body, 150)!!}
									</p>
									<h5>Position Type: {{ ucwords($job->position_type) }}</h5>
									<h5>Project Duration: {{ ucwords($job->project_duration) }}</h5>
									<h5>Category: {{ ucwords($job->category->category_name) }}</h5>
									<!-- <p class="address"><span class="lnr lnr-map"></span> 56/8, Panthapath Dhanmondi Dhaka</p>
									<p class="address"><span class="lnr lnr-database"></span> 15k - 25k</p> -->
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
								<h4>Select Category</h4>
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

							<div class="single-slidebar">
								<h4>Carrer Advice Blog</h4>
								<div class="blog-list">
									<div class="single-blog " style="background:#000 url(img/blog1.jpg);">
										<a href="single.html"><h4>Home Audio Recording <br>
										For Everyone</h4></a>
										<div class="meta justify-content-between d-flex">
											<p>
												02 Hours ago
											</p>
											<p>
												<span class="lnr lnr-heart"></span>
												06
												 <span class="lnr lnr-bubble"></span>
												02
											</p>
										</div>
									</div>																		
								</div>
							</div>							

						</div>

					</div>
				</div>
	</section>



@endsection
