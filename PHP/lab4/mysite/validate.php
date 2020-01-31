<?php require_once('header.php')?>
<main class="content">
    <form action="index.php" onsubmit="return validateForm()">
        <table>
            <tr>
                <td>Name:</td>
                <td class="formElem"><input type="text" id="Name" oninput="validate()" placeholder="Name" /></td>
                <td id="NameErr" class="err"></td>
            </tr>
            <tr>
                <td>Surname:</td>
                <td class="formElem"><input type="text" id="Surname" oninput="validate()" placeholder="Surname" /></td>
                <td id="SurnameErr" class="err"></td>
            </tr>
            <tr>
                <td>Patronymic:</td>
                <td class="formElem"><input type="text" id="Patronymic" oninput="validate()" placeholder="Patronymic" /></td>
                <td id="PatronymicErr" class="err"></td>
            </tr>
            <tr>
                <td>Age:</td>
                <td title="Choose your age." class="formElem clear">
                    <select>
                        <option value="1">under 16</option>
                        <option value="2">16-21</option>
                        <option value="3">21-27</option>
                        <option value="4">27-35</option>
                        <option value="5">35-45</option>
                        <option value="6">45-55</option>
                        <option value="7">above 55</option>
                    </select>
                </td>
                <td></td>
            </tr>
            <tr>
                <td id="about">About you:</td>
                <td class="formElem clear"><textarea cols="25" id="About" rows="10" placeholder="about me" oninput="validateTA()"></textarea></td>
                <td id="AboutErr" class="err"></td>
            </tr>
            <tr>
                <td></td>
                <td class="formElem clear"><input id="submitButton" type="submit" value="submit" /></td>
                <td></td>
            </tr>
        </table>
    </form>
</main>
<?php require_once('footer.php')?>
