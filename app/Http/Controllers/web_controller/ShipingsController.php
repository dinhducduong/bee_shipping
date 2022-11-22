<?php

namespace App\Http\Controllers\web_controller;

use App\Http\Controllers\Controller;
use App\Models\shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ShipingsController extends Controller
{
    public function index()
    {
        try {
            $shippings = DB::table('shippings')->select(
                'shippings.id as shippings_id',
                'shippings.shipping_code',
                'shippings.name as shipping_name',
                'shippings.ship_from',
                'shippings.created_at',
                'delivery_status.name as delivery_status_name',
                'delivery_status.id as delivery_status_id',
                'lastest_checkpoint_time',
                'description_sub_status'
            )
                ->join('delivery_status', 'delivery_status.id', '=', 'shippings.delivery_status_id')
                ->join('sub_status_deliveries', 'sub_status_deliveries.id', '=', 'shippings.sub_delivery_status_id')
                ->orderBy('shippings.created_at', 'DESC')
                ->paginate(10);
            $status = DB::table('delivery_status')->get();
            $sub_status = DB::table('sub_status_deliveries')->get();
            return view('Content.Shippings.Shippings', [
                'shippings' => $shippings,
                'status' => $status,
                'sub_status' => $sub_status
            ]);
        } catch (\Throwable $th) {
            return "404 not found";
        }
    }
    public function update(Request $request)
    {

        try {
            $shipping = shipping::find($request['update_shipping']['shipping_id']);
            $shipping->delivery_status_id = (int) $request['update_shipping']['DeliveryStatus'];
            $shipping->latest_change_status = $shipping->sub_delivery_status_id;
            $shipping->sub_delivery_status_id = (int) $request['update_shipping']['SubDeliveryStatus'];
            $shipping->update();
            
            $sub_delivery_status = DB::table('sub_status_deliveries')->find($shipping->sub_delivery_status_id);


            Http::post('http://127.0.0.1:8000/create-log-tracking', [
                'shipping_code' => $shipping->shipping_code,
                'tracking_status_name' => $sub_delivery_status->description_sub_status,
                'status_name' => $sub_delivery_status->name,
            ]);


            // return "Chỉnh sửa đơn hàng " . $shipping->shipping_code . " thành công !";
        } catch (\Throwable $th) {
            return "404 not found";
        }
    }

    public function ShippingDetail(Request $request)
    {
        // try {

        // } catch (\Throwable $th) {

        // }
        try {
            $shipping_detail = DB::table('shippings')->where('shippings.id', '=', $request->ShippingId)
                ->select(
                    'shippings.*',
                    'delivery_status.id as delivery_status_id',
                    'delivery_status.name as delivery_status_name',
                    'sub_status_deliveries.id as sub_status_deliveries_id',
                    'sub_status_deliveries.description_sub_status as sub_status_deliveries_name'
                )
                ->join('sub_status_deliveries', 'sub_status_deliveries.id', '=', 'shippings.sub_delivery_status_id')
                ->join('delivery_status', 'delivery_status.id', '=', 'shippings.delivery_status_id')
                ->first();
            return $shipping_detail;
        } catch (\Throwable $th) {
            return "404 not found";
        }
    }
}
