<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use PDF;
use function App\flash;
use App\Services\UploadFilesServices as UploadFile;


class ProfileController extends Controller
{
    /**
     * ProfileController constructor.
     * @param UploadFile $uploadFile
     */
    public function __construct(UploadFile $uploadFile)
    {
        $this->middleware('auth');

        $this->uploadFile = $uploadFile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile');
    }

    /**
     * @param Request $request
     */
    public function profilePhoto(UserRequest $request, User $user)
    {
        //handle file upload

            $user->image = $this->uploadFile->uploadImage($request, 'image', 'public/profile');
            $user->save();
            flash('Your photo has been successfully updated');


        return redirect()->route('profile.show', $user->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $this->authorize('onlyAdmin', auth()->user());

        $user = User::find($id);
        return view('profile')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\users $users
     * @return \Illuminate\Http\Response
     */
    public function edit(users $users)
    {
        //
    }

    /**
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UserRequest $request, int $user)
    {
        $this->authorize('update', auth()->user());

        $user = User::find($user);

        $user->update($request->validated());

        flash('Your info has been successfully updated');

        return redirect()->route('profile.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\users $users
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        // Soft delete the target user
        User::find($user)->delete();
        return redirect()->back();
    }

    /**
     * @param User $user
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function generateProfilePDF(User $user)
    {
        $this->authorize('onlyOwner', $user);

        $data = ['postsNumber' => $user->posts()->count(), 'user' => $user];
        $pdf = PDF::loadView('profile-pdf', $data);

        return $pdf->download('profile-' . $user->id . '.pdf');
    }
}
