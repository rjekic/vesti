<aside class="sidebar tabs">
		<ul class="nav">
			<li class="tab-action active" data-tab-cnt="tab1">Najnovije vesti</li>
			<li class="tab-action" data-tab-cnt="tab2">Servisne informacije</li>
			<li class="tab-action" data-tab-cnt="tab3">Red <br>vožnje</li>
			<div class="clear"></div>
		</ul>

		<div id="tab1" class="tab-cnt active">
			<div class="widget">		
				<div class="cat-s blue">
					<h3>Najnovije vesti</h3>
				</div>
					<ul class="news newsticker">
					@foreach ($ticker as $test)
						<li>
							<h4><a href="{{ $test->link }}">{{ $test->naslov }}</a></h4>
							<span class="date">{{ $test->datum }}</span>
						</li>
					@endforeach
						<!-- <li>
							<h4><a href="">Održana sednica štaba za vanredne situacije</a></h4>
							<span class="date">23/02/2015</span>
						</li>
						<li>
							<h4><a href="">Održana 24. sednica Skupštine grada </a></h4>
							<span class="date">23/02/2015</span>
						</li>
						<li>
							<h4><a href="">Sastanak italijanskih i valjevskih privrednika</a></h4>
							<span class="date">23/02/2015</span>
						</li>
						<li>
							<h4><a href="">Sastanak italijanskih i valjevskih privrednika</a></h4>
							<span class="date">23/02/2015</span>
						</li>
						<li>
							<h4><a href="">Održana sednica štaba za vanredne situacije</a></h4>
							<span class="date">23/02/2015</span>
						</li>
						<li>
							<h4><a href="">Održana 24. sednica Skupštine grada </a></h4>
							<span class="date">23/02/2015</span>
						</li>
						<li>
							<h4><a href="">Sastanak italijanskih i valjevskih privrednika</a></h4>
							<span class="date">23/02/2015</span>
						</li> -->
					</ul>
				</div>


			<!-- <div class="widget">		
				<div class="cat-s blue">
					<h3>Dodatno</h3>
				</div>
				<ul class="document">
					<li>
						<span class="icon fl-l"></span>
						<div class="fl-l">
							<h4><a href="">Budžet 2015. god</a></h4>
							<span class="file">PDF - 1.3MB</span>
						</div>
					</li>
					<li>
						<span class="icon fl-l"></span>
						<div class="fl-l">
							<h4><a href="">Budžet 2015. god</a></h4>
							<span class="file">PDF - 1.3MB</span>
						</div>
					</li>
					<li>
						<span class="icon fl-l"></span>
						<div class="fl-l">
							<h4><a href="">Budžet 2015. god</a></h4>
							<span class="file">PDF - 1.3MB</span>
						</div>
					</li>
					<li>
						<span class="icon fl-l"></span>
						<div class="fl-l">
							<h4><a href="">Budžet 2015. god</a></h4>
							<span class="file">PDF - 1.3MB</span>
						</div>
					</li>
				</ul>
			</div> -->

		</div>


		<div id="tab2" class="tab-cnt">
			<div class="widget">		
				<div class="cat-s blue">
					<h3>Važni telefoni</h3>
				</div>
				<ul class="document">
					<li>
						<span class="icon fl-l"></span>
						<div class="fl-l">
							<h4><a href="">Budžet 2015. god</a></h4>
							<span class="file">PDF - 1.3MB</span>
						</div>
					</li>
					<li>
						<span class="icon fl-l"></span>
						<div class="fl-l">
							<h4><a href="">Budžet 2015. god</a></h4>
							<span class="file">PDF - 1.3MB</span>
						</div>
					</li>
					<li>
						<span class="icon fl-l"></span>
						<div class="fl-l">
							<h4><a href="">Budžet 2015. god</a></h4>
							<span class="file">PDF - 1.3MB</span>
						</div>
					</li>
					<li>
						<span class="icon fl-l"></span>
						<div class="fl-l">
							<h4><a href="">Budžet 2015. god</a></h4>
							<span class="file">PDF - 1.3MB</span>
						</div>
					</li>
				</ul>
			</div>
		</div>


		<div id="tab3" class="tab-cnt">
			<div class="widget">		
				<div class="cat-s blue">
					<h3>Mreze</h3>
				</div>
				<iframe src="http://www.facebook.com/plugins/likebox.php?id=97092227789&amp;width=302&amp;connections=10&amp;stream=true&amp;header=false" scrolling="no" height="540px" frameborder="0" allowtransparency="true" style="border-style:none; overflow:hidden; width:302px; "></iframe>
			</div>

		</div>


	</aside>