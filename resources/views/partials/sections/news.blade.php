<section class="news green">
	<!--@include('partials.articles.featured-article')-->

	<div class="row-col-3">
		<!-- @include('partials.articles.article-1-3')
		@include('partials.articles.article-1-3')
		@include('partials.articles.article-1-3')

		@include('partials.articles.article-1-3')
		@include('partials.articles.article-1-3')
		@include('partials.articles.article-1-3') -->
		@foreach ($vesti as $vest)
		<article>
			<div class="pr">
				<a href="#">
					<figure>
						<img src="{{ $vest->slika }}" alt="{{ $vest->naslov }}" style="width:300px;height:225px;">
						
					</figure>
				</a>
				<span class="category"><a href="#">{{ $vest->izvor }}</a></span>
			</div>
			<div class="meta"><span class="date">{{ date('d.m.Y H:i', $vest->datum) }}</span>|<span class="views">351</span> pregleda</div>
			<h2><a href="{{ $vest->link }}">{{ $vest->naslov }}</a></h2>
			<p>{{ \Illuminate\Support\Str::words($vest->text, 60, '...') }}</p>
		</article>
		@endforeach
	</div>
	
			
	{{ $vesti->appends(['search' => $search])->links() }}


	<div class="clear"></div>


	<a href="" class="more-news">Pogledaj sve vesti</a>

	<hr/>
</section>