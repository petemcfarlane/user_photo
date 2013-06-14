<form id="photoform" method="post" enctype="multipart/form-data">
	<fieldset class="personalblock">
		<legend><strong>User Photo</strong></legend>
		<img class="photoimg" src="<?php p( OCP\Util::linkTo( 'user_photo', 'index.php' ) . "/photo/$_[user]/140?" . time() ); ?>" />
		<br>
		<label for="upload_photo" class="tag">Upload New Photo</label>
		<input class="hidden" type="file" name="user_photo" id="upload_photo" accept="image/*" />
		<button id="delphotobutton">Delete Photo</button>
		<em class="hidden" id="ajax_loading">Loading...</em>
	</fieldset>
</form>