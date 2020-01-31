<?php
require('header.php');
?>
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src='scripts/register1.js'></script>
<script src='scripts/jquery.jcarousel.min.js'></script>
<script type="text/javascript" src="scripts/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="scripts/jcarousel.basic.js"></script>
<link rel="stylesheet" type="text/css" href="style/jcarousel.basic.css">
	<span class="col2" id="BlueSpace">Form</span>
	<div class="col2" id="blueBorder1">
	<div id = "formblock">
		<form method = "post" id = "register" action="#">
                                        <div class="clear">
                                            <div class="formElem"><input value = ""class = "formPart" name = "name" type="text" id="Name" placeholder="Name" /></div>
                                            <span id="NameErr" class="err"></span>
                                        </div>
                            
								
                                        <div class="clear">
											<span class = "formTitles">Gender</span>
											<div>
												<input type="radio" id="contactChoice1"
													   name="gender" value="male" checked>
												<label for="contactChoice1">Male</label>
												<input type="radio" id="contactChoice2"
													   name="gender" value="female">
												<label for="contactChoice2">Female</label>
											</div>
                                        </div>
                            
                                        <div class="clear">
											<span class = "formTitles">Date of birth</span>
											<div id="dateOf">
											
											<input class="DateElem" name = "day" id="Day" maxlength = "2" placeholder="dd" />
											<input class="DateElem" name = "month" id="Month" maxlength = "2" placeholder="mm" />
											<input class="DateElem" name = "year" id="Year" maxlength = "4" placeholder="yyyy" />
                                            
											</div>
											<span id="text-error-for-date" class="err"></span>
                                        </div>
                            <div class="formElem clear"><input id = "submit" class = "formPart"  type="submit" value="submit" /></div>                            
                        </form>
						
	</div>
	</div>
<?php
require('footer.php');
?>