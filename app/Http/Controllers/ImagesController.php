<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Image;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\imagesModel;
use App\contact_infoModel;
use File;
use DateTime;
use App\handler;
use App\servicesModel;



class ImagesController extends Controller
{
    public function getIcon($service_id)
    {
        $url  = 'public/icons/';
        $string_replace = '","id":';
        $icon_image = DB::table('vnt_images') 
        ->select('image_details_1','id')
        ->where('service_id', $service_id)->get();
        $string_cutting_icons = $icon_image;
        $string_cutted_icons = substr ( $string_cutting_icons ,21);
        $arr[]= (explode ('","' , $string_cutted_icons));
        $image_name = ($arr[0][0]);
        $cutting_right= rtrim($string_cutted_icons, '"}]');
        $result =  str_replace($string_replace , '+', $cutting_right);
        $url_image = $url.$result.'+'.$image_name;
        return json_encode($url_image, JSON_UNESCAPED_SLASHES);
    }


    public function getBanner($service_id)
    {
        $url  = 'public/banners/';
        $string_replace = '","id":';
        $icon_image = DB::table('vnt_images') 
        ->select('image_banner','id')
        ->where('service_id', $service_id)
        ->where('image_status',1)
        ->get();
        //echo $icon_image;
        $string_cutting_icons = $icon_image;
        $string_cutted_icons = substr ( $string_cutting_icons ,18);
        $arr[]= (explode ('","' , $string_cutted_icons));
        $image_name = ($arr[0][0]);
        $cutting_right= rtrim($string_cutted_icons, '"}]');
        $result =  str_replace($string_replace , '+', $cutting_right);
        $url_image = $url.$result.'+'.$image_name;
        return json_encode($url_image, JSON_UNESCAPED_SLASHES);
    }

    public function getThumbnail1($service_id)
    {
        $url  = 'public/thumbnails/';
        $string_replace = '","id":';
        $thumb_image = DB::table('vnt_images') ->select('image_details_1','id')
        ->where('service_id', $service_id)->get();
        $string_cutting_icons = $thumb_image;
        $string_cutted_icons = substr ( $string_cutting_icons ,21);
        $arr[]= (explode ('","' , $string_cutted_icons));
        $image_name = ($arr[0][0]);
        $cutting_right= rtrim($string_cutted_icons, '"}]');
        $result =  str_replace($string_replace , '+', $cutting_right);
        $url_image = $url.$result.'+'.$image_name;
        return json_encode($url_image, JSON_UNESCAPED_SLASHES);
    }
    public function getThumbnail2($service_id)
    {
        $url  = 'public/thumbnails/';
        $string_replace = '","id":';
        $thumb_image = DB::table('vnt_images') ->select('image_details_2','id')
        ->where('service_id', $service_id)->get();
        $string_cutting_icons = $thumb_image;
        $string_cutted_icons = substr ( $string_cutting_icons ,21);
        $arr[]= (explode ('","' , $string_cutted_icons));
        $image_name = ($arr[0][0]);
        $cutting_right= rtrim($string_cutted_icons, '"}]');
        $result =  str_replace($string_replace , '+', $cutting_right);
        $url_image = $url.$result.'+'.$image_name;
        return json_encode($url_image, JSON_UNESCAPED_SLASHES);
    }
    public function getImageDetail1($service_id)
    {
        $url  = 'public/details1/';
        $string_replace = '","id":';
        $image_detail = DB::table('vnt_images') 
        ->select('image_details_1','id')
        ->where('service_id', $service_id)->get();
        $string_cutting_details = $image_detail;
        $string_cutted_details = substr ( $string_cutting_details ,21);
        $arr[]= (explode ('","' , $string_cutted_details));
        $image_name = ($arr[0][0]);
        $cutting_right= rtrim($string_cutted_details, '"}]');
        $result =  str_replace($string_replace , '+', $cutting_right);
        $url_image = $url.$result.'+'.$image_name;
        return json_encode($url_image, JSON_UNESCAPED_SLASHES);
    }
    public function getImageDetail2($service_id)
    {
        $url  = 'public/details2/';
        $string_replace = '","id":';
        $image_detail = DB::table('vnt_images') 
        ->select('image_details_2','id')
        ->where('service_id', $service_id)->get();
        $string_cutting_details = $image_detail;
        $string_cutted_details = substr ( $string_cutting_details ,21);
        $arr[]= (explode ('","' , $string_cutted_details));
        $image_name = ($arr[0][0]);
        $cutting_right= rtrim($string_cutted_details, '"}]');
        $result =  str_replace($string_replace , '+', $cutting_right);
        $url_image = $url.$result.'+'.$image_name;
        return json_encode($url_image, JSON_UNESCAPED_SLASHES);
    }


