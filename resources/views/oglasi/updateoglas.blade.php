@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="novioglas">Creiraj novi oglas</a> </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    		{{ $oglasi }};
						@foreach($oglasi as $oglas)
							 <h3> {{ $oglas->naslov }}  </h3>
					
							
						
						@endforeach 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
