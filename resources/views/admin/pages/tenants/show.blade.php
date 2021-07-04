@extends('adminlte::page')

@section('title', "Detalhes da empresa {$tenant->name}")

@section('content_header')
    <h1>Detalhes da empresa <b>{{ $tenant->name }}</b></h1>
@stop

@section('content')

     <div class="card">
           <div class="card-body">
               <ul>
                   <ol>
                   <img src="{{ url("storage/{$tenant->logo}") }}" alt="{{ $tenant->title }}" style="max-width:90px;">
                   </ol>
                    <br>
                  <li>
                     <strong>Plano: </strong> {{$tenant->plan->name}}
                  </li>
                  <li>
                     <strong>Nome: </strong> {{$tenant->name}}
                  </li>
                  <li>
                     <strong>URL: </strong> {{$tenant->url}}
                  </li>
                  <li>
                     <strong>E-mail: </strong> {{$tenant->email}}
                  </li>
                  <li>
                     <strong>CNPJ: </strong> {{$tenant->cnpj}}
                  </li>
                  <li>
                     <strong>Ativo: </strong> {{$tenant->active == 'Y' ? 'SIM':'NÃO'}}
                  </li>
               </ul>
               <hr>
               <hr>
               <h3>Assinatura</h3>
               <ul>
                  <li>
                     <strong>Data Assinatura: </strong> {{$tenant->subscription}}
                  </li>
                  <li>
                     <strong>Data Expiração: </strong> {{$tenant->expires_at}}
                  </li>
                  <li>
                     <strong>Identificador: </strong> {{$tenant->subscription_at}}
                  </li>
                  <li>
                     <strong>Ativo: </strong> {{$tenant->subscription_active ? 'SIM':'NÃO'}}
                  </li>
                  <li>
                     <strong>Ativo: </strong> {{$tenant->subscription_active ? 'SIM':'NÃO'}}
                  </li>
               </ul>

               @include('admin.includes.alerts')

               <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger"> <i class="fas fa-trash"></i> DELETAR O PRODUTO {{$tenant->title}}</button>
               </form>
           </div>
     </div>
@endsection

