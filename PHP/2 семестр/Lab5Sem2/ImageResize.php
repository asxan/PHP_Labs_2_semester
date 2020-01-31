<?php
    $imagetype = null;

    function OpenImage($imgPath)
    {
        $img = false;

        //echo $imgPath;
        global $imagetype;
        $imagetype =  exif_imagetype($imgPath);
        switch ($imagetype)
        {
            case 1:  $img = @imagecreatefromgif($imgPath); break;
            case 2:  $img = @imagecreatefromjpeg($imgPath); break;
            case 3: $img = @imagecreatefrompng($imgPath);break;
            default: $img = false; break;
        }
        return $img;
    }

    function ImageOutout($img)
    {
        global $imagetype;
        switch ($imagetype)
        {
            case 1:  $img = imagegif($img); break;
            case 2:  $img = imagejpeg($img); break;
            case 3: $img = imagepng($img);break;
            default: $img = null; break;
        }
        return $img;
    }

    function ImageResize($img, $width, $height)
    {
        $srcWidth = imagesx($img);
        $srcHeight = imagesy($img);
        $dstWidth = $width;
        $dstHeigh = $height;
        $imgOut = imagecreatetruecolor($dstWidth, $dstHeigh);
		if ($dstWidth / $dstHeigh > $srcWidth / $srcHeight) {
			$lCroppedImageWidth = floor($srcWidth);
			$lCroppedImageHeight = floor($srcWidth * $dstHeigh / $dstWidth);
			$lInitialImageCroppingY = floor(($srcHeight - $lCroppedImageHeight) / 2);
		}
		else{
			$lCroppedImageWidth = floor($srcHeight * $dstWidth / $dstHeigh);
			$lCroppedImageHeight = floor($srcHeight);
			$lInitialImageCroppingX = floor(($srcWidth - $lCroppedImageWidth) / 2);
		}
			imagecopyresampled($imgOut,$img , 0,0,$lInitialImageCroppingX,$lInitialImageCroppingY, $dstWidth, $dstHeigh, $lCroppedImageWidth,$lCroppedImageHeight );
			return $imgOut;
	}


    if(isset($_FILES['img']))
    {
		$stamp = imagecreatefrompng('stamp.png');
		
		
		
		
		

        $imgPath = $_FILES['img']['tmp_name'];

        $img = OpenImage($_FILES['img']['tmp_name']);
        $width = $_POST['width'];
		$height = $_POST['height'];
        if($img === false)
        {
            echo 'failed';
        }
        else
        {
            header ('Content-Type: image/jpeg');
            //$imgColor = imagecreatetruecolor(300, 300);
            
            $imgOut =  ImageResize($img, $width, $height);
			// Установка полей для штампа и получение высоты/ширины штампа
			$marge_right = 10;
			$marge_bottom = 10;
			$sx = imagesx($stamp);
			$sy = imagesy($stamp);

			// Копирование изображения штампа на фотографию с помощью смещения края
			// и ширины фотографии для расчета позиционирования штампа. 
			imagecopy($imgOut, $stamp, 0, imagesy($imgOut) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

            // Write the string at the top left
            ImageOutout($imgOut);
        }
    }else{
        echo '<form method="post" action="ImageResize.php" enctype="multipart/form-data">
    <div><input type="file" name="img" required/></div>
    <div><input type="number" name="width" required min="1" max="1000" placeholder="width"/></div>
	<div><input type="number" name="height" required min="1" max="1000" placeholder="height"/></div>
    <div><input type="submit"/></div>
</form>';
    }
?>