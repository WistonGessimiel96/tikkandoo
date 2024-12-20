@extends('default')
@section("title", "Forfaits")
@section("subtitle", "Tarifs de ticket")
@section('forfaitsActivate', 'active')
@section('forfaitsOpen', 'menu-open')
@section("Tarifs de ticket", 'active')
@section('header')
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Liste des forfaits type Ticket du TR</h3> <br>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-add-type">
                Ajouter un forfait ticket
            </button>
            <div class="modal fade" id="modal-add-type" style="display: none;" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ajoute un nouveau type de forfait</h4>
                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="">
                                <span aria-hidden="true">×</span>
                            </button> -->
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{url('/forfaits/tickets')}}">
                                @csrf()
                                <div class="row">
                                    <div class="col-4">
                                        <input type="text" name="nom_ticket" class="form-control" placeholder="nom du forfait ticket" required>
                                        <br>
                                    </div>
                                    <div class="col-4">
                                        <select name="destination" id="" class="form-control" required>
                                            <option value="">choisir la zone</option>
                                            <option value="zone_1">1 Zone</option>
                                            <option value="zone_2">2 Zones</option>
                                            <option value="zone_3">3 Zones</option>
                                        </select> <br>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" name="prix" class="form-control" placeholder="prix" required>
                                        <br>
                                    </div>
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-warning">Enregistrer</button>
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
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>destination</th>
                    <th>prix</th>
                    <th>Status du forfait</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->nom_ticket}}</td>
                        <td>{{$user->destination}}</td>
                        <td>{{$user->prix}} Fcfa</td>
                        <td>{{$user->status ? "activé" : "désactivé"}}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-add-type-{{$user->id}}">
                                Modifier le forfait ticket
                            </button>
                            <div class="modal fade" id="modal-add-type-{{$user->id}}" style="display: none;" aria-modal="true" role="dialog">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Modifier le type de forfait : {{$user->nom_type_user}}</h4>
                                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="">
                                                <span aria-hidden="true">×</span>
                                            </button> -->
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{url('/forfaits/tickets/'.$user->id)}}">
                                                @csrf()
                                                <input type="hidden" value="{{$user->id}}" name="id">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <input type="text" name="nom_ticket" value="{{$user->nom_ticket}}" class="form-control" placeholder="nom du forfait ticket" required>
                                                        <br>
                                                    </div>
                                                    <div class="col-4">
                                                        <select name="destination" id="" class="form-control" required>
                                                            <option value="">choisir la zone</option>
                                                            <option value="zone_1" {{"zone_1" == $user->destination ? "selected" : ""}}>1 Zone</option>
                                                            <option value="zone_2" {{"zone_2" == $user->destination ? "selected" : ""}}>2 Zones</option>
                                                            <option value="zone_3" {{"zone_3" == $user->destination ? "selected" : ""}}>3 Zones</option>
                                                        </select> <br>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="text" name="prix" value="{{$user->prix}}" class="form-control" placeholder="prix" required>
                                                        <br>
                                                    </div>
                                                    <div class="col-2">
                                                        <select name="status" class="form-control" required>
                                                            <option value="">status du compte</option>
                                                            <option value="0" {{0 == $user->status ? "selected" : ""}}>Désactivé</option>
                                                            <option value="1" {{1 == $user->status ? "selected" : ""}}>Activé</option>
                                                        </select> <br>
                                                    </div>
                                                    <div class="col-4">
                                                        <button type="submit" class="btn btn-warning">Enregistrer</button>
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
