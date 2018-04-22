<div class="search">
	<form  action="search" method="get" enctype="multipart/form-data" >
		<input type="text"  name="search" value=""  placeholder="Pretraga"/>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

	</form>
</div>