<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\JobCategory;
use App\User;
use App\Profile;
use App\Applicant;
use Illuminate\Support\Facades\DB;
class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return vpopmail_del_domain(domain)
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function dashboard() {
        if(Auth()->user()->role !== 2) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
        $user_id = Auth()->user()->id;
        $user = User::find($user_id);
        $jobs = Job::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(5); 
        return view('client.dashboard')->with('jobs', $jobs);
    }   

    public function shortlist($id) {
        if(Auth()->user()->role !== 2) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
        $job = Job::findOrFail($id);
        $applicants = DB::table('applicants')
            ->join('profiles', 'applicants.user_id', '=', 'profiles.user_id')
            ->join('jobs', 'applicants.job_id', '=', 'jobs.id')
            ->join('users', 'applicants.user_id', '=', 'users.id')
            ->where(function ($query) use ($id) {
                        $query->where('applicants.job_id', $id);
                 })  
            ->orderBy('applicants.created_at', 'desc')
            ->get();
        return view('client.shortlist', compact('job', 'applicants'));
    }   

    public function proposal($id, $user_id) {
        if(Auth()->user()->role !== 2) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
         $job = Job::findOrFail($id);
         $applicant = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->join('applicants', 'users.id', '=', 'applicants.user_id')
            ->when($id, function ($query) use ($id) {
                    return $query->where('applicants.job_id', $id);
                })
            ->when($user_id, function ($query) use ($user_id) {
                    return $query->where('applicants.user_id', $user_id);
                })
            ->first();
            
        return view('client.proposal', compact('job', 'applicant'));
    }   

    public function hire($id, $user) {
        if(Auth()->user()->role !== 2) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
        $applicant = DB::table('applicants')
            ->when($id, function ($query) use ($id) {
                    return $query->where('job_id', $id);
                })
            ->when($user, function ($query) use ($user) {
                    return $query->where('user_id', $user);
                })
            ->update(['status' => 'hired']);   
        return redirect('jobs');
    }  

    public function reject($id, $user) {
        if(Auth()->user()->role !== 2) {
            return redirect('/')->with('error', 'Unauthorize Page');
        } 
         $applicant = DB::table('applicants')
            ->when($id, function ($query) use ($id) {
                    return $query->where('job_id', $id);
                })
            ->when($user, function ($query) use ($user) {
                    return $query->where('user_id', $user);
                })
            ->update(['status' => 'rejected']);

        return redirect('jobs');
    }  


        public function workerlist(Request $request) {
        $categories = JobCategory::all();
        $cat = $request->input('cat');
        $search = $request->input('search');


        if($request->has('cat') && $cat != 'all') {
            if($request->has('search') && $search != null) {
                $jobs = Profile::where('category_industry', $cat)
                ->join('users', 'profiles.user_id', '=', 'users.id')
                ->join('job_categories', 'profiles.category_industry', '=', 'job_categories.id')
                ->where(function ($query) use ($search) {
                        $query->where('title', 'like', '%'.$search.'%')
                              ->orWhere('overview', 'like', '%'.$search.'%');
                })->orderBy('profiles.created_at', 'desc')
                ->paginate(5)
                ->appends([
                    'cat' => request('cat'),
                    'search' => request('search')
                ]);
            } else {
                $jobs = Profile::where('category_industry', $cat)
                ->join('users', 'profiles.user_id', '=', 'users.id')
                ->join('job_categories', 'profiles.category_industry', '=', 'job_categories.id')
                ->orderBy('profiles.created_at', 'desc')
                ->paginate(5)
                ->appends([
                    'cat' => request('cat')
                ]);
            } 
        } else {



            $jobs = Profile::where('job_title', 'like', '%'.$search.'%')
            ->join('users', 'profiles.user_id', '=', 'users.id')
            ->join('job_categories', 'profiles.category_industry', '=', 'job_categories.id')
            ->orWhere('overview', 'like', '%'.$search.'%')
            ->orderby('profiles.created_at', 'desc')
            ->paginate(5)
            ->appends([
                'search' => request('search')
            ]);
        }
        
        return view('client.workerlist', compact('categories', 'jobs', 'cat', 'search'));
    }

}
