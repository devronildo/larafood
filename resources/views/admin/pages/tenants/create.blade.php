@extends('adminlte::page')

@section('title', 'Cadastrar nova empresa')

@section('content_header')
    <h1>Cadastrar nova empresa</h1>
@stop

@section('content')

     <div class="card">
           <div class="card-body">
                <form action="{{ route('tenants.store')}}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf

                    @include('admin.pages.tenants._partials.form')
                </form>
           </div>
     </div>


@endsection

