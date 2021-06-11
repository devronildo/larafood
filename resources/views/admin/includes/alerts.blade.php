@if($errors->any())
     <div class="alert alert-warning">
         @foreach($errors->all() as $error)
           <p>{{ $error }}</p>
         @endforeach
     </div>
@endif


@if(session('message'))
  <div class="alert alert-info">
     {{session('message')}}
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger">
     {{session('error')}}
  </div>
@endif