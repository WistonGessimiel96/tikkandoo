<?php

namespace App\Http\Controllers;

//use App\Models\Admin;
use App\Models\Abonnement;
use App\Models\Ticket;
use App\Models\Tiket;
use App\Models\Typeutilisateur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function listUser( Request $request){
        $users = User::all();
        $types = Typeutilisateur::all();
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nom_user' => 'required',
                'prenom_user' => 'required',
                'type_user' => 'required',
            ],
                [
                    'nom_user.required' => 'le nom de utilisateur est necessaire.',
                    'prenom_user.required' => 'le prenom est necessaire.',
                    'type_user.required' => 'le  type est necessaire.',
                ]
            );

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator);
            }else {
                if($request->id){
                    User::where('id', $request->id)->update([
                        'nom_user' => $request->nom_user,
                        'prenom_user' => $request->prenom_user,
                        'type_user' => $request->type_user,
                        'email' => $request->email,
                        'status_user' => $request->status_user,
                    ]);
                    return Redirect::back()->with('success', 'Utilisateur modifié avec succes. ');
                }else{
                    $user = new User();
                    $user->nom_user = $request->nom_user;
                    $user->prenom_user = $request->prenom_user;
                    $user->phone = $request->phone;
                    $user->type_user = $request->type_user;
                    $user->password = Hash::make($request->password);
                    $user->email = $request->email ?? null;
                    if($user->save()){
                        return Redirect::back()->with('success', 'Un nouvel utilisateur ajouté avec succes. ');
                    }else{
                        return Redirect::back()->withErrors(['msg' => 'Erreur lors l\'ajout de l\'utilisateur.']);
                    }
                }
            }
        }
        return view('pages.utilisateurs.clients', compact('users', 'types'));
    }
    public function listTypeUser(Request $request){
        $users = Typeutilisateur::all();
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nom_type_user' => 'required',
                'niveau_type_user' => 'required',
            ],
                [
                    'nom_type_user.required' => 'le nom du type utilisateur est necessaire.',
                    'niveau_type_user.required' => 'le niveau du type est necessaire.',
                ]
            );

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator);
            }else {
                if($request->id){
                    Typeutilisateur::where('id', $request->id)->update([
                        'nom_type_user' => $request->nom_type_user,
                        'niveau_user' => $request->niveau_type_user,
                    ]);
                    return Redirect::back()->with('success', 'Type utilisateur modifié avec succes. ');
                }else{
                    $type = new Typeutilisateur();
                    $type->nom_type_user = $request->nom_type_user;
                    $type->niveau_user = $request->niveau_type_user;
                    if($type->save()){
                        return Redirect::back()->with('success', 'Un nouveau type utilisateur ajouté avec succes. ');
                    }else{
                        return Redirect::back()->withErrors(['msg' => 'Erreur lors l\'ajout du type d\'utilisateur.']);
                    }
                }
            }
        }
        return view('pages.utilisateurs.type', compact('users'));
    }
    public function listForfaitTicket(Request $request){
        $users = Tiket::all();
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nom_ticket' => 'required',
                'destination' => 'required',
                'prix' => 'required',
            ],
                [
                    'nom_ticket.required' => 'le nom du ticket est necessaire.',
                    'destination.required' => 'la destination est necessaire.',
                    'prix.required' => 'le prix est necessaire.',
                ]
            );

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator);
            }else {
                if($request->id){
                    Tiket::where('id', $request->id)->update([
                        'nom_ticket' => $request->nom_ticket,
                        'destination' => $request->destination,
                        'prix' => $request->prix,
                        'status' => $request->status,
                    ]);
                    return Redirect::back()->with('success', 'Type forfait ticket modifié avec succes. ');
                }else{
                    $type = new Tiket();
                    $type->nom_ticket = $request->nom_ticket;
                    $type->destination = $request->destination;
                    $type->prix = $request->prix;
                    if($type->save()){
                        return Redirect::back()->with('success', 'Un nouveau type de forfait ticket ajouté avec succes. ');
                    }else{
                        return Redirect::back()->withErrors(['msg' => 'Erreur lors l\'ajout du type de ticket.']);
                    }
                }
            }
        }
        return view('pages.forfaits.tickets', compact('users'));
    }
    public function listForfaitAbonnement(Request $request){
        $users = Abonnement::all();
        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'nom_ticket' => 'required',
                'destination' => 'required',
                'prix' => 'required',
            ],
                [
                    'nom_ticket.required' => 'le nom du ticket est necessaire.',
                    'destination.required' => 'la destination est necessaire.',
                    'prix.required' => 'le prix est necessaire.',
                ]
            );

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator);
            }else {
                if($request->id){
                    Abonnement::where('id', $request->id)->update([
                        'nom_forfait' => $request->nom_ticket,
                        'zone_forfait' => $request->destination,
                        'prix_forfait' => $request->prix,
                    ]);
                    return Redirect::back()->with('success', 'Type forfait ticket modifié avec succes. ');
                }else{
                    $type = new Abonnement();
                    $type->nom_forfait = $request->nom_ticket;
                    $type->zone_forfait = $request->destination;
                    $type->prix_forfait = $request->prix;
                    if($type->save()){
                        return Redirect::back()->with('success', 'Un nouveau type de forfait ticket ajouté avec succes. ');
                    }else{
                        return Redirect::back()->withErrors(['msg' => 'Erreur lors l\'ajout du type de ticket.']);
                    }
                }
            }
        }
        return view('pages.forfaits.abonnements', compact('users'));
    }
    public function addUser(){

    }
}
