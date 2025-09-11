@extends('layouts.app')

@section('web_title', 'Listado de Permisos')

@section('title')
    <i class="fa-solid fa-key"></i> Listado de Permisos
@endsection


@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('admin.permission.index') }}">Permisos</a></li>
@endsection

@push('css')

@endpush

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Listado de Permisos</h3>
                
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapsar">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remover">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  class="table table-hover" id="permission-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>                              
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- <div class="card-footer">
                    Footer
                </div> --}}
                
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script>
        var route_registros = '{{ route("admin.permission.get") }}'
    </script>

    <script src="{{asset('assets/dist/js/permission-table.js')}}"></script>

@endpush

