@extends('layouts.app')

@section('web_title', 'Listado de Usuarios')

@section('title')
    <i class="fa-solid fa-fw fa-users"></i> Listado de Usuarios
@endsection

@section('content')


    <div class="card">
        <div class="card-header">
        <h3 class="card-title">Listado de Usuarios</h3>
        
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Colapsar">
                <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remover">
                <i class="fas fa-times"></i>
                </button>
                <a href="#" class="btn btn-tool" data-card-widget="add" title="Crear Usuario">
                <i class="fa-solid fa-plus"></i>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Cedula</th>
                            <th>Correo</th>
                            <th>Usuario</th>
                            <th>Contraseña</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>nombre 1</td>
                            <td>cedula 1</td>
                            <td>correo 1</td>
                            <td>usuario 1</td>
                            <td>contraseña 1</td>
                        </tr>
                        <tr>
                            <td>nombre 2</td>
                            <td>cedula 2</td>
                            <td>correo 2</td>
                            <td>usuario 2</td>
                            <td>contraseña 2</td>
                        </tr>
                        <tr>
                            <td>nombre 3</td>
                            <td>cedula 3</td>
                            <td>correo 3</td>
                            <td>usuario 3</td>
                            <td>contraseña 3</td>
                        </tr>
                        <tr>
                            <td>nombre 4</td>
                            <td>cedula 4</td>
                            <td>correo 4</td>
                            <td>usuario 4</td>
                            <td>contraseña 4</td>
                        </tr>
                        <tr>
                            <td>nombre 5</td>
                            <td>cedula 5</td>
                            <td>correo 5</td>
                            <td>usuario 5</td>
                            <td>contraseña 5</td>
                        </tr>
                        <tr>
                            <td>nombre 6</td>
                            <td>cedula 6</td>
                            <td>correo 6</td>
                            <td>usuario 6</td>
                            <td>contraseña 6</td>
                        </tr>
                        <tr>
                            <td>nombre 7</td>
                            <td>cedula 7</td>
                            <td>correo 7</td>
                            <td>usuario 7</td>
                            <td>contraseña 7</td>
                        </tr>
                        <tr>
                            <td>nombre 8</td>
                            <td>cedula 8</td>
                            <td>correo 8</td>
                            <td>usuario 8</td>
                            <td>contraseña 8</td>
                        </tr>
                        <tr>
                            <td>nombre 9</td>
                            <td>cedula 9</td>
                            <td>correo 9</td>
                            <td>usuario 9</td>
                            <td>contraseña 9</td>
                        </tr>
                        <tr>
                            <td>nombre 10</td>
                            <td>cedula 10</td>
                            <td>correo 10</td>
                            <td>usuario 10</td>
                            <td>contraseña 10</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        {{-- <div class="card-footer">
            Footer
        </div> --}}
        
    </div>
    
@endsection