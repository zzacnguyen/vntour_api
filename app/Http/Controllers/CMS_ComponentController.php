<?php

/* Các function hiện có
    1.  _DISPLAY_LIST_ALL_USER : Hiển thị danh sách tất cả người dùng : 
    2.  -_DISPLAY_LIST_ADMIN_USER : Hiển thị danh sách người dùng admin : 
    3. _DISPLAY_LIST_MODERATOR_USER : Hiển thị danh sách người dùng vai trò moderator
    4. _DISPLAY_LIST_PARTNER : Hiển thị danh sách người dùng cộng tác viên 
    5. _DISPLAY_LIST_ENTERPRISE: Hiển thị người dùng doanh nghiệp
    6. _DISPLAY_LIST_PERSIONAL: Hiển thị người dùng cá nhân
    7. _DISPLAY_TOURIST_PLACES: Hiển thị danh sách địa điểm
    8. _DISPLAY_LIST_SERVICES: Hiển thị danh sách dịch vụ
    9. _DISPLAY_LIST_SERVICES_BY_PLACESID: hiển thị danh sách các dịch vụ thuộc 1 địa điểm
    10. _DISPLAY_LIST_SERVICES_BY_ENTERTAIMENTS: Hiển thị các dịch vụ thuộc loại hình vui   
            chơi giải trí
    11. _GET_VIEW_SERVICES_BY_ENTERTAIMENTS: Hiển thị gioa diện xem danh sách dịch vụ loại hình vui chơi giải trí
    12. _DISPLAY_TOURIST_PLACES_DETAILS: Hiển thị địa điểm chi tiết
    13. _DISPLAY_LIST_TOURGUIDE: Hiển thị danh sách người dùng hướng dẫn viên du lịch
    14. _DISPLAY_LIST_POINT : Hiển thị danh sách điểm






*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\pointModel;
use Illuminate\Database\Eloquent\Colection;
class CMS_ComponentController extends Controller
{
    public function _DISPLAY_LIST_ALL_USER()
    {
        $data = DB::table('vnt_user') 
		->select( DB::raw('DATE_FORMAT(vnt_user.created_at, "%d-%m-%Y") as created_at'),
            'username', 'contact_name','social_login_id', 'contact_phone', 'contact_website', 'contact_email_address'
        )
        ->leftJoin('vnt_contact_info', 'vnt_contact_info.user_id', '=', 'vnt_user.user_id')
		->orderBy('vnt_user.user_id', 'desc')
        ->paginate(4);
        // return $data;
        if (view()->exists('CMS.components.com_user.list_user')){
            return view('CMS.components.com_user.list_user', ['data'=>$data]);
            
        }
    	else	{
			return view('CMS.components.error');
		}
    }

    public function _DISPLAY_LIST_ADMIN_USER()
    {
        $data = DB::table('vnt_user') 
        ->select( DB::raw('DATE_FORMAT(vnt_user.created_at, "%d-%m-%Y") as created_at'),
            'vnt_user.user_id','username', 'contact_name','social_login_id', 'contact_phone', 'contact_website', 'contact_email_address'
        )
        ->join('vnt_admin_user', 'vnt_admin_user.user_id', '=', 'vnt_user.user_id')
        ->leftJoin('vnt_contact_info', 'vnt_contact_info.user_id', '=', 'vnt_user.user_id')
        ->orderBy('vnt_user.user_id', 'desc')
        ->paginate(4);
        // return $data;
        if (view()->exists('CMS.components.com_user.admin.list_admin')){
            return view('CMS.components.com_user.admin.list_admin', ['data'=>$data]);
        }
        else {
            return view('CMS.components.error');
        }
    }

    public function _DISPLAY_LIST_MODERATOR_USER()
    {
        $data = DB::table('vnt_user') 
        ->select( DB::raw('DATE_FORMAT(vnt_user.created_at, "%d-%m-%Y") as created_at'),
            'username', 'contact_name','social_login_id', 'contact_phone', 'contact_website', 'contact_email_address','vnt_moderator_users.account_active','vnt_user.user_id'
        )
        ->join('vnt_moderator_users', 'vnt_moderator_users.user_id', '=', 'vnt_user.user_id')
        ->leftJoin('vnt_contact_info', 'vnt_contact_info.user_id', '=', 'vnt_user.user_id')
        ->orderBy('vnt_user.user_id', 'desc')
        ->paginate(4);
        // return $data;
        if (view()->exists('CMS.components.com_user.moderator.list_mod')){
            return view('CMS.components.com_user.moderator.list_mod', ['data'=>$data]);
        }
        else {
            return view('CMS.components.error');
        }
    }


    public function _DISPLAY_LIST_WAITMOD_USER()
    {
        $data = DB::table('vnt_user') 
        ->select( DB::raw('DATE_FORMAT(vnt_user.created_at, "%d-%m-%Y") as created_at'),
            'username', 'contact_name','social_login_id', 'contact_phone', 'contact_website', 'contact_email_address'
        )
        ->join('vnt_moderator_users', 'vnt_moderator_users.user_id', '=', 'vnt_user.user_id')
        ->leftJoin('vnt_contact_info', 'vnt_contact_info.user_id', '=', 'vnt_user.user_id')
        ->where('vnt_moderator_users.account_active', '=', 0)
        ->orderBy('vnt_user.user_id', 'desc')
        ->paginate(4);
        // return $data;
        if (view()->exists('CMS.components.com_user.moderator.list_wait_mod.blade')){
            return view('CMS.components.com_user.moderator.list_wait_mod.blade', ['data'=>$data]);
        }
        else {
            return view('CMS.components.error');
        }
    }


    public function _DISPLAY_LIST_PARTNER()
    {
        $data = DB::table('vnt_user') 
        ->select( DB::raw('DATE_FORMAT(vnt_user.created_at, "%d-%m-%Y") as created_at'),
            'username', 'contact_name','social_login_id', 'contact_phone', 'contact_website', 'contact_email_address'
        )
        ->join('vnt_partner_user', 'vnt_partner_user.user_id', '=', 'vnt_user.user_id')
        ->leftJoin('vnt_contact_info', 'vnt_contact_info.user_id', '=', 'vnt_user.user_id')
        ->orderBy('vnt_user.user_id', 'desc')
        ->paginate(4);
        // return $data;
        if (view()->exists('CMS.components.com_user.partner.list')){
            return view('CMS.components.com_user.partner.list', ['data'=>$data]);
        }
        else {
            return view('CMS.components.error');
        }
    }

    
    public function _DISPLAY_LIST_ENTERPRISE()
    {
        $data = DB::table('vnt_user') 
        ->select( DB::raw('DATE_FORMAT(vnt_user.created_at, "%d-%m-%Y") as created_at'),
            'username','vnt_user.user_id'  ,'account_active'  ,'contact_name','social_login_id', 'contact_phone', 'contact_website', 'contact_email_address'
        )
        ->join('vnt_enterprise_user', 'vnt_enterprise_user.user_id', '=', 'vnt_user.user_id')
        ->leftJoin('vnt_contact_info', 'vnt_contact_info.user_id', '=', 'vnt_user.user_id')
        ->orderBy('vnt_user.user_id', 'desc')
        ->paginate(4);
        // return $data;
        if (view()->exists('CMS.components.com_user.enterprise.list_enterprise')){
            return view('CMS.components.com_user.enterprise.list_enterprise', ['data'=>$data]);
        }
        else {
            return view('CMS.components.error');
        }
    }


    //TÊN FUNCTION SAI CHÍNH TẢ 
    public function _DISPLAY_LIST_PERSIONAL()
    {
        $data = DB::table('vnt_user') 
        ->select( DB::raw('DATE_FORMAT(vnt_user.created_at, "%d-%m-%Y") as created_at'),
            'username', 'contact_name','social_login_id', 'contact_phone', 'contact_website', 'contact_email_address'
        )
        ->leftJoin('vnt_contact_info', 'vnt_contact_info.user_id', '=', 'vnt_user.user_id')
        ->orderBy('vnt_user.user_id', 'desc')
        ->paginate(4);
        // return $data;
        if (view()->exists('CMS.components.com_user.list_user')){
            return view('CMS.components.com_user.list_user', ['data'=>$data]);
        }
        else {
            return view('CMS.components.error');
        }
    }


    public function _DISPLAY_TOURIST_PLACES()
    {
        $data = DB::table('vnt_tourist_places') 
		->select( DB::raw('DATE_FORMAT(vnt_tourist_places.updated_at, "%d-%m-%Y") as updated_at'),
            'pl_name', 'pl_details','pl_address', 'pl_phone_number', 'pl_latitude', 'pl_longitude','pl_status', 'vnt_tourist_places.id'
        )       
        ->orderBy('vnt_tourist_places.id', 'desc')
        ->orderBy('vnt_tourist_places.updated_at', 'desc')
        ->paginate(15);
        // return $data;
        if (view()->exists('CMS.components.com_tourist_places.list_tourist_places'))
        {
            return view('CMS.components.com_tourist_places.list_tourist_places', ['data'=>$data]);
        }
    	else	{
			return view('CMS.components.error');
		}
		
    }

    public function _DISPLAY_TOURIST_PLACES_UNACTIVE()
    {
        $data = DB::table('vnt_tourist_places') 
        ->select( DB::raw('DATE_FORMAT(vnt_tourist_places.updated_at, "%d-%m-%Y") as updated_at'),
            'pl_name', 'pl_details','pl_address', 'pl_phone_number', 'pl_latitude', 'pl_longitude','pl_status', 'vnt_tourist_places.id'
        )       
        ->orderBy('vnt_tourist_places.id', 'desc')
        ->orderBy('vnt_tourist_places.updated_at', 'desc')
        ->where('pl_status', '=', '0')
        ->paginate(15);
        // return $data;
        if (view()->exists('CMS.components.com_tourist_places.list_touris_places_unactive'))
        {
            return view('CMS.components.com_tourist_places.list_touris_places_unactive', ['data'=>$data]);
        }
        else    {
            return view('CMS.components.error');
        }
        
    }

    public function _DISPLAY_LIST_SERVICES()
    {
        $data = DB::table('vnt_services') 
		->select( DB::raw('DATE_FORMAT(vnt_services.updated_at, "%d-%m-%Y") as updated_at'),
            'sv_description', 'sv_open','sv_close', 'sv_highest_price', 'sv_lowest_price',
             'sv_phone_number','sv_types', 'sv_website', 'vnt_hotels.hotel_name'
             , 'entertainments_name', 'sightseeing_name', 'transport_name', 'eat_name', 'sv_status','vnt_services.id'
        )     
        ->leftJoin('vnt_events', 'vnt_events.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_hotels', 'vnt_hotels.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_eating', 'vnt_eating.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_entertainments', 'vnt_entertainments.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_sightseeing', 'vnt_sightseeing.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_transport', 'vnt_transport.service_id', '=', 'vnt_services.id')
        ->where('vnt_services.sv_status', 1)
        ->orderBy('vnt_services.id', 'desc')
        ->orderBy('vnt_services.updated_at', 'desc')
        ->paginate(15);
        // return $data;
        if (view()->exists('CMS.components.com_services.list_services')){
            return view('CMS.components.com_services.list_services', ['data'=>$data]);
        }
    	else	{
			return view('CMS.components.error');
		}
    }


    public function _DISPLAY_LIST_SERVICES_BY_PLACESID($id)
    {
        $data = DB::table('vnt_services') 
        ->select( DB::raw('DATE_FORMAT(vnt_services.updated_at, "%d-%m-%Y") as updated_at'),
            'sv_description', 'sv_open','sv_close', 'sv_highest_price', 'sv_lowest_price',
             'sv_phone_number','sv_types', 'sv_website', 'vnt_hotels.hotel_name'
             , 'entertainments_name', 'sightseeing_name', 'transport_name', 'eat_name', 'sv_status', 'image_banner','vnt_services.id' 
        )
        ->join('vnt_tourist_places', 'vnt_tourist_places.id', '=', 'vnt_services.tourist_places_id')     
        ->leftJoin('vnt_events', 'vnt_events.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_hotels', 'vnt_hotels.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_eating', 'vnt_eating.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_entertainments', 'vnt_entertainments.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_sightseeing', 'vnt_sightseeing.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_images', 'vnt_images.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_transport', 'vnt_transport.service_id', '=', 'vnt_services.id')
        ->where('vnt_services.tourist_places_id', $id)
        ->orderBy('vnt_services.id', 'desc')
        ->orderBy('vnt_services.updated_at', 'desc')
        ->paginate(15);
        return $data;
        
    }


     public function _DISPLAY_LIST_SERVICES_BY_ENTERTAIMENTS()
    {
        $data = DB::table('vnt_services') 
        ->select( DB::raw('DATE_FORMAT(vnt_services.updated_at, "%d-%m-%Y") as updated_at'),
            'sv_description', 'sv_open','sv_close', 'sv_highest_price', 'sv_lowest_price',
             'sv_phone_number','sv_types', 'sv_website','entertainments_name','sv_status', 'image_banner','vnt_services.id' 
        )
        ->join('vnt_tourist_places', 'vnt_tourist_places.id', '=', 'vnt_services.tourist_places_id')     
        ->leftJoin('vnt_events', 'vnt_events.service_id', '=', 'vnt_services.id')
        ->join('vnt_entertainments', 'vnt_entertainments.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_images', 'vnt_images.service_id', '=', 'vnt_services.id')
        ->orderBy('vnt_services.id', 'desc')
        ->orderBy('vnt_services.updated_at', 'desc')
        ->paginate(15);
        return $data;
    }


    public function _DISPLAY_LIST_SERVICES_BY_FOODANDDRINK()
    {
        $data = DB::table('vnt_services') 
        ->select( DB::raw('DATE_FORMAT(vnt_services.updated_at, "%d-%m-%Y") as updated_at'),
            'sv_description', 'sv_open','sv_close', 'sv_highest_price', 'sv_lowest_price',
             'sv_phone_number','sv_types', 'sv_website','eat_name','sv_status', 'image_banner','vnt_services.id' 
        )
        ->join('vnt_tourist_places', 'vnt_tourist_places.id', '=', 'vnt_services.tourist_places_id')     
        ->leftJoin('vnt_events', 'vnt_events.service_id', '=', 'vnt_services.id')
        ->join('vnt_eating', 'vnt_eating.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_images', 'vnt_images.service_id', '=', 'vnt_services.id')
        ->orderBy('vnt_services.id', 'desc')
        ->orderBy('vnt_services.updated_at', 'desc')
        ->paginate(15);
        return $data;
    }

    public function _DISPLAY_LIST_SERVICES_BY_HOTEL()
    {
        $data = DB::table('vnt_services') 
        ->select( DB::raw('DATE_FORMAT(vnt_services.updated_at, "%d-%m-%Y") as updated_at'),
            'sv_description', 'sv_open','sv_close', 'sv_highest_price', 'sv_lowest_price',
             'sv_phone_number','sv_types', 'sv_website','hotel_name','sv_status', 'image_banner','vnt_services.id' 
        )
        ->join('vnt_tourist_places', 'vnt_tourist_places.id', '=', 'vnt_services.tourist_places_id')     
        ->leftJoin('vnt_events', 'vnt_events.service_id', '=', 'vnt_services.id')
        ->join('vnt_hotels', 'vnt_hotels.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_images', 'vnt_images.service_id', '=', 'vnt_services.id')
        ->orderBy('vnt_services.id', 'desc')
        ->orderBy('vnt_services.updated_at', 'desc')
        ->paginate(15);
        return $data;
    }

    public function _DISPLAY_LIST_SERVICES_BY_SIGHTSEEING()
    {
        $data = DB::table('vnt_services') 
        ->select( DB::raw('DATE_FORMAT(vnt_services.updated_at, "%d-%m-%Y") as updated_at'),
            'sv_description', 'sv_open','sv_close', 'sv_highest_price', 'sv_lowest_price',
             'sv_phone_number','sv_types', 'sv_website','sightseeing_name','sv_status', 'image_banner','vnt_services.id' 
        )
        ->join('vnt_tourist_places', 'vnt_tourist_places.id', '=', 'vnt_services.tourist_places_id')     
        ->leftJoin('vnt_events', 'vnt_events.service_id', '=', 'vnt_services.id')
        ->join('vnt_sightseeing', 'vnt_sightseeing.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_images', 'vnt_images.service_id', '=', 'vnt_services.id')
        ->orderBy('vnt_services.id', 'desc')
        ->orderBy('vnt_services.updated_at', 'desc')
        ->paginate(15);
        return $data;
    }



    public function _DISPLAY_LIST_SERVICES_BY_TRANSPORT()
    {
        $data = DB::table('vnt_services') 
        ->select( DB::raw('DATE_FORMAT(vnt_services.updated_at, "%d-%m-%Y") as updated_at'),
            'sv_description', 'sv_open','sv_close', 'sv_highest_price', 'sv_lowest_price',
             'sv_phone_number','sv_types', 'sv_website','transport_name','sv_status', 'image_banner','vnt_services.id' 
        )
        ->join('vnt_tourist_places', 'vnt_tourist_places.id', '=', 'vnt_services.tourist_places_id')     
        ->leftJoin('vnt_events', 'vnt_events.service_id', '=', 'vnt_services.id')
        ->join('vnt_transport', 'vnt_transport.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_images', 'vnt_images.service_id', '=', 'vnt_services.id')
        ->orderBy('vnt_services.id', 'desc')
        ->orderBy('vnt_services.updated_at', 'desc')
        ->paginate(15);
        return $data;
    }

    public function _GET_VIEW_LIST_SERVICES_BY_ENTERTAIMENTS()
    {
        $data  = $this::_DISPLAY_LIST_SERVICES_BY_ENTERTAIMENTS();
        return view('CMS.components.com_services.list_servicesEntertainments',
        ['data'=>$data]);
    }

    public function _GET_VIEW_LIST_SERVICES_BY_FOODANDDRINK()
    {
        $data  = $this::_DISPLAY_LIST_SERVICES_BY_FOODANDDRINK();
        return view('CMS.components.com_services.list_servicesFoodAndDrink',
        ['data'=>$data]);
    }

    public function _GET_VIEW_LIST_SERVICES_BY_HOTEL()
    {
        $data  = $this::_DISPLAY_LIST_SERVICES_BY_HOTEL();
        return view('CMS.components.com_services.list_servicesHotels',
        ['data'=>$data]);
    }
    public function _GET_VIEW_LIST_SERVICES_BY_SIGHTSEEING()
    {
        $data  = $this::_DISPLAY_LIST_SERVICES_BY_SIGHTSEEING();
        return view('CMS.components.com_services.list_servicesSightseeing',
        ['data'=>$data]);
    }

    public function _GET_VIEW_LIST_SERVICES_BY_TRANSPORT()
    {
        $data  = $this::_DISPLAY_LIST_SERVICES_BY_TRANSPORT();
        return view('CMS.components.com_services.list_servicesTransport',
        ['data'=>$data]);
    }

    public function _DISPLAY_TOURIST_PLACES_DETAILS($id)
    {
         $data = DB::table('vnt_tourist_places') 
        ->select( DB::raw('DATE_FORMAT(vnt_tourist_places.updated_at, "%d-%m-%Y") as updated_at'), DB::raw('DATE_FORMAT(vnt_tourist_places.created_at, "%d-%m-%Y") as created_at'),
            'pl_name', 'pl_details','pl_address', 'pl_phone_number', 'pl_latitude', 'pl_longitude','pl_status', 'vnt_tourist_places.id','province_city_name','district_name','ward_name' 

        )
        ->leftJoin('vnt_tour_guide', 'vnt_tourist_places.user_tour_guide_id', '=', 'vnt_tour_guide.user_id')
        ->leftJoin('vnt_partner_user', 'vnt_tourist_places.user_partner_id', '=', 'vnt_partner_user.user_id')
        ->join('vnt_ward', 'vnt_tourist_places.id_ward', '=', 'vnt_ward.id')
        ->join('vnt_district', 'vnt_district.id', '=', 'vnt_ward.district_id')
        ->join('vnt_province_city', 'vnt_province_city.id', '=', 'vnt_district.province_city_id')
        ->where('vnt_tourist_places.id', $id)
        ->get();
        return $data;
    }

    public function _GET_VIEW_PLACES_DETAILS($id)
    {
        $service =  $this::_DISPLAY_LIST_SERVICES_BY_PLACESID($id);
        $place =  $this::_DISPLAY_TOURIST_PLACES_DETAILS($id);
        return view('CMS.components.com_tourist_places.tourist_places_details', ['data1'=>$service, 'data2'=>$place]);
    }



    public function _DISPLAY_LIST_TOURGUIDE()
    {
        $data = DB::table('vnt_user') 
        ->select( DB::raw('DATE_FORMAT(vnt_user.created_at, "%d-%m-%Y") as created_at'),
            'vnt_tour_guide.user_id', 'username', 'contact_name','social_login_id', 'contact_phone', 'contact_website', 'contact_email_address','account_active'
        )
        ->join('vnt_tour_guide', 'vnt_tour_guide.user_id', '=', 'vnt_user.user_id')
        ->leftJoin('vnt_contact_info', 'vnt_contact_info.user_id', '=', 'vnt_user.user_id')
        ->orderBy('vnt_user.user_id', 'desc')
        ->paginate(4);
        // return $data;
        if (view()->exists('CMS.components.com_user.tour_guide.list_tourguide')){
            return view('CMS.components.com_user.tour_guide.list_tourguide', ['data'=>$data]);
        }
        else {
            return view('CMS.components.error');
        }
    }



    public function _DISPLAY_LIST_POINT()
    {
        $data =  DB::table('vnt_point')
        ->select('vnt_point.id', 'vnt_point.point_title', 'point_description', 
            'point_rate', 'point_date')
        ->orderBy('vnt_point.point_title', 'DESC' )
        ->paginate('10');
        if(view()->exists('CMS.components.com_point.list_point')){
            return view('CMS.components.com_point.list_point', ['data'=>$data]);
        }
        else {
            return view('CMS.components.error');
        }
    }
    public function _GETVIEW_USAGE_MANUAL()
    {
        if(view()->exists('CMS.components.usage_manual.list')){
            return view('CMS.components.usage_manual.list');
        }
        else {
            return view('CMS.components.error');
        }
    }
    public function LIST_UNACTICE_SERVICES()
    {
        $data = DB::table('vnt_services') 
        ->select( DB::raw('DATE_FORMAT(vnt_services.updated_at, "%d-%m-%Y") as updated_at'),
            'sv_description', 'sv_open','sv_close', 'sv_highest_price', 'sv_lowest_price',
             'sv_phone_number','sv_types', 'sv_website', 'vnt_hotels.hotel_name'
             , 'entertainments_name', 'sightseeing_name', 'transport_name', 'eat_name', 'sv_status', 'vnt_services.id'
        )     
        ->leftJoin('vnt_events', 'vnt_events.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_hotels', 'vnt_hotels.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_eating', 'vnt_eating.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_entertainments', 'vnt_entertainments.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_sightseeing', 'vnt_sightseeing.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_transport', 'vnt_transport.service_id', '=', 'vnt_services.id')
        ->where('vnt_services.sv_status', 0)
        ->orderBy('vnt_services.id', 'desc')
        ->orderBy('vnt_services.updated_at', 'desc')
        ->paginate(15);
        // return $data;
        if (view()->exists('CMS.components.com_services.list_services_waiting')){
            return view('CMS.components.com_services.list_services_waiting', ['data'=>$data]);
        }
        else    {
            return view('CMS.components.error');
        }
    }
    public function LIST_SPAM_SERVICES()
    {
        $data = DB::table('vnt_services') 
        ->select( DB::raw('DATE_FORMAT(vnt_services.updated_at, "%d-%m-%Y") as updated_at'),
            'sv_description', 'sv_open','sv_close', 'sv_highest_price', 'sv_lowest_price',
             'sv_phone_number','sv_types', 'sv_website', 'vnt_hotels.hotel_name'
             , 'entertainments_name', 'sightseeing_name', 'transport_name', 'eat_name', 'sv_status', 'vnt_services.id'
        )     
        ->leftJoin('vnt_events', 'vnt_events.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_hotels', 'vnt_hotels.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_eating', 'vnt_eating.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_entertainments', 'vnt_entertainments.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_sightseeing', 'vnt_sightseeing.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_transport', 'vnt_transport.service_id', '=', 'vnt_services.id')
        ->where('vnt_services.sv_status', -1)
        ->orderBy('vnt_services.id', 'desc')
        ->orderBy('vnt_services.updated_at', 'desc')
        ->paginate(15);
        // return $data;
        if (view()->exists('CMS.components.com_services.list_spam_services')){
            return view('CMS.components.com_services.list_spam_services', ['data'=>$data]);
        }
        else    {
            return view('CMS.components.error');
        }
    }

    public function _SERVICE_DETAILS($id)
    {
        $service = DB::table('vnt_services')
        ->select(
            'vnt_services.id as service_id',
            'hotel_name', 
            'sightseeing_name', 
            'entertainments_name', 
            'transport_name', 
            'eat_name', 
            'sv_website', 
            'sv_description',
            'sv_content',
            'sv_open', 
            'sv_types',
            'sv_close', 
            'sv_lowest_price', 
            'sv_highest_price', 
            'pl_phone_number', 
            'pl_address', 
            DB::raw('AVG(vnt_visitor_ratings.vr_rating) as rating'), 
            'pl_latitude', 
            'pl_longitude',
            'pl_name',
            'sv_status'
            // 'vnt_transport.id as id_transport' ,
            // 'vnt_eating.id as id_eating' ,
            // 'vnt_hotels.id as id_hotel',
            // 'vnt_sightseeing.id as id_sightseeing',
            // 'vnt_entertainments.id as id_entertainment'

        )
        ->leftJoin('vnt_events', 'vnt_events.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_hotels', 'vnt_hotels.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_eating', 'vnt_eating.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_entertainments', 'vnt_entertainments.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_sightseeing', 'vnt_sightseeing.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_transport', 'vnt_transport.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_tourist_places', 'vnt_tourist_places.id', '=', 'vnt_services.tourist_places_id')
        ->leftjoin('vnt_visitor_ratings', 'vnt_visitor_ratings.service_id','=', 'vnt_services.id')
        ->where('vnt_services.id', $id)
        ->groupBy('vnt_services.id','hotel_name','entertainments_name','transport_name', 'sightseeing_name', 
                 'eat_name', 'sv_website', 'sv_description', 'sv_open','sv_close','sv_lowest_price','sv_highest_price', 'vnt_tourist_places.pl_phone_number',
                 'vnt_tourist_places.pl_address', 'vnt_tourist_places.pl_latitude', 'vnt_tourist_places.pl_longitude','pl_name','sv_status',
                 'sv_description',
            'sv_content','sv_types'
             )
        
        ->get();
        return view('CMS.components.com_services.service_details',['data_service'=>$service]);
    }


    public function _PLACES_DETAILS($id)
    {
        $data = DB::table('vnt_tourist_places')
        ->select('id','pl_name', 'pl_details', 'pl_content', 'pl_address', 'pl_phone_number', 'pl_latitude'
        ,'pl_longitude', 'pl_status', 'id_ward')
        ->where('id', '=', $id)
        ->get();
        $data2 = DB::table('vnt_services') 
        ->select('vnt_services.id as service_id' ,'sv_types', 'sv_website', 'vnt_hotels.hotel_name'
             , 'entertainments_name', 'sightseeing_name', 'transport_name', 'eat_name', 'sv_status', 'vnt_services.id'
        )     
        ->leftJoin('vnt_events', 'vnt_events.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_hotels', 'vnt_hotels.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_eating', 'vnt_eating.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_entertainments', 'vnt_entertainments.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_sightseeing', 'vnt_sightseeing.service_id', '=', 'vnt_services.id')
        ->leftJoin('vnt_transport', 'vnt_transport.service_id', '=', 'vnt_services.id')
        ->orderBy('vnt_services.id', 'desc')
        ->orderBy('vnt_services.updated_at', 'desc')
        ->where('vnt_services.tourist_places_id', '=',$id)
        ->paginate(10);

        return view('CMS.components.com_tourist_places.tourist_places_details',['data_places'=>$data,
            'data_services'=>$data2]);
    }

    public function login_admin()
    {
        return view('CMS.components.login.login');
    }

}
