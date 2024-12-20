@extends('default')
@section("title", "Utilisateurs")
@section("subtitle", "Gestion des clients")
@section('utilisateursActivate', 'active')
@section('utilisateursOpen', 'menu-open')
@section('Gestion des clients', 'active')
@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Liste des clients TR</h3> <br>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-add-type">
                Ajouter un utilisateur
            </button>
            <div class="modal fade" id="modal-add-type" style="display: none;" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ajouter un utilisateur</h4>
                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="">
                                <span aria-hidden="true">×</span>
                            </button> -->
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{url('/utilisateurs/clients')}}">
                                @csrf()
                                <div class="row">
                                    <div class="col-4">
                                        <input type="text" name="nom_user" class="form-control" placeholder="nom de l'utilisateur" required>
                                        <br>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" name="prenom_user" class="form-control" placeholder="prenom de l'utilisateur" required>
                                        <br>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" name="phone" class="form-control" placeholder="numéro de téléphone" required>
                                        <br>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" name="email" class="form-control" placeholder="adresse email">
                                        <br>
                                    </div>
                                    <div class="col-4">
                                        <select name="type_user" class="form-control" required>
                                            <option value="">choisissez le type de l'utilisateur</option>
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}">{{$type->nom_type_user}}</option>
                                            @endforeach
                                        </select> <br>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" name="password" class="form-control" placeholder="code pin" required>
                                        <br>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-warning">Enregistrer</button>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nom & prénom</th>
                    <th>Email</th>
                    <th>Numéro de Tel</th>
                    <th>Ajouté le</th>
                    <th>Compte activé</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->prenom_user." ".$user->nom_user}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{redefineDateTme($user->created_at)}}</td>
                        <td>{{$user->status_user ? "activé" : "desactivé"}}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-add-type-{{$user->id}}">
                                Modifier l'utilisateur
                            </button>
                            <div class="modal fade" id="modal-add-type-{{$user->id}}" style="display: none;" aria-modal="true" role="dialog">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Modifier les informations l'utilisateur : {{$user->nom_user}}</h4>

                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{url('/utilisateurs/clients/'.$user->id)}}">
                                                @csrf()
                                                <input type="hidden" value="{{$user->id}}" name="id">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <input type="text" name="nom_user" class="form-control" value="{{$user->nom_user}}" placeholder="nom de l'utilisateur" required>
                                                        <br>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="text" name="prenom_user" class="form-control" value="{{$user->prenom_user}}" placeholder="prenom de l'utilisateur" required>
                                                        <br>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="text" name="email" class="form-control" value="{{$user->email}}" placeholder="adresse email">
                                                        <br>
                                                    </div>
                                                    <div class="col-4">
                                                        <select name="type_user" class="form-control" required>
                                                            <option value="">choisissez le type de l'utilisateur</option>
                                                            @foreach($types as $type)
                                                                <option value="{{$type->id}}" {{$type->id == $user->type_user ? "selected" : ""}}>{{$type->nom_type_user}}</option>
                                                            @endforeach
                                                        </select> <br>
                                                    </div>
                                                    <div class="col-4">
                                                        <select name="status_user" class="form-control" required>
                                                            <option value="">status du compte</option>
                                                            <option value="0" {{0 == $user->status_user ? "selected" : ""}}>Désactivé</option>
                                                            <option value="1" {{1 == $user->status_user ? "selected" : ""}}>Activé</option>
                                                        </select> <br>
                                                    </div>
                                                    <div class="col-4">
                                                        <button type="submit" class="btn btn-warning">Enregistrer</button>
                                                        <br>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
@section('footer')
    <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
