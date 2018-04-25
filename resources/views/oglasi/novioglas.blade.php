@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Novi oglas</div>

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

					<form action="{{ url('/') }}/createoglas" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					
						Naslovna slika <input type="file" name="naslovnaslika" /> 
						<input type="text" name="naslov" placeholder="Naslov" required />
						<input type="text" name="text" placeholder="Test" required />
						<select name="kategorija" placeholder="Naslov" >
							@foreach($kategorija as $kat)
								<option value="{{ $kat->kategorija }}"> {{ $kat->kategorija }}  </option>
							@endforeach 
						</select>	
						<input type="text" name="cena" placeholder="Cena" required />
						<input type="text" name="telefon" value="{{ $user->telefon }}"  placeholder="Telefon" required />
						
						Dodati još slika <input type="file" name="josslika[]" multiple /> 
						
						<input type="submit" value="Napravi oglas" />
						
					</form>
			
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
