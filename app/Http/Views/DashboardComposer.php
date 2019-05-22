<?php

namespace App\Http\Views;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Services\SidebarServices;
use App\User;

class DashboardComposer extends Controller
{
    /**
     * @var
     */
    protected $user;

    /**
     * ProfileComposer constructor.
     * @param SidebarServices $sidebarServices
     */
    public function __construct(SidebarServices $sidebarServices)
    {
        $this->middleware('auth');

        // Dependencies automatically resolved by service container...
        $this->user = auth()->user();

        $this->sidebarServices = $sidebarServices;

    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('usersNumber', $this->sidebarServices->numberOfUsers())
            ->with('postsNumber', $this->sidebarServices->numberOfPosts($this->user));
    }
}
