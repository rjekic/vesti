<header id="header">
	<!-- Top header -->
	<div class="top-header">
		<div class="wrap">
			<div class="fl-l">
				<ul>
					<li><a href="">MUP</a></li>
					<li><a href="">MUP</a></li>
					<li><a href="">MUP</a></li>
					<li><a href="">MUP</a></li>
				</ul>
			</div>
			<div class="fl-r">
				<ul>
					<!-- <li><a href="">Karađorđeva 64</a></li>                   
					<li><a href="mailto:info@valjevo.rs">info@valjevo.rs</a></li>
					<li><a href="tel:+38114294900">+381 (14) 294 900</a></li>           -->
					@guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
									<li><a href="home">Moji {{ Auth::user()->role }} </a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
				</ul>
			</div>
		</div>
	</div>
	<!-- /Top header -->

	<!-- Mid header -->
	<div class="mid-header">
		<div class="wrap">
			<div class="col-4 logo">
				<a href=""><figure>
          <img src="img/Grb-Grad-Valjevo.png">
        </figure></a>
			</div>			


			<div class="col-2">
				&nbsp;
			</div>		


			<div class="col-4">

				<div class="soc-search">
					<div class="fl-l">
						<ul>
							<li><a href=""><i class="fa fa-facebook"></i></a></li>
							<li><a href=""><i class="fa fa-linkedin"></i></a></li>
							<li><a href=""><i class="fa fa-twitter"></i></a></li>
							<li><a href=""><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
					<div class="fl-r">
						<div class="lang">
							<li><a href="">eng</a></li>
							<li><a href="">lat</a></li>
						</div>
						
					</div>
				</div>
			</div>			


		</div>
	</div>
	<!-- /Mid header -->