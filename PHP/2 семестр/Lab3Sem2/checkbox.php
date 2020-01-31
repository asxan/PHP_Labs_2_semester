<?php  require("header.php");?>	
<main>
<script src='../scripts/checkbox.js'></script>
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<?php
	for($i = 0; $i <= 10; $i++){
		echo "<input type='checkbox' id='check$i' style=''>$i</input>";
	}
?>
<input type='button' onclick='checkAll()' value='Check All'></input>
<input type='button' onclick='uncheckAll()' value='Uncheck All'></input>
<input type='button' onclick='invertAll()' value='Invert All'></input>
</main>
<?php require("footer.php");?>
