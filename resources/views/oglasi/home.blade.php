@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="novioglas">Creiraj novi oglas</a> </div>

					<div class="search">
						<form  action="homeoglasisearch" method="get" enctype="multipart/form-data" >
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
			
					
						@foreach($oglasi as $oglas)
							<h3>Naslov : {{ $oglas->naslov }}  </h3>
							<p>Text : {{ $oglas->text }}</p>
							<p>Kategorija : {{ $oglas->kategorija }}</p>
							<p>Cena : {{ $oglas->cena }}</p>
							<p>Telefon : {{ $oglas->telefon }}</p>
							<p>Slike</p>
			
								@if( !empty($oglas->slike) )
										@foreach($oglas->slike as $slika)
											@if($slika->tip == "naslovna")
												<p>naslovna : {{ $slika->slika }}  </p>	
											@else
												<p>ostale : {{ $slika->slika }}  </p>	
											@endif
										@endforeach 				
								@endif
								
								@if( $oglas->slike == "[]" )
							
									<p>naslovna : Grb-Grad-Valjevo </p>	
								@endif
								
								<a href="obrisioglas/{{ $oglas->id }}">Obrisi oglas</a>
				
							<hr>
						@endforeach 
						
					{{ $oglasi->appends(['search' => $search])->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
