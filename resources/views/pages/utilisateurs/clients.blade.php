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
            <h3 class="card-title">Liste des membres enregistrés</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nom & prénom</th>
                    <th>Email</th>
                    <th>Ajouté le</th>
                    <th>Compte activé</th>
                    <th>Pupitre(s)</th>
                    <th>Instrument</th>
                    <th>Titre</th>
                    <th>Section</th>
                    <th>Numéro</th>
                    <th>Diplome</th>
                    <th>Domaine</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->surname." ".$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{redefineDateTme($user->created_at)}}</td>
                        <td>{{$user->active? "oui" : "non"}}</td>
                        <td>{{$user->tenor? "[Tenor] " : ""}}  {{$user->alto? "[Alto] " : ""}}  {{$user->soprano? "[Soprano]" : ""}} {{$user->basse? "[Basse]" : ""}} {{$user->bariton? "[Bariton]" : ""}}</td>
                        <td>{{$user->instrument}}</td>
                        <td style="text-transform: capitalize">{{$user->titre}}</td>
                        <td style="text-transform: capitalize">{{$user->pdc? "[PDC] " : ""}} {{$user->sev? "[SEV] " : ""}} {{$user->spt? "[SPT] " : ""}} {{$user->tech? "[TECH] " : ""}}</td>
                        <td style="text-transform: capitalize">{{$user->number}}</td>
                        <td>{{$user->niveau_etude}}</td>
                        <td>{{$user->domaine_etude}}</td>
                        <td>
                            @if(($user->id != session('User')['id']))
                                @if(session('User')['id'] == 1)
                                    <a href="{{url('/ajouter-un-membre/'.$user->id)}}" class="btn btn-sm btn-warning">Modifier</a>
                                    <a href="{{url('/modifier-compte-membre/'.$user->id)}}" class="btn btn-sm {{ $user->active == 1 ? "btn-danger" : "btn-success" }}">{{ $user->active == 1 ? "Désactiver" : "Activer" }}</a>
                                    @if($user->active != 5)
                                        <a href="{{url('/declarer-parti/'.$user->id)}}" class="btn btn-sm btn-primary">Est parti</a>
                                    @endif

                                    <!--<a href="">Supprimer</a>-->
                                @endif
                            @endif
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