    public function Upload(Request $request, $id_service)
    {
        // return $request->all();
        $date = date("Y_m_d");
        $timedate = date("h_i_s");
        $time = '_'.$date.'_'.$timedate;
        
        $path_banner = public_path().'/banners/';
        $path_details1 = public_path().'/details1/';
        $path_details2 = public_path().'/details2/';
        $path_icon = public_path().'/icons/';
        $path_thumb = public_path().'/thumbnails/';

        // $path_banner = '../../upload/img/banners/';
        // $path_details1 = '../../upload/img/details1/';
        // $path_details2 ='../../upload/img/details2/';
        // $path_icon = '../../upload/img/icons/';
        // $path_thumb = '../../upload/img/thumbnails/';

        //upload banner
        $file_banner = $request->file('banner');
        $image_banner = \Image::make($file_banner);
     
        $image_banner->resize(768,720);
        $image_banner->save($path_banner.'banner_'.$time.'.'.$file_banner->getClientOriginalExtension());
        $image_banner->resize(600,400);
        $image_banner->save($path_thumb.'banner_'.$time.'.'.$file_banner->getClientOriginalExtension());
        $image_banner->resize(50,50);
        $image_banner->save($path_icon.'banner_'.$time.'.'.$file_banner->getClientOriginalExtension());
        

        //upload chi tiet 1
        $file_details_1 = $request->file('details1');
        $image_details1 = \Image::make($file_details_1);
        $image_details1->resize(1280,720);
        $image_details1->save($path_details1.'details1_'.$time.'.'.$file_details_1->getClientOriginalExtension());
        $image_details1->resize(600,400);
        $image_details1->save($path_thumb.'details1_'.$time.'.'.$file_details_1->getClientOriginalExtension());
        $image_details1->resize(50,50);
        $image_details1->save($path_icon.'details1_'.$time.'.'.$file_details_1->getClientOriginalExtension());
        

        //upload chi tiet 2
        $file_details_2 = $request->file('details2');
        $image_details2 = \Image::make($file_details_2);
        $image_details2->resize(1280,720);
        $image_details2->save($path_details2.'details2_'.$time.'.'.$file_details_2->getClientOriginalExtension());
        $image_details2->resize(600,400);
        $image_details2->save($path_thumb.'details2_'.$time.'.'.$file_details_2->getClientOriginalExtension());
        $image_details2->resize(50,50);
        $image_details2->save($path_icon.'details2_'.$time.'.'.$file_details_2->getClientOriginalExtension());
                 

       // create images in model
        $thumbnail = new imagesModel();
        $thumbnail->image_banner = "banner_".$time.'.'.$file_banner->getClientOriginalExtension();
        $thumbnail->image_details_1 ="details1_".$time.'.'.$file_details_1->getClientOriginalExtension();
        $thumbnail->image_details_2 = "details2_".$time.'.'.$file_details_2->getClientOriginalExtension();
        $thumbnail->image_status =1;
        $thumbnail->service_id=$id_service;
        $thumbnail->save();
        return json_encode("status:200");
        
    } 

