<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    protected $user;

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        // Get the current user
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();

            return $next($request);
        });

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function posts()
    {
        return view('dashboard.posts')->with('posts', $this->user->posts);
    }

    /**
     * Get all selected users data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function users()
    {
        $this->authorize('onlyAdmin', $this->user);

        // Get all the users But without deleted once
        $users = DB::table('users')->select(
            'id',
            'first_name',
            'last_name',
            'email',
            'phone',
            'location',
            'type',
            'created_at')
            ->where('deleted_at', null)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('dashboard.users')->with('users', $users);
    }

    /**
     * Change role of the user based on current role
     * @param User $user
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function changeRole(User $user)
    {
        $this->authorize('onlyAdmin');
        // If admin role change to default OR opposite
        $user->type = $user->type != 'admin' ? 'admin' : 'default';
        $user->save();

    }

    /**
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function export()
    {
        $this->authorize('onlyAdmin');

        $headings = [
            '#',
            'First Name',
            'Last Name',
            'Email Address',
            'Phone',
            'location',
            'Authentication'
        ];

        return  (new UsersExport($headings))->download('users.xlsx');
    }

}
