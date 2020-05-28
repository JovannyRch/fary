<?php

namespace App\Http\Controllers\API;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    public function getNotifications($id_user){

        $today = new \DateTime();
        $today->modify ('+1 days');
        $today = $today->format('Y,m,d');
        
        $last3weeks = new \DateTime();
        $last3weeks->modify ('-21 days');
        $last3weeks = $last3weeks->format('Y,m,d');
     
       

        $table = "notifications_cars";
        $carsNotifications = 
        DB::select("SELECT $table.created_at,$table.post_id,$table.id,$table.visto,
        (SELECT c.content from comments_car_posts  as c where c.id = $table.comment_id) as comment,
        (SELECT name from users  as u where u.id = $table.user_id) user
        from $table where $table.to_user_id = $id_user
        and $table.created_at >= '$last3weeks' and $table.created_at <= '$today' 
        order by $table.created_at desc
        ");

        $table = "notifications";
        $postNotifications = 
        
        
        DB::select("SELECT $table.created_at,$table.post_id,$table.id,$table.visto,
        (SELECT c.content from comments  as c where c.id = $table.comment_id) as comment,
        (SELECT name from users  as u where u.id = $table.user_id) user
        from $table where $table.to_user_id = $id_user
        and $table.created_at BETWEEN STR_TO_DATE('$last3weeks','%Y,%m,%d') and STR_TO_DATE('$today','%Y,%m,%d')
        order by $table.created_at desc
        ");


        return response()->json(['data' => ['cars' => $carsNotifications, 'posts' => $postNotifications]], 200);
    }

    public function deleteNotification($id_notification, $type){
        if($type == 0){
            DB::delete("delete from notifications_cars where id = $id_notification");
        }else{
            DB::delete("delete from notifications_cars where id = $id_notification");
        }
        return response()->json(["msg"=> "ok", "data" => []], 200);
    }

    public function verNotificacionPosts($id){
        DB::update("update notifications set visto = 1 where id = $id");
        return response()->json(["msg"=> "ok", "data" => []], 200);
    }


    public function verNotificacionCars($id){
        DB::update("update notifications_cars set visto = 1 where id = $id");
        return response()->json(["msg"=> "ok", "data" => []], 200);
    }


    public function deleteCars($id){
        DB::delete("delete from notifications_cars where id = $id");
        return response()->json(["msg"=> "ok", "data" => []], 200);

    }

    public function deletePosts($id){
        DB::delete("delete from notifications where id = $id");
        return response()->json(["msg"=> "ok", "data" => []], 200);

    }
}