    public function EditImage(Request $request,$id)
    {

        $image_old = DB::table('vnt_images')
        ->where('id', '=', $id)
        ->select('image_banner', 'image_details_1', 'image_details_2')
        ->get();
        $name_old_banner = $image_old[0]->image_banner;
        $name_old_image_details_1 = $image_old[0]->image_details_1;
        $name_old_image_details_2 = $image_old[0]->image_details_2;
        // return $name_old_banner;
        
        $date = date("Y_m_d");
        $timedate = date("h_i_s");
        $time = '_'.$date.'_'.$timedate;

        
        $path_details1 = public_path().'\\details1\\';
        $path_details2 = public_path().'\\details2\\';
        $path_icon = public_path().'\\icons\\';
        $path_thumb = public_path().'\\thumbnails\\';
        $path_banner = public_path().'\\banners\\';

        //upload banner
        $file_banner = $request->file('banner');
        $file_details_1 = $request->file('details1');
        $file_details_2 = $request->file('details2');

        if(!empty($file_banner) || !empty($file_details_1) || !empty($file_details_2))
        {
            if(!empty($file_banner))
                {
                    $image_path_banner = $path_banner.$name_old_banner;
                    $image_path_thumb_banner = $path_thumb.$name_old_banner;
                    $image_path_icon_banner = $path_icon.$name_old_banner;
                    if(File::exists($image_path_banner)) {
                        File::delete($image_path_banner);
                        File::delete($image_path_thumb_banner);
                        File::delete($image_path_icon_banner);
                    }
                    $image_banner = \Image::make($file_banner);
                    $name_banner = "banner_".$time.'.'.$file_banner->getClientOriginalExtension();
                    $image_banner->resize(768,720);
                    $image_banner->save($path_banner.$name_banner);
                    $image_banner->resize(600,400);
                    $image_banner->save($path_thumb.$name_banner);
                    $image_banner->resize(50,50);
                    $image_banner->save($path_icon.$name_banner);
                    $name_banner = "banner_".$time.'.'.$file_banner->getClientOriginalExtension();
                    imagesModel::where('id',$id)
                        ->update(['image_banner'=>$name_banner]);
                }
            if(!empty($file_details_1))
                {
                    $image_path_details_1 = $path_details1.$name_old_image_details_1;
                    $image_path_thumb_details_1 = $path_thumb.$name_old_image_details_1;
                    $image_path_icon_details_1 = $path_icon.$name_old_image_details_1;
                    if(File::exists($image_path_details_1)) {
                        File::delete($image_path_details_1);
                        File::delete($image_path_thumb_details_1);
                        File::delete($image_path_icon_details_1);
                    }
                    $name_details_1 = "details1_".$time.'.'.$file_details_1->getClientOriginalExtension();
                    $image_details1 = \Image::make($file_details_1);
                    $image_details1->resize(1280,720);
                    $image_details1->save($path_details1.$name_details_1);
                    $image_details1->resize(600,400);
                    $image_details1->save($path_thumb.$name_details_1);
                    $image_details1->resize(50,50);
                    $image_details1->save($path_icon.$name_details_1);
                    imagesModel::where('id',$id)

                        ->update(['image_details_1'=>$name_details_1]);
                }
            if(!empty($file_details_2))
                {
                    $image_path_details_2 = $path_details1.$name_old_image_details_2;
                    $image_path_thumb_details_2 = $path_thumb.$name_old_image_details_2;
                    $image_path_icon_details_2 = $path_icon.$name_old_image_details_2;
                    if(File::exists($image_path_details_2)) {
                        File::delete($image_path_details_2);
                        File::delete($image_path_thumb_details_2);
                        File::delete($image_path_icon_details_2);
                    }
                    $name_details_2 = "details2_".$time.'.'.$file_details_2->getClientOriginalExtension();
                    $image_details2 = \Image::make($file_details_2);
                    $image_details2->resize(1280,720);
                    $image_details2->save($path_details2.$name_details_2);
                    $image_details2->resize(600,400);
                    $image_details2->save($path_thumb.$name_details_2);
                    $image_details2->resize(50,50);
                    $image_details2->save($path_icon.$name_details_2);
                    imagesModel::where('id',$id)
                        ->update(['image_details_2'=>$name_details_2]);

                }
            return json_encode("status:200");
        }
        else
        {
            return json_encode("status:500");   
        }
    }

