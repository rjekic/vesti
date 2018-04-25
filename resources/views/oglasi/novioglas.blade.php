@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Novi oglas</div>

                <div class="panel-body">
                  
					@isset($errors)
						<div class="alert alert-error">
							@foreach($errors as $error)
								<p> {{ $error }}  </p>	
							@endforeach
						</div>
					@endisset
					
					@if (session('message'))
						<div class="alert alert-success">
							{{ session('message') }}
						</div>
					@endif

					<form action="{{ url('/') }}/createoglas" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					
						<input type="file" name="naslovnaslika" /> Naslovna slika
						<input type="text" name="naslov" placeholder="Naslov" required />
						<input type="text" name="text" placeholder="Test" required />
						<select name="kategorija" placeholder="Naslov" >
							@foreach($kategorija as $kat)
								<option value="{{ $kat->kategorija }}"> {{ $kat->kategorija }}  </option>
							@endforeach 
						</select>	
						<input type="text" name="cena" placeholder="Cena" required />
						<input type="text" name="telefon" value="{{ $user->telefon }}"  placeholder="Telefon" required />
						
						<input type="file" name="ostaleslike[]" multiple /> jos slika
						
						<input type="submit" value="Napravi oglas" />
						
					</form>
			
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
