<?php

namespace App\Http\Controllers;

use App\Models\delivery_status;
use App\Models\ship_detail;
use App\Models\shipping;
use App\Models\SubStatus_delivery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{
    public function UpdateShipping(Request $request)
    {
        try {
            if ($request->weight_from_volume > 0 && $request->weight_from_volume <= 5) {
                $fee_service = 40000;
            } else if ($request->weight_from_volume > 5 && $request->weight_from_volume <= 20) {
                $fee_service = 70000;
            } else if ($request->weight_from_volume > 20 && $request->weight_from_volume <= 100) {
                $fee_service = 100000;
            } else if ($request->weight_from_volume > 100) {
                $fee_service = 200000;
            }
            DB::table('shippings')->where('shipping_code', '=', $request->code)->update(
                [
                    'weight' =>  $request->weight,
                    'fee_service' => $fee_service,
                ]
            );
            
            return response()->json([
                'fee_service' => $fee_service,
            ]);
        }catch (\Throwable $th) {
            return response()->json(['error' => "Hệ thống đang lỗi vui lòng thử lại sau!"], 400);
        }
    }
    public function CreateShipping(Request $request)
    {
        try {
            if ($request->weight_from_volume > 0 && $request->weight_from_volume <= 5) {
                $fee_service = 40000;
            } else if ($request->weight_from_volume > 5 && $request->weight_from_volume <= 20) {
                $fee_service = 70000;
            } else if ($request->weight_from_volume > 20 && $request->weight_from_volume <= 100) {
                $fee_service = 100000;
            } else if ($request->weight_from_volume > 100) {
                $fee_service = 200000;
            }
            $shipping_code = "PX" . date("YmdHis");
            $data = [
                'shipping_code' => $shipping_code,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' =>  $request->email,
                'ship_from' =>  $request->ship_from,
                'ship_to' =>  $request->ship_to,
                'weight' =>  $request->weight,
                'fee_service' =>  $fee_service,
                'height' =>  $request->height,
                'delivery_status_id' => 4,
                'sub_delivery_status_id' => 61,
                'latest_change_status' => 61,
                'lastest_checkpoint_time' => Carbon::now(),
                'note' =>  $request->note,
            ];

            $new_shipping = shipping::create($data);

            $delivery_status = delivery_status::find($new_shipping->delivery_status_id);
            $sub_delivery_status = SubStatus_delivery::find($new_shipping->sub_delivery_status_id);
            return response()->json([
                'fee_service' => $fee_service,
                'shipping_code' => $shipping_code,
                'delivery_status' => $delivery_status->name,
                'sub_delivery_status' => $sub_delivery_status->description_sub_status,
                'lastest_checkpoint_time' => $new_shipping->lastest_checkpoint_time
            ]);
        }catch (\Throwable $th) {
            return response()->json(['error' => "Hệ thống đang lỗi vui lòng thử lại sau!"], 400);
        }
    }
    public function GetShipping(Request $request)
    {
        $GetShipping = DB::table('shippings')->select('shippings.shipping_code', 'delivery_status.name as delivery_status_name', 'description_delivery', 'description_sub_status')
            ->where('shippings.shipping_code', '=', $request->code)
            ->join('delivery_status', 'delivery_status.id', '=', 'shippings.delivery_status_id')
            ->join('sub_status_deliveries', 'sub_status_deliveries.id', '=', 'shippings.sub_delivery_status_id')
            ->first();
        return response()->json($GetShipping);
    }
}
