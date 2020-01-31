<?php
require('header.php');
?>
<script type="text/javascript" src="scripts/form.js"></script>
	<span class="col2" id="BlueSpace">Form</span>
	<div class="col2" id="blueBorder1">
	<div id = "formblock">
		<form method = "post" action="validate.php">
                                        <div class="clear">
                                            <div class="formElem"><input value = ""class = "formPart" name = "name" type="text" id="Name" oninput="validate();" placeholder="Name" /></div>
                                            <div id="NameErr" class="err"></div>
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
											<div>
                                            <input class="DateElem" type="number" name = "day" id="Day" min = "1" max = "31" maxlength = "2" oninput="validateDate();" placeholder="dd" />
											<input class="DateElem" type="number" name = "month" id="Month" min = "1" max = "12" maxlength = "2" pattern = "[0-9]{1,2}" oninput="validateDate();" placeholder="mm" />
											<input class="DateElem" type="number" name = "year" id="Year" min = "1800" maxlength = "4" oninput="validateDate();" placeholder="yyyy" />
                                            <div id="DayErr" class="err"></div>
											<div id="PatronymicErr" class="err"></div>
											</div>
                                        </div>
                            <div class="formElem clear"><input id = "submit" class = "formPart"  type="submit" value="submit" /></div>                            
                        </form>
	</div>
	</div>
<?php
require('footer.php');
?>