@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Kreiraj novi dogadjaj</div>

                <div class="panel-body">
                  
						
							@foreach($errors as $error)
							<div class="alert alert-warning">
								<p> {{ $error }}  </p>	
								</div>
							@endforeach
						
					
					
					@if (session('message'))
						<div class="alert alert-success">
							{{ session('message') }}
						</div>
					@endif

					<form action="{{ url('/') }}/createdogadjaj" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					
						Naslovna slika <input type="file" name="slika" /> 
						<input type="datetime-local" name="datum">
						<input type="text" name="naslov" placeholder="Naslov" required />
						<input type="text" name="text" placeholder="Test" required />
					
						<input type="text" name="telefon" value="{{ $user->telefon }}"  placeholder="Telefon" required />
						
						<input type="submit" value="Napravi dogadjaj" />
						
					</form>
			
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
