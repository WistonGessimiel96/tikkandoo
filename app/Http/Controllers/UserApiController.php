<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\Ticket;
use App\Models\Tiket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserApiController extends Controller
{
    //
    public function indexLogin(Request $request){
        if ($request->isMethod('post')) {
            session()->regenerate();
            $credentials = array('phone' =>  $request->phone, 'password' => $request->confirm_password, 'status_user' => 1);
            if (Auth::attempt($credentials)) {
                $user = User::where('phone', $request->phone)->first();
                $userId = $user->id;
                $token = $this->generateOtp();
                User::where('id', $userId)->update([
                    'token_to_check' => $token]);
               $this->sendNotificationToSpecificUser( "Vitre code OTP est $token", "Tikkandoo connexion", $request->onesignal_id);
                $user = User::where('phone', $request->phone)->first();
                return response()->json( [
                    "message" => "found",
                    "user" => $user,
                ]);
            }else{
                return response()->json( [
                    "message" => "not found",
                    "user" => $request->all(),
                ]);
            }
        } else {
            return response()->json( [
                "message" => "not found",
            ]);
        }
    }
    public function indexCheck(Request $request){
        if ($request->isMethod('post')) {
            $user = User::where('phone', $request->phone)->first();
           if($user) {
               User::where('id', $user->id)->update([
                   'onesignal_id' => $request->onesignal_id]);
               return response()->json( [
                   "message" => "found",
                   "user" => $user,
               ]);
            }else{
                return response()->json( [
                    "message" => "not found",
                    "user" => $request->all(),
                ]);
            }
        } else {
            return response()->json( [
                "message" => "not found",
            ]);
        }
    }
    public function register(Request $request){
        if ($request->isMethod('post')) {
            $user = User::where('phone', $request->phone)->first();
           if($user) {
               return response()->json( [
                   "message" => "found",
                   "data" => $user,
               ]);
            }else{
               $user = new User();
               $user->nom_user = $request->nom_user;
               $user->prenom_user = $request->prenom_user;
               $user->phone = $request->phone;
               $user->onesignal_id = $request->onesignal_id;
               $user->type_user = 1;
               $user->password = Hash::make($request->password);
               $user->email = $request->email ;
               $user->status_user = 1 ;
               if($user->save()){
                   session()->regenerate();
                   $token = $this->generateOtp();
                   User::where('id', $user->id)->update([
                       'token_to_check' => $token]);
                   $this->sendNotificationToSpecificUser( "Vitre code OTP est $token", "Tikkandoo connexion", $request->onesignal_id);
                   $user = User::where('phone', $request->phone)->first();
                   return response()->json( [
                       "message" => "found",
                       "user" => $user,
                   ]);
               }else{
                   return response()->json( [
                       "message" => "not added",
                       "user" => $request->all(),
                   ]);
               }

            }
        } else {
            return response()->json( [
                "message" => "not found",
            ]);
        }
    }
    public function getTicket(){
            $ticket = Tiket::where('status', 1)->get();
               return response()->json( [
                   "message" => "found",
                   "data" => $ticket,
               ]);

    }
    public function getAbonnement(){
            $ticket = Abonnement::all();
               return response()->json( [
                   "message" => "found",
                   "data" => $ticket,
               ]);

    }

    function generateOtp($length = 6) {
        // Génère un nombre aléatoire entre 10^(length-1) et (10^length)-1
        $min = pow(10, $length - 1);
        $max = pow(10, $length) - 1;

        return mt_rand($min, $max);
    }

    function sendNotificationToSpecificUser($message, $heading, $userOneSignalId) {
        $app_id = "96383539-4804-4cf5-baed-d3218d0ed4c2";
        $api_key = "YWY5NTUwMDQtMDFiNy00OWYwLTk5NWItYWUyMmJjNzBhMjdi";

        $content = array(
            "en" => $message
        );

        $headings = array(
            "en" => $heading
        );

        $fields = array(
            'app_id' => $app_id,
            'include_player_ids' => array($userOneSignalId),
            'data' => array("foo" => "bar"),
            'contents' => $content,
            'headings' => $headings
        );

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . $api_key
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }
}
