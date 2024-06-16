<?php

namespace App\Http\Controllers\Landing;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
* Landing Page Controller
*
* This controller handles the landing page of the application
*
* @package App\Http\Controllers\Landing
* @author [Your Name]
*/
class LandingController extends Controller
{
    /**
    * Display a listing of the landing page
    *
    * This function is responsible for rendering the landing page view
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $services = Service::orderBy('created_at', 'DESC')->get();
        return view('pages.Landing.index', compact('services'));
    }

    public function explore()
    {
        $services = Service::orderBy('created_at', 'DESC')->get();
        return view('pages.Landing.explorer', compact('services'));
    }

    public function detail($id)
    {
        $service = Service::with(['advantageUsers', 'advantageServices', 'thumbnails', 'taglines'])
                    ->where('id', $id)
                    ->first();
        $advantage_users = $service->advantageUsers;
        $advantage_services = $service->advantageServices;
        $thumbnails = $service->thumbnails;
        $taglines = $service->taglines;
        return view('pages.Landing.detail', compact('service', 'advantage_users', 'advantage_services', 'thumbnails', 'taglines'));
    }

    public function booking($id)
    {
        if(!Auth::check()){
            toast()->warning('You must be logged in!');
            return back()->with('error', 'You must be logged in!');
        }
        $service = Service::with('user')->where('id', $id)->first();
        if(!$service){
            toast()->warning("Service to book is not found");
            return back()->with('error', "Service to book is not found");
        }
        if($service->users_id == Auth::user()->id){
            toast()->warning('You cannot book your own service!');
            return back()->with('error', 'You cannot book your own service!');
        }
        // Create a new order
        $order = new Order();
        $order->buyer_id = Auth::user()->id;
        $order->freelancer_id = $service->user->id;
        $order->service_id = $id;
        $order->file = NULL;
        $order->note = NULL;
        $order->expired = Date('y-m-d', strtotime("+3 days"));
        $order->order_status_id = 4;
        $order->save();

        $order_detail = Order::where('id', $order->id)->first();
        // Redirect to the order confirmation page or wherever you want
        toast()->success('Success create an Order');
        return redirect()->route('landing.detail_booking', $order->id)->with('success','Success create an Order');
    }

    public function detail_booking($id)
    {
        $order = Order::where('id', $id)->first();
        return view('pages.Landing.booking', compact('order'));
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function edit($id)
    {
        abort(404);
    }

    public function update(Request $request, $id)
    {
        abort(404);
    }

    public function destroy($id)
    {
        abort(404);
    }

}
