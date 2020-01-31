<?php require('header.php');?>
    <?php
        function valiadte($name, $surname, $patronymic, $about)
        {
            $name = trim($name);
            $surname = trim($surname);
            $patronymic = trim($patronymic);
            $about = trim($about);
            $isSuccessed = Array(false, false, false, false);
            $isSuccessed[0] =  preg_match("/^[a-z\s]+$/i",$name);
            $isSuccessed[1] =  preg_match("/^[a-z\s]+$/i",$surname);
            $isSuccessed[2] =  preg_match("/^[a-z\s]+$/i",$patronymic);
            $isSuccessed[3] =  preg_match("/^[a-z\s]+$/i",$about);
            $res = true;
            foreach ($isSuccessed as $isSucc)
            {
                $res = $res && $isSucc;
            }
            if($res)
            {
                echo "<p style='color: green;'>SUCCESS</p>";
            }
            else{
                echo "<p style='color: red;'>ERROR</p>";

            }
            if(preg_match("/^[a-z\s]+$/i",$name)){
                echo "<p>neme - DONE</p>";
            }
            else{
                echo "<p>NEME - ERR</p>";
            }
            if(preg_match("/^[a-z\s]+$/i",$surname)){
                echo "<p>surname - DONE</p>";
            }
            else{
                echo "<p>surname - ERR</p>";
            }
            if(preg_match("/^[a-z\s]+$/i",$patronymic))
            {echo "<p>patronymic - DONE</p>";}
            else{
                echo "<p>patronymic - ERR</p>";
            }
            if(preg_match("/^[a-z\d\s\.,]+$/i",$about))
            {echo "<p>about - DONE</p>";}
            else{
                echo "<p>about - ERR</p>";
            }
        };


        $action = "";
        if(isset($_GET['formact']))
        {
            $action = "GET";
        }elseif (isset($_POST['formact']))
        {
            $action = "POST";
        }

        switch ($action)
        {
            case "GET":
                valiadte($_GET['Name'],$_GET['Surname'], $_GET['Patronymic'],  $_GET['About']); break;
            case "POST":
                valiadte($_POST['Name'],$_POST['Surname'], $_POST['Patronymic'],  $_POST['About']); break;
        }



    /*    echo "".$_POST['formact']."";
        if(isset($_POST['Name']))
        {
            echo "POST";
        }
        if(isset($_GET['Name']))
        {
            echo "GET";
        }*/


    ?>
<?php require('footer.php');?>
