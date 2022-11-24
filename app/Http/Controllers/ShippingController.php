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
    public function CreateShipping(Request $request)
    {
        // $validator = validator::make(
        //     $request->all(),
        //     [
        //         'name' => 'required',
        //         'phone' => 'required|numeric',
        //         'email' => 'required|email',
        //         'ship_from' => 'required',
        //         'ship_to' => 'required',
        //         'weight' => 'required',
        //         'height' => 'required',
        //         'note' => 'required',
        //     ]
        // );

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()]);
        // }

        // if(empty($request->ship_detail)){
        //     return response()->json(['errors' => 'empty package please check again']);
        // }

        try {
            $shipping_code = "PX" . date("YmdHis");
            $data = [
                'shipping_code' => $shipping_code,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' =>  $request->email,
                'ship_from' =>  $request->ship_from,
                'ship_to' =>  $request->ship_to,
                'weight' =>  $request->weight,
                'height' =>  $request->height,
                'delivery_status_id' => 4,
                'sub_delivery_status_id' => 61,
                'latest_change_status' => 61,
                'lastest_checkpoint_time' => Carbon::now(),
                'note' =>  $request->note,
            ];
            
            $new_shipping = shipping::create($data);

            // foreach ($request->ship_detail as $value) {
            //     $item = [
            //         "ship_id" => $new_shipping->id,
            //         "name" => $value['name'],
            //         "code" => $value['code'],
            //         "quantity" => $value['quantity'],
            //         "price" => $value['price']
            //     ];
            //     ship_detail::create($item);
            // }

            $delivery_status = delivery_status::find($new_shipping->delivery_status_id);
            $sub_delivery_status = SubStatus_delivery::find($new_shipping->sub_delivery_status_id);
            return response()->json([
                'shipping_code' => $shipping_code,
                'delivery_status' => $delivery_status->name,
                'sub_delivery_status' => $sub_delivery_status->description_sub_status,
                'lastest_checkpoint_time' => $new_shipping->lastest_checkpoint_time
            ]);
        } catch (\Throwable $th) {
            // return response()->json([
            //     'error' => true,
            //     'message' => 'abc'
            // ]);
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
