@extends('adminlte::page')

@section('title', 'Permissões do cargo {$role->name}')

@section('content_header')

    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
       <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}">Cargo</a></li>
    </ol>

    <h1>Permissões do cargo <strong>{{ $role->name }} </strong>   <br>
    <a href="{{ route('roles.permissions.available', $role->id) }}" class="btn btn-dark">Adicionar nova permissão</a></h1>


@stop

@section('content')
     <div class="card">
             <div class="card-body">
                 <table class="table table-condensed">
                     <thead>
                       <tr>
                          <th>Nome</th>
                          <th width="50">Ações</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach($permissions as $permission)
                            <tr>
                               <td>
                                  {{ $permission->name }}
                               </td>

                               <td style="width=10px;">
                                  <a href="{{ route('roles.permission.detach', [$role->id, $permission->id]) }}" class="btn btn-danger">Desvincular</a>
                               </td>
                            </tr>
                       @endforeach
                     </tbody>
                 </table>
            </div>

            <div class="card-footer">
                 @if(isset($filters))
                    {!! $permissions->appends($filters)->links() !!}
                 @else
                    {!! $permissions->links() !!}
                 @endif

            </div>
     </div>
@stop

