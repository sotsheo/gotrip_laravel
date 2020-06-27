

<div class="btn-search-header">
	<form action="{{route('search')}}" id="headerSearch" method="post">
		<input class="input-text" type="search" name="t" placeholder="Tìm kiếm tin bài..." autocomplete="off" value="<?= (isset($_GET['t']))?  $_GET['t'] :'' ?>" >
		<input class="btn-submit" type="submit" value="tìm kiếm">
		<div class="cancel"></div>
	</form>
</div>
