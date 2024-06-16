<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Service;
use App\Models\Tagline;
use Illuminate\Http\Request;
use App\Models\AdvantageUser;
use App\Models\AdvantageService;
use App\Models\ThumbnailService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\Service\StoreServiceRequest;
use App\Http\Requests\Dashboard\Service\UpdateServiceRequest;

class ServiceController extends Controller
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
        $services = Service::with('thumbnails')->where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('pages.Dashboard.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.Dashboard.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        Log::debug('request : ', $request->all());
        try {
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            $service = Service::create($data);
            foreach ($data['advantage-service'] as $k =>$v) {
                $advantage_service = new AdvantageService;
                $advantage_service->service_id = $service->id;
                $advantage_service->advantage = $v;
                $advantage_service->save();
            }

            foreach ($data['user_advantages'] as $k=>$v) {
                $user_advantage = new AdvantageUser;
                $user_advantage->service_id = $service->id;
                $user_advantage->advantage = $v;
                $user_advantage->save();
            }

            if($request->hasFile('thumbnails')){
                foreach ($request->file('thumbnails') as $file) {
                    $thumbnail_title = $file->store('assets/service/thumbnail', 'public');
                    $thumbnails = new ThumbnailService;
                    $thumbnails->service_id = $service->id;
                    $thumbnails->thumbnail = $thumbnail_title;
                    $thumbnails->save();
                }
            }

            // add to tagline
            foreach($data['tagline'] as $k => $v){
                $tagline = new Tagline;
                $tagline->service_id = $service->id;
                $tagline->tagline = $v;
                $tagline->save();
            }


            toast()->success('success create service');
            return redirect()->route('member.service.index')->with('success', 'Service created successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            Log::error('failed create a service with : ' . $th->getMessage(), ['throw' => $th]);
            toast()->error('Failed create service, Please try again');
            return redirect()->back()->with('error', 'Service creation failed with ' . $th->getMessage())->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404, 'Detail Service Tidak ditemukan, hanya ada pada landing Service');
        // return view('pages.Dashboard.service.detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $advantage_service = AdvantageService::where('service_id', $service->id)->get();
        $taglines = Tagline::where('service_id', $service->id)->get();
        $user_advantages = AdvantageUser::where('service_id', $service->id)->get();
        $thumbnails = ThumbnailService::where('service_id', $service->id)->get();

        return view('pages.Dashboard.service.edit', compact('service', 'advantage_service', 'taglines', 'user_advantages', 'thumbnails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   UpdateServiceRequest $request
     * @param   Service  $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = $request->all();
        $service->update($data);

        foreach($data['advantage-service'] as $k =>$v) {
            $advantage_service = AdvantageService::firstOrNew(['service_id' => $service->id, 'advantage' => $v]);
            $advantage_service->service_id = $service->id;
            $advantage_service->advantage = $v;
            $advantage_service->save();
        }

        foreach($data['user_advantages'] as $k => $v) {
            $user_advantage = AdvantageUser::firstOrNew(['service_id' => $service->id, 'advantage' => $v]);
            $user_advantage->service_id = $service->id;
            $user_advantage->advantage = $v;
            $user_advantage->save();
        }

        foreach($data['tagline'] as $k => $v){
            $tagline = Tagline::firstOrNew(['service_id' => $service->id, 'tagline' => $v]);
            $tagline->service_id = $service->id;
            $tagline->tagline = $v;
            $tagline->save();
        }

        if($request->hasFile('thumbnails')){
            foreach ($request->file('thumbnails') as $file) {
                $thumbnail = ThumbnailService::find($file);
                $thumbnail_title = $file->store('assets/service/thumbnail', 'public');


                $thumbnail->service_id = $service->id;
                $thumbnail->thumbnail = $thumbnail_title;
                $thumbnail->save();
            }
        }


        toast()->success('success update service');
        return back()->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        DB::transaction(function () use ($service) {
            // Eager load relationships to avoid N+1 query issues
            $service->load([
                'advantageServices',
                'advantageUsers',
                'thumbnails', // Assuming 'thumbnails' is the relationship for ThumbnailService
                'taglines'
            ]);

            // Delete related data (no need for if checks)
            $service->advantageServices()->delete();
            $service->advantageUsers()->delete();
            $service->taglines()->delete();

            // Delete thumbnails and associated files
            foreach ($service->thumbnails as $thumbnail) {
                $thumbnailPath = 'services/' . auth()->user()->id . '/thumbnails/' . $thumbnail->thumbnail;
                if (Storage::disk('public')->exists($thumbnailPath)) {
                    Storage::disk('public')->delete($thumbnailPath);
                    Log::info('File deleted: ' . $thumbnailPath);
                }
            }
            $service->thumbnails()->delete(); // Delete the thumbnail records

            // Finally, delete the service itself
            $service->delete();
        });
        toast()->success('Success delete a service');
        // redirect to service index with success message
        return redirect()->route('dashboard.service.index')->with('success', 'Service deleted successfully.');
    }
}
