<?php require('header.php');?>
<form method="post" action="ImageResize.php" enctype="multipart/form-data">
    <div><input type="file" name="img" required/></div>
    <div><input type="number" name="width" required min="1" max="1000" placeholder="width"/></div>
	<div><input type="number" name="height" required min="1" max="1000" placeholder="height"/></div>
    <div><input type="submit"/></div>
</form>
<?php require('footer.php');?>