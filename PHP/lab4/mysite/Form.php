<?php require('header.php');?>
<div id ="div_text">
                    <div class ="text_main">
                     <form action="server_info.php" method="post" onsubmit="return validateForm()">
                         <div>
                             <div id="sur_div">Surname:</div>
                             <div class="form_input"><input type="text" name="surname" placeholder="Surname" id="surname"/></div>
                             <div id="error_surname"></div>
                         </div>
                         <div class="form_clear">
                             <div><br>Name:</div>
                             <div class="form_input"><input type="text" name="Name" placeholder="Name" id="Name" /></div>
                             <div id="error_Name"></div>
                         </div>
                         <div class="form_clear">
                             <div><br>Patron:</div>
                             <div class="form_input"><input type="text" name="Patronymic" placeholder="Patron" id="Patronymic" /></div>
                             <div id="error_Patronymic"></div>
                         </div>
                         <div class="form_clear">
                             <div><br>Your old:</div>
                             <div><select name="select" placeholder="select" id="select">
                                <option value="1">Below 16</option>
                                <option value="2">16-21</option>
                                <option value="3">21-27</option>
                                <option value="4">27-35</option>
                                <option value="5">35-45</option>
                                <option value="6">45-55</option>
                                <option value="7">Under 55</option>
                             </select></div>
                         </div>

                         <div><br><input type="submit" name="submit" value="submit" /></div>
                        </form>
                    </div>
                </div>

<?php require('footer.php');?>