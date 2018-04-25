
@extends('layouts.app')


	<!-- Top header -->
	
	<!-- /Top header -->

	<!-- Main navigation -->
	
	<!-- /Main navigation -->


@section('content')
	<div class="wrap">
		<main class="has-sidebar">

			<!-- News section -->
			<div id="vesti" class="cat blue">
				<h2>Aktuelno</h2>
			</div>
			
			<section class="news green">
	<!--@include('partials.articles.featured-article')-->
@include('forms.search')
   <div class="weather">
        <figure>
          <img src="{{ $slika }}">
        </figure>
        <div>
          <span>Danas:</span>
          <i>{{ $temperatura }}C</i>
          <div class="rec">
            <span>Preporučujemo:</span>
            <a href="">Dinamiku svetlosti u pejzažu</a>
          </div>
        </div>
        </div>
	<div class="row-col-3">
		<!-- @include('partials.articles.article-1-3')
		@include('partials.articles.article-1-3')
		@include('partials.articles.article-1-3')

		@include('partials.articles.article-1-3')
		@include('partials.articles.article-1-3')
		@include('partials.articles.article-1-3') -->
		<div class="search">
			<form  action="searchOglasi" method="get" enctype="multipart/form-data" >
				<input type="text"  name="search" value="{{ $search }}"  placeholder="Pretraga oglasi"/>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

			</form>
		</div>
		@foreach ($oglasi as $oglas)
		<article>
			<div class="pr">
			
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
				
							<hr>
			
		</article>
		@endforeach
	</div>
	
			
	{{ $oglasi->appends(['search' => $search])->links() }}


	<div class="clear"></div>


	<a href="" class="more-news">Pogledaj sve vesti</a>

	<hr/>
</section>
			<!-- /News section -->


			<!-- E usluge -->
			<!-- <div class="cat blue">
				<h2>e-usluge</h2>
			</div>

			@include('partials.sections.e-usluge') -->
			<!-- /E usluge -->



			<!-- Dogadjaji -->
			<!-- <div class="cat green">
				<h2>Događaji</h2>
			</div>

			@include('partials.sections.events') -->
			<!-- /Dogadjaji -->


			<!-- News carousel -->
			<!-- <div class="cat blue">
				<h2>Vesti</h2>
			</div>

			@include('partials.sections.news-carousel') -->
			<!-- /News carousel -->


			<!-- News short -->
			<!-- <div class="cat blue">
				<h2>Vesti</h2>
			</div>
			
			@include('partials.sections.news-short') -->
			<!-- /News short -->

			<!-- Dokumenti section -->
			<!-- <div id="dokumenti" class="cat blue">
				<h2>Dokumenti</h2>
			</div>
			
			@include('partials.sections.documents') -->
			<!-- /Dokumenti section -->


			<!-- Galerija section -->
			<div id="galerija" class="cat blue">
				<h2>Galerija</h2>
				<p>Cras congue non elit ac facilisis. Sed ultricies rhoncus erat, non viverra diam sagittis vitae.</p>
			</div>
			
			@include('partials.sections.gallery')
			<!-- /Galerija section -->


			<!-- News side image -->
			<!-- <div class="cat blue">
				<h2>Vesti</h2>
			</div>
			
			@include('partials.sections.news-side-img') -->
			<!-- /News side image -->


			<!-- Profili lista -->
			<div class="cat blue">
				<h2>Profili</h2>
			</div>
			
			@include('partials.sections.profiles-list')

			<!-- /Profili lista -->



			<!-- Profil single -->
			<div class="cat blue">
				<h2>Profil</h2>
			</div>
			
			@include('partials.partials.profile-single')
			<!-- /Profil single -->



			<!-- Organi i njihove funkcije -->
			<!-- <div class="cat green">
				<h2>Organi i njihove funkcije</h2>
			</div>
			
			@include('partials.sections.heading-and-text') -->
			<!-- /Organi i njihove funkcije -->



			<!-- Tabela javnih nabavki -->
			<!-- <div class="cat green">
				<h2>Tabela javnih nabavki</h2><div class="category green"><a href="" class="active">2013</a><a href="">2014</a><a href="">2015</a></div>
			</div>
			
			@include('partials.sections.table') -->

			<!-- /Tabela javnih nabavki -->


			<!-- Forme -->
			<!-- <div class="cat blue">
				<h2>Forme</h2>
			</div>
			
			@include('partials.partials.forms-elements') -->
			<!-- /Forme -->



			<!-- Social -->
			<!-- <div class="cat blue">
				<h2>Social</h2>
			</div>
			
			@include('partials.partials.social') -->
			<!-- /Social -->
			


			<!-- Adresar -->
			<!-- <div class="cat blue">
				<h2>Adresar</h2>
			</div>
			
			@include('partials.sections.adresar') -->
			<!-- /Adresar -->




			<!-- Sidebar -->
			@include('partials.sidebar')
			<!-- /Sidebar -->


				
		</main>
	</div>

	@include('partials.footer')
	<script type="text/javascript">
		$('.newsticker').newsTicker({
    row_height: 80,
    max_rows: 4,
    direction: 'up',
    duration: 4000,
    autostart: 1,
    pauseOnHover: 0
});
	</script>
@endsection