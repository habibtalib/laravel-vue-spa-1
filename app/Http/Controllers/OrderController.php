<?php

namespace App\Http\Controllers;

use App\CompanyProfile;
use App\Courier;
use App\Order;
use App\OrderItem;
use App\OrderStatus;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Mockery\Exception;

class OrderController extends Controller
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
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();

        return response()->json(
            [
                'status' => 'success',
                'data' => $orders,
            ], 200);

    }

    public function buyerIndex()
    {
        $user = auth()->user();
        $orders = Order::where('seller_id', $user->id)->orderBy('created_at', 'DESC')->get();

        return response()->json(
            [
                'status' => 'success',
                'data' => $orders,
            ], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
        $company_profiles = CompanyProfile::first();
        $couriers = Courier::all();
        $order_statuses = OrderStatus::all();
        $order_items = OrderItem::where('order_id', $order->id)->get();
        $res = null;
        $contents = null;
        if ($order->bill_id) {
            $client = new \GuzzleHttp\Client();
            try {
                $res = $client->request('GET', env('BILLPLZ_URL', 'https://www.billplz.com') . '/api/v3/bills/' . $order->bill_id, [
                    'auth' => [
                        env('BILLPLZ_API_KEY', '2e455b86-ef7d-4231-a146-18efffe74170') . ':', '',
                    ],
                ]);
            } catch (\Exception $e) {

            }

            if ($res && $res->getStatusCode() == 200) {
                $contents = json_decode($res->getBody()->getContents());
                if ($contents->paid && $order->status == 1) {
                    $order->update(array('status' => 2));
                }
                ;
            }
            ;
        }

        // return view('orders.show', compact('order', 'order_items', 'couriers', 'user', 'contents', 'order_statuses', 'company_profiles'));
        return response()->json(
            [
                'status' => 'success',
                'data' => ['order' => $order, 'order_items' => $order_items],
            ], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('orders.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $order = Order::find($id);
        $order->update(
            $request->all()
        );

        if (!empty($request->tracking_number) && $request->courier_id != 0 && $order->status == 2) {
            $order->status = 3;
            $order->save();
        }

        return redirect('orders/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Order::find($id);
        $product->delete();

        return redirect('orders');
    }

    public function completed($id)
    {

        return view('orders.completed');
    }

    public function updatePayment(Order $order)
    {
        $order->update(array('status' => 2));
    }

    public function savePdf(Order $order)
    {
        $company_profiles = CompanyProfile::first();
        $user = auth()->user();
        if (($user->role->is_admin) || ($user->id == $order->user_id)) {
            $company_profiles = CompanyProfile::first();
            $couriers = Courier::all();
            $order_statuses = OrderStatus::all();
            $order_items = OrderItem::where('order_id', $order->id);
            $res = null;
            $contents = null;
            if ($order->bill_id) {
                $client = new \GuzzleHttp\Client();
                try {
                    $res = $client->request('GET', env('BILLPLZ_URL', 'https://www.billplz.com') . '/api/v3/bills/' . $order->bill_id, [
                        'auth' => [
                            env('BILLPLZ_API_KEY', '2e455b86-ef7d-4231-a146-18efffe74170') . ':', '',
                        ],
                    ]);
                } catch (\Exception $e) {

                }

                if ($res && $res->getStatusCode() == 200) {
                    $contents = json_decode($res->getBody()->getContents());
                    if ($contents->paid && $order->status == 1) {
                        $order->update(array('status' => 2));
                    };
                };
            }
            $pdf = PDF::loadView('order.pdf', compact('company_profiles', 'order', 'contents', 'order_statuses', 'couriers'));
            return $pdf->download('invoice.pdf');
        } else {
            return redirect('/');
        }
    }
}