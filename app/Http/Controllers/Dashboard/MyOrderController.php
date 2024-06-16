<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\MyOrder\UpdateMyOrderRequest;

class MyOrderController extends Controller
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
        $order_request = Order::with(['user_buyer.detail_user', 'user_freelancer', 'service', 'status'])
                            ->where(function($query){
                                $query->where('freelancer_id', Auth::user()->id);
                                    // ->orWhere('buyer_id', Auth::user()->id);
                            })
                            ->orderBy('created_at', 'desc')
                            ->get();
        return view('pages.Dashboard.order.index', compact('order_request'));
    }

    public function submit($id)
    {
        $order_request = Order::with(['user_buyer.detail_user', 'user_freelancer', 'service', 'status'])
                            ->where('freelancer_id', Auth::user()->id)
                            ->where('id', $id)
                            ->orderBy('created_at', 'desc')
                            ->first();
        return view('pages.Dashboard.order.submit', compact('order_request'));
    }

    public function submit_post(Request $request, $id)
    {
        $order_request = Order::with(['user_buyer.detail_user', 'user_freelancer', 'service', 'status'])
                            ->where('freelancer_id', Auth::user()->id)
                            ->where('id', $id)
                            ->orderBy('created_at', 'desc')
                            ->first();
        // validate the request



        return redirect();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order = $order->load([
                    'service' => function($query){
                        $query->with(['thumbnails', 'advantageUsers', 'advantageServices', 'taglines']);
                    },
                    'status'
                ]);
             $thumbnails = $order->service->thumbnails;
             $advantage_user = $order->service->advantageUsers;
             $advantage_service = $order->service->advantageServices;
             $tagline = $order->service->taglines;

        return view('pages.dashboard.order.detail', compact('order', 'thumbnails', 'advantage_user', 'advantage_service', 'tagline'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $order = $order->load(['user_buyer.detail_user', 'user_freelancer', 'service', 'status']);
        return view('pages.Dashboard.order.submit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMyOrderRequest $request, Order $order)
    {
        $data = $request->all();

        if($request->hasFile('file')){
            $data['file'] = $request->file('file')->store('assets/order/attachment', 'public');
        }

        $order = Order::find($order->id);
        $order->update([
            'file' => $data['file'],
            'note' => $data['note']
        ]);

        toast()->success('Submit Order successfully!');
        return redirect()->route('member.order.index')->with('success', 'Submit Order successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }

    public function accepted($id)
    {
        $order = Order::find($id);
        if ($order) {
            // Update the order status to 1
            $order->update([
                'order_status_id' => 2
            ]);
            toast()->success('Order accepted successfully!');
            return redirect()->route('member.order.index')->with('success', 'Order accepted successfully!');
        } else {
            abort(404);
        }
    }

    public function rejected($id)
    {
        $order = Order::find($id);
        if ($order) {
            // Update the order status to 3
            $order->update([
                'order_status_id' => 3
            ]);
            toast()->success('Order rejected successfully!');
            return redirect()->route('member.order.index')->with('success', 'Order rejected successfully!');
        } else {
            abort(404);
        }
    }
}