    public function EditImage_web($id, Request $request)
    {
        // return $request->banner;
        // return $request->details1;
        // return $request->details2;
        $image_old = DB::table('vnt_images')
        ->where('service_id', '=', $id)
        ->select('image_banner', 'image_details_1', 'image_details_2')
        ->first();
        // return $image_old;
        if ($image_old == null) {
            // return 'toiday';
            $img_ = new imagesModel();
            $img_->image_banner = '';
            $img_->image_details_1 = '';
            $img_->image_details_2 = '';
            $img_->image_status = '';
            $img_->service_id = $id;
            $img_->save();
                $image_old = DB::table('vnt_images')
            ->where('service_id', '=', $id)
            ->select('image_banner', 'image_details_1', 'image_details_2')
            ->get();
        }
        // return 'toiday';
        $name_old_banner = $image_old->image_banner;
        $name_old_image_details_1 = $image_old->image_details_1;
        $name_old_image_details_2 = $image_old->image_details_2;
        // return $name_old_banner;
        
        $date = date("Y_m_d");
        $timedate = date("h_i_s");
        $time = '_'.$date.'_'.$timedate;

        
        $path_details1 = public_path().'\\details1\\';
        $path_details2 = public_path().'\\details2\\';
        $path_icon = public_path().'\\icons\\';
        $path_thumb = public_path().'\\thumbnails\\';
        $path_banner = public_path().'\\banners\\';

        //upload banner
        $file_banner = $request->file('details1');
        $file_details_1 = $request->file('banner') ;
        $file_details_2 = $request->file('details2');

        if(!empty($file_banner))
            {
                // return 'toiday';
                $image_path_banner = $path_banner.$name_old_banner;
                $image_path_thumb_banner = $path_thumb.$name_old_banner;
                $image_path_icon_banner = $path_icon.$name_old_banner;
                if(File::exists($image_path_banner)) {
                    File::delete($image_path_banner);
                    File::delete($image_path_thumb_banner);
                    File::delete($image_path_icon_banner);
                }
                $image_banner = \Image::make($file_banner);
                $name_banner = "banner_".$time.'.'.$file_banner->getClientOriginalExtension();
                $image_banner->resize(768,720);
                $image_banner->save($path_banner.$name_banner);
                $image_banner->resize(600,400);
                $image_banner->save($path_thumb.$name_banner);
                $image_banner->resize(50,50);
                $image_banner->save($path_icon.$name_banner);
                $name_banner = "banner_".$time.'.'.$file_banner->getClientOriginalExtension();
                imagesModel::where('service_id',$id)
                    ->update(['image_banner'=>$name_banner]);
            }
        if(!empty($file_details_1))
            {
                $image_path_details_1 = $path_details1.$name_old_image_details_1;
                $image_path_thumb_details_1 = $path_thumb.$name_old_image_details_1;
                $image_path_icon_details_1 = $path_icon.$name_old_image_details_1;
                if(File::exists($image_path_details_1)) {
                    File::delete($image_path_details_1);
                    File::delete($image_path_thumb_details_1);
                    File::delete($image_path_icon_details_1);
                }
                $name_details_1 = "details1_".$time.'.'.$file_details_1->getClientOriginalExtension();
                $image_details1 = \Image::make($file_details_1);
                $image_details1->resize(1280,720);
                $image_details1->save($path_details1.$name_details_1);
                $image_details1->resize(600,400);
                $image_details1->save($path_thumb.$name_details_1);
                $image_details1->resize(50,50);
                $image_details1->save($path_icon.$name_details_1);
                imagesModel::where('service_id',$id)

                    ->update(['image_details_1'=>$name_details_1]);
            }
        if(!empty($file_details_2))
            {
                // return 'toiday';
                $image_path_details_2 = $path_details1.$name_old_image_details_2;
                $image_path_thumb_details_2 = $path_thumb.$name_old_image_details_2;
                $image_path_icon_details_2 = $path_icon.$name_old_image_details_2;
                if(File::exists($image_path_details_2)) {
                    File::delete($image_path_details_2);
                    File::delete($image_path_thumb_details_2);
                    File::delete($image_path_icon_details_2);
                }
                $name_details_2 = "details2_".$time.'.'.$file_details_2->getClientOriginalExtension();
                $image_details2 = \Image::make($file_details_2);
                $image_details2->resize(1280,720);
                $image_details2->save($path_details2.$name_details_2);
                $image_details2->resize(600,400);
                $image_details2->save($path_thumb.$name_details_2);
                $image_details2->resize(50,50);
                $image_details2->save($path_icon.$name_details_2);
                imagesModel::where('service_id',$id)
                    ->update(['image_details_2'=>$name_details_2]);

            }
        return json_encode(1);
    }





