@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')

    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
       <li class="breadcrumb-item active"><a href="{{ route('tenants.index') }}">Empresas</a></li>
    </ol>

    <h1>Produtos</h1>


@stop

@section('content')
     <div class="card">
             <div class="card-header">
                 <form action="{{route('tenants.search')}}" method="POST" class="form form-inline">
                    @csrf
                        <input type="text" name="filter" placeholder="Filtrar" class="form-control" value="{{ $filters['filter'] ?? '' }}" />
                        <button type="submit" class="btn btn-dark">Filtrar</button>
                 </form>
             </div>

            <div class="card-body">
                 <table class="table table-condensed">
                     <thead>
                       <tr>
                          <th style="max-width:120px;">Logo</th>
                          <th>Nome</th>
                          <th width="200">Ações</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach($tenants as $tenant)
                            <tr>
                               <td>
                                  <img src="{{ url("storage/{$tenant->logo}") }}" alt="{{ $tenant->name }}" style="max-width:90px;">
                               </td>
                               <td> {{ $tenant->name }} </td>
                               <td style="width=10px;">

                                  <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-info">Editar</a>
                                  <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-warning">VER</a>
                               </td>
                            </tr>
                       @endforeach
                     </tbody>
                 </table>
            </div>

            <div class="card-footer">
                 @if(isset($filters))
                    {!! $tenants->appends($filters)->links() !!}
                 @else
                    {!! $tenants->links() !!}
                 @endif

            </div>
     </div>
@stop

