@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{ url('/') }}/novidogadjaj">Creiraj novi Dogadjaj</a> </div>

					<div class="search">
						<form  action="{{ url('/') }}/homedogadjajisearch" method="get" enctype="multipart/form-data" >
							<input type="text"  name="search" value="{{ $search }}"  placeholder="Pretraga"/>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

						</form>
					</div>
                <div class="panel-body">
                   
				   @if (session('message'))
						<div class="alert alert-success">
							{{ session('message') }}
						</div>
					@endif
			
					
						@foreach($dogadjaji as $dogadjaj)
							<h3>Naslov : {{ $dogadjaj->naslov }}  </h3>
							<p>Text : {{ $dogadjaj->text }}</p>
							<p>datum : {{ $dogadjaj->datum }}</p>
							<p>slika : {{ $dogadjaj->slika }}</p>
							<p>Telefon : {{ $dogadjaj->telefon }}</p>
							<a href="{{ url('/') }}/obrisidogadjaj/{{ $dogadjaj->id }}">Obrisi dogadjaj</a>
				
							<hr>
						@endforeach 
						
					{{ $dogadjaji->appends(['search' => $search])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
