@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')

    <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
       <li class="breadcrumb-item active"><a href="{{ route('tables.index') }}">Mesas</a></li>
    </ol>

    <h1>Mesas <a href="{{ route('tables.create') }}" class="btn btn-dark">Adicionar</a></h1>


@stop

@section('content')
     <div class="card">
             <div class="card-header">
                 <form action="{{route('table.search')}}" method="POST" class="form form-inline">
                    @csrf
                        <input type="text" name="filter" placeholder="Filtrar" class="form-control" value="{{ $filters['filter'] ?? '' }}" />
                        <button type="submit" class="btn btn-dark">Filtrar</button>
                 </form>
             </div>

            <div class="card-body">
                 <table class="table table-condensed">
                     <thead>
                       <tr>
                          <th>Identificador</th>
                          <th>Descrição</th>
                          <th width="200">Ações</th>
                       </tr>
                     </thead>
                     <tbody>
                       @foreach($tables as $table)
                            <tr>
                               <td>{{ $table->identify }}</td>
                               <td> {{ $table->description }} </td>
                               <td style="width=20px;">
                                  <a href="{{ route('tables.qrcode', $table->identify) }}" class="btn btn-default" target="_blank">
                                      <i class="fas fa-qrcode"></i>
                                  </a>
                                  <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-info">Editar</a>
                                  <a href="{{ route('tables.show', $table->id) }}" class="btn btn-warning">VER</a>
                               </td>
                            </tr>
                       @endforeach
                     </tbody>
                 </table>
            </div>

            <div class="card-footer">
                 @if(isset($filters))
                    {!! $tables->appends($filters)->links() !!}
                 @else
                    {!! $tables->links() !!}
                 @endif

            </div>
     </div>
@stop