    public function UploadImageUser(Request $request, $user_id)
    {
        $date = date("Y_m_d");
        $timedate = date("h_i_s");
        $time = '_'.$date.'_'.$timedate;

        $path_avatar = public_path().'/avatar/';
        $file_avatar = $request->file('avatar');
        $name_avatar = "avatar".$time.'.'.$file_avatar->getClientOriginalExtension();
        $image_avatar = \Image::make($file_avatar);
        $image_avatar->resize(198,198);
        $image_avatar->save($path_avatar.$name_avatar);
        contact_infoModel::where('user_id',$user_id)
            ->update(['contact_avatar'=>$name_avatar]);
        return json_encode("status:200");
    }

    public function getAvatar($user)
    {
        $url  = 'public/avatar/';
        $string_replace = '","id":';
        $image_detail = DB::table('vnt_contact_info') 
        ->select('contact_avatar')
        ->where('user_id', $user)->get();
        $tmp = "";
        foreach ($image_detail as $value) {
            $tmp = $value->contact_avatar;
        }
        return json_encode($tmp);
    }

    public function UploadMultipleImage(Request $request, $services)
    {
        $date = date("Y_m_d");
        $timedate = date("h_i_s");
        $time = '_'.$date.'_'.$timedate;

        $duong_dan   = public_path().'\banner\\';
        if( $file_anh = $request->file('ten_hinh'))
        {
            for($i = 0; $i < sizeof($file_anh); $i++)
            {
                $hinh_anh = \Image::make($file_anh[$i]);
                $hinh_anh->resize(286,400);
                $hinh_anh->save($duong_dan.'banner'.$time.$i.'.'.$file_anh[$i]->getClientOriginalExtension());
                $hinh_anh = new imagesModel();
                $hinh_anh->image_banner = "banner".$time.$i.'.'.$file_anh[$i]->getClientOriginalExtension();
                $hinh_anh->service_id= $services;
                $hinh_anh->save();
            }
        }

    }

