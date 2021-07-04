@extends('adminlte::page')

@section('title', 'Cadastrar nova mesa')

@section('content_header')
    <h1>Cadastrar nova mesa</h1>
@stop

@section('content')

     <div class="card">
           <div class="card-body">
                <form action="{{ route('tables.store')}}" class="form" method="POST">
                    @csrf

                    @include('admin.pages.tables._partials.form')
                </form>
           </div>
     </div>


@endsection

