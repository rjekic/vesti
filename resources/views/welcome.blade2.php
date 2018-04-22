@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
				
						<form  action="search" method="get" enctype="multipart/form-data" >
							<input type="text"  name="search" value="{{ $search }}" class="form-control" style="width:50%; float:right" placeholder="Pretraga" />
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</form>
			
				</div>

                <div class="panel-body">
                    
					@foreach ($vesti as $vest)
						<div>
							<img src="{{ $vest->slika }}" style="width:60px;height:50px;" alt="{{ $vest->naslov }}">
							<h3><a href="{{ $vest->link }}">{{ $vest->naslov }}</a> </h3>
							<p>{{ $vest->text }}</p>
							<p>{{ $vest->datum }}</p>
							<p>{{ $vest->izvor }}</p>
						</div>
					@endforeach
			
					{{ $vesti->appends(['search' => $search])->links() }}
			
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