    public function multipleUploadImage(Request $request, $id){
        $uploader = new handler();

        // Specify the list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $uploader->allowedExtensions = array(); // all files types allowed by default

        // Specify max file size in bytes.
        $uploader->sizeLimit = 2097152;

        // Specify the input name set in the javascript.
        $uploader->inputName = "qqfile"; // matches Fine Uploader's default inputName value by default

        // If you want to use the chunking/resume feature, specify the folder to temporarily save parts.
        $uploader->chunksFolder = "chunks";

        $method = $uploader->ismemethod();

        // This will retrieve the "intended" request method.  Normally, this is the
        // actual method of the request.  Sometimes, though, the intended request method
        // must be hidden in the parameters of the request.  For example, when attempting to
        // delete a file using a POST request. In that case, "DELETE" will be sent along with
        // the request in a "_method" parameter.

        if ($method == "POST") {
            header("Content-Type: text/plain");

            // Assumes you have a chunking.success.endpoint set to point here with a query parameter of "done".
            // For example: /myserver/handlers/endpoint.php?done
            if (isset($_GET["done"])) {
                $result = $uploader->combineChunks("files");
            }
            // Handles upload requests
            else {
                // Call handleUpload() with the name of the folder, relative to PHP's getcwd()
                $id_sv = servicesModel::where('id',$id)->select('id')->first();
                if ($id_sv != null) {
                    $result = $uploader->handleUpload("public/thumbnails/gallery",$id);
                    // $lam = getcwd();
                    // dd($result);
                    // To return a name used for uploaded file you can use the following line.
                    $result["uploadName"] = $uploader->getUploadName();
                }
            }

            echo json_encode($result);
        }
        // for delete file requests
        else if ($method == "DELETE") {
            // return $request->all();
            $result = $uploader->handleDelete("public/thumbnails/gallery",$id,$request->name);
            return json_encode($result);
        }
        else {
            header("HTTP/1.0 405 Method Not Allowed");
        }
    }


    public function get_gallery($id){
        $path = "public/thumbnails/gallery/".$id."/*.*";
        try {
            foreach(glob($path) as $filename){
                $dataImage[] = $filename;
            }
            if (isset($dataImage)) {
                $arrImage['data'] = $dataImage;
                $arrImage['error'] = null;
                // return $arrImage;
                return $arrImage;
            }
            else
            {
                $arrImage['data'] = null;
                $arrImage['error'] = -1;
                return $arrImage;
            }
        } catch (Exception $e) {
            $arrImage['data'] = null;
            $arrImage['error'] = $e;
            return $arrImage;
        }
    }

    public function watermark_img()
    {
        $source_image = 'public/thumbnails/gallery/221/1.jpg';
        $destination = 'public/thumbnails/gallery/221/1.jpg';
        $water = 'public/resource/images/logo-water-2.png';

        $info = getimagesize($source_image);
        $imgtype = image_type_to_mime_type($info[2]);
        
        // create the proper image from the filetype    
        switch($imgtype){
            case 'image/gif':
                $image = imagecreatefromgif($source_image);
                break;
            case 'image/jpg':
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source_image);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source_image);
                break;
            default:
                die('Not a valid image type.');
        }
        
        $watermark = getimagesize($water);
        $watermark_type = image_type_to_mime_type($watermark[2]);
        
        // create the proper image from the watermark filetype
        switch($watermark_type){
            case 'image/png':
                $watermark = imagecreatefrompng($water);
                break;
            case 'image/gif':
                $watermark = imagecreatefromgif($water);
            default:
                die('Not a valid watermark image.');
        }
        
        // image size
        $image_width = imagesx($image);
        $image_height = imagesy($image);
        
        // watermark size
        $watermark_width = imagesx($watermark);
        $watermark_height = imagesy($watermark);
        
        // position the watermark
        
        // center center
        // $start_width = (($image_width - $watermark_width) / 2);
        // $start_height = (($image_height - $watermark_height) / 2);
        
        // top left
        // $start_width = 0;
        // $start_height = 0;
        
        // bottom right
        $start_width = ($image_width - $watermark_width);
        $start_height = ($image_height - $watermark_height);
        
        // create the image
        imagecopy($image, $watermark, $start_width, $start_height, 0, 0, $watermark_width, $watermark_height);
        
        // and display it
        if(Imagejpeg($image,$destination,100)) {
          return 1;
        }
          // If something went wrong
        return -1;
    }
}