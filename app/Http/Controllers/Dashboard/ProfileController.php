<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\DetailUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Dashboard\Profile\UpdateProfileRequest;
use App\Http\Requests\Dashboard\Profile\UpdateDetailUserRequest;
use App\Models\ExperienceUser;
use Illuminate\Support\Facades\File as FacadesFile;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = User::where('id', Auth::user()->id)->first();
            $experience_user = ExperienceUser::where('detail_user_id', $user->detail_user->id)
                                                ->orderBy('id', 'ASC')
                                                ->get();
            return view('pages.Dashboard.profile', compact('user', 'experience_user'));
        } catch (\Throwable $th) {
            abort(400, 'error ' . $th->getMessage() . ' ' . $th->getLine());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404, 'Not Found');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404, 'Not Found');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404, 'Not Found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404, 'Not Found');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request_profile, UpdateDetailUserRequest $request_detail_user)
    {
        $data_profile = $request_profile->all();
        $data_detail_user = $request_detail_user->all();

        // get photo
        $get_detail_user = DetailUser::where('users_id', Auth::user()->id)->first();
        $current_photo = $get_detail_user->photo;
        if(isset($data_detail_user['photo'])){
            $data = 'storage/' . $current_photo;
            if(FacadesFile::exists($data)){
                FacadesFile::delete($data);
            }else{
                $old_path = 'storage/app/public/';
                FacadesFile::delete($old_path . $current_photo);
            }
        }


        if($request_detail_user->hasFile('photo')){
            $data_detail_user['photo'] = $request_detail_user->file('photo')->store('assets/photo', 'public');
        }

        // save to user
        $user = User::find(Auth::user()->id);
        $user->update($data_profile);

        $detail_user = DetailUser::find($user->detail_user->id);
        $detail_user->update($data_detail_user);

        // save to experience user
        $experience_user = ExperienceUser::where('detail_user_id', $detail_user->id)->first();
        if($experience_user){
            foreach ($request_profile->experience as $key => $value) {
                $experience_user_add = ExperienceUser::find($key);
                $experience_user_add->detail_user_id = $detail_user->id;
                $experience_user_add->experience = $value;
                $experience_user_add->save();
            }
        }elseif(count($request_profile->experience) > 0){
            foreach ($request_profile->experience as $key => $value) {
                if(isset($value)){
                    $experience_user_add = new ExperienceUser();
                    $experience_user_add->detail_user_id = $detail_user->id;
                    $experience_user_add->experience = $value;
                    $experience_user_add->save();
                }
            }
        }

        toast()->success('Update profile success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404, 'Not Found');
    }


    public function delete()
    {
        $detail_user_id = DetailUser::where('user_id', Auth::user()->id)->first();
        $path_photo = $detail_user_id->photo;

        $data = DetailUser::find($detail_user_id->id);
        $data->photo = null;
        $data->save();

        $data_path = 'storage/'.$path_photo;
        if(FacadesFile::exists($data_path)){
            FacadesFile::delete($data_path);
        }else{
            FacadesFile::delete('storage/app/public' . $path_photo);
        }
        toast()->success('Delete photo success');
        return back();
    }
}
