<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\touristPlacesModel;
use App\servicesModel;
use App\imagesModel;
use App\eatingModel;
use App\sightseeingModel;
use App\transportModel;
use App\hotelsModel;
use Illuminate\Support\Facades\DB;

class tourist_places_controller extends Controller
{


	//function get id last insert places - ĐÃ TEST
	function GetIDLast($table)
	{
		$lastId = $table->orderBy('id', 'desc')->first();
        $convert = (array)$lastId;
        $id = $convert['id'];
        return $id;		
	}

    public function AddPlace(Request $request)
	{
        $select_old_latitude_logitude = DB::table('vnt_tourist_places')
        ->select('id','pl_latitude', 'pl_longitude')
        ->get();
        foreach ($select_old_latitude_logitude as $value) {
            $tmp_latitude = $value->pl_latitude;
            $tmp_longitude = $value->pl_longitude;
            $tmp_id = $value->id;
            if($request->input('pl_latitude') == $tmp_latitude && $request->input('pl_longitude') == $tmp_longitude )
            {
                touristPlacesModel::where('id',$tmp_id)
                ->update(['pl_status'=>2]);
                servicesModel::where('tourist_places_id', $tmp_id)
                ->update(['sv_status'=>2]);
            }
        }
        $place                  = new touristPlacesModel;
        $place->pl_name         = $request->pl_name;
        $place->pl_details      = $request->input('pl_details');
        $place->pl_address      = $request->input('pl_address');
        $place->pl_phone_number = $request->input('pl_phone_number');
        $place->pl_latitude     = $request->input('pl_latitude');
        $place->pl_longitude    = $request->input('pl_longitude');
        $place->id_ward    = $request->input('id_ward');
        $place->pl_status       = 0;
        $place->user_id   = $request->input('user_id');
        $place->pl_content   = "_";
        if($place->save()){
            $id_place = $this::GetIDLast(DB::table('vnt_tourist_places'));
            return json_encode("id_place:".$id_place);
        } else {
            return json_encode("status:500");
        }
	}
    public function AddServices(Request $request, $id_place)
    {
        $vnt_services                 = new servicesModel;
        $vnt_services->sv_description   = $request->input('sv_description');
        $vnt_services->sv_open    = $request->input('sv_open');
        $vnt_services->sv_close  = $request->input('sv_close');
        $vnt_services->sv_highest_price  = $request->input('sv_highest_price');
        $vnt_services->sv_lowest_price = $request->input('sv_lowest_price');
        $vnt_services->sv_phone_number   = $request->input('sv_phone_number');
        $vnt_services->sv_status   = 0;
        $vnt_services->sv_types   = $request->input('sv_types');
        $vnt_services->tourist_places_id   =$id_place;
        $vnt_services->sv_counter_view=0;
        $vnt_services->sv_counter_point=0;
        $vnt_services->user_id= $request->input('user_id');
        $vnt_services->sv_content = "Đang cập nhật";
        $vnt_services->sv_website = $request->input('sv_website');
        $vnt_services->save();
        $id_service = $this::GetIDLast(DB::table('vnt_services'));

        if($vnt_services->sv_types == "1")
        {
            $vnt_eating = new eatingModel;
            $vnt_eating->eat_name =  $request->input('eat_name');
            $vnt_eating->eat_status =  1;
            $vnt_eating->service_id =  $id_service;
            if($vnt_eating->save()){
                return json_encode("id_service:".$id_service);
            }
            else
            {
                return json_encode("status:500");
            }

        }
        else if($vnt_services->sv_types == "2")
        {
            $vnt_hotels = new hotelsModel;
            $vnt_hotels->hotel_name =  $request->input('hotel_name');
            $vnt_hotels->hotel_number_star =  $request->input('hotel_number_star');
            $vnt_hotels->hotel_status =  1;
            $vnt_hotels->service_id =  $id_service;
            if($vnt_hotels->save()){
                return json_encode("id_service:".$id_service);
            }
            else
            {
                return json_encode("status:500");
            }
        }
        else if($vnt_services->sv_types == "3")
        {
            $vnt_transport = new transportModel;
            $vnt_transport->transport_name =  $request->input('transport_name');
            $vnt_transport->transport_status =  1;
            $vnt_transport->service_id =  $id_service;
            if($vnt_transport->save()){
                return json_encode("id_service:".$id_service);
            }
            else
            {
                return json_encode("status:500");
            }
        }
        else if($vnt_services->sv_types == "4")
        {
            $vnt_sightseeing = new sightseeingModel;
            $vnt_sightseeing->sightseeing_name =  $request->input('sightseeing_name');
            $vnt_sightseeing->sightseeing_status     =  1;
            $vnt_sightseeing->service_id =  $id_service;
            if($vnt_sightseeing->save()){
                return json_encode("id_service:".$id_service);
            }
            else
            {
                return json_encode("status:500");
            }
        }
        else if($vnt_services->sv_types == "5")
        {
            $vnt_entertainments = new entertainmentsModel;
            $vnt_entertainments-> $request->input('entertainments_name');
            $vnt_entertainments->entertainments_status       = 1;
            $vnt_entertainments->service_id =  $id_service;
            if($vnt_entertainments->save()){
                return json_encode("id_service:".$id_service);
            }
            else
            {
                return json_encode("status:500");
            }
        }        
    }

    public function GetNamePlace($id)
    {
        $service = DB::table('vnt_services')
        ->select('vnt_services.id','hotel_name','sightseeing_name','entertainments_name', 'transport_name',                  'eat_name')         
        ->leftJoin('vnt_events', 'vnt_events.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_hotels', 'vnt_hotels.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_eating', 'vnt_eating.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_entertainments', 'vnt_entertainments.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_sightseeing', 'vnt_sightseeing.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_transport', 'vnt_transport.service_id', '=', 'vnt_services.id')  
        ->where('vnt_services.id', $id)
        ->groupBy('vnt_services.id','hotel_name','entertainments_name','transport_name', 'sightseeing_name','eat_name')
        ->get();
        return json_encode($service);
    }

    public function GetWardList()
    {
        $ward_id =  DB::table('vnt_ward')
        ->select('vnt_ward.id','ward_name')
        ->paginate(10);
        return json_encode($ward_id);
    }

    public function GetWardListByID($id)
    {
        $ward_id =  DB::table('vnt_ward')
        ->select('vnt_ward.id','ward_name')
        ->where('vnt_ward.district_id', '=', $id)
        ->get();
        return json_encode($ward_id);
    }
    public function GetDisTrictListByID($id)
    {
        $DisTrict =  DB::table('vnt_district')
        ->select('vnt_district.id','district_name')
        ->where('vnt_district.province_city_id', '=', $id)
        ->get();
        return json_encode($DisTrict);
    }
    public function GetProvinceCity()
    {
        $DisTrict =  DB::table('vnt_province_city')
        ->select('vnt_province_city.id','province_city_name')
        ->get();
        return json_encode($DisTrict);
    }

    public function getƯ($value='')
    {
        # code...
    }
}
