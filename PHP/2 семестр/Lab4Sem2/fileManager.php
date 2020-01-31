<?php
require('header.php');
?>
<span class="col2" id="BlueSpace">File Manager</span>
<div style="overflow-y: scroll; overflow-x: hidden; padding: 2px;float: left; height: 542px; margin-left: 13px; width: 553px;border-width: 1px; border-color: blue; border-style: solid;">
	<?php
	function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}
		function compareByTime($a, $b)
		{
			$directory = $_GET['path'];
			$ROOTDIR = getcwd().$directory;
			if (filemtime($ROOTDIR.DIRECTORY_SEPARATOR.$a) == filemtime($ROOTDIR.DIRECTORY_SEPARATOR.$b)) {
				return 0;
			}
			return (filemtime($ROOTDIR.DIRECTORY_SEPARATOR.$a) < filemtime($ROOTDIR.DIRECTORY_SEPARATOR.$b)) ? -1 : 1;
		}
		function compareBySize($a, $b)
		{
			$directory = $_GET['path'];
			$ROOTDIR = getcwd().$directory;
			if (filesize($ROOTDIR.DIRECTORY_SEPARATOR.$a) == filesize($ROOTDIR.DIRECTORY_SEPARATOR.$b)) {
				return 0;
			}
			return (filesize($ROOTDIR.DIRECTORY_SEPARATOR.$a) < filesize($ROOTDIR.DIRECTORY_SEPARATOR.$b)) ? -1 : 1;
		}
		function compareByTimeInv($a, $b)
		{
			$directory = $_GET['path'];
			$ROOTDIR = getcwd().$directory;
			if (filemtime($ROOTDIR.DIRECTORY_SEPARATOR.$a) == filemtime($ROOTDIR.DIRECTORY_SEPARATOR.$b)) {
				return 0;
			}
			return (filemtime($ROOTDIR.DIRECTORY_SEPARATOR.$a) > filemtime($ROOTDIR.DIRECTORY_SEPARATOR.$b)) ? -1 : 1;
		}
		function compareBySizeInv($a, $b)
		{
			$directory = $_GET['path'];
			$ROOTDIR = getcwd().$directory;
			if (filesize($ROOTDIR.DIRECTORY_SEPARATOR.$a) == filesize($ROOTDIR.DIRECTORY_SEPARATOR.$b)) {
				return 0;
			}
			return (filesize($ROOTDIR.DIRECTORY_SEPARATOR.$a) > filesize($ROOTDIR.DIRECTORY_SEPARATOR.$b)) ? -1 : 1;
		}
		$directory = "";
		$sort = "";
		if(isset($_GET['sort']))
		{
			$sort = $_GET['sort'];
			//echo "PATH SET!!!";
		}
		else
		{
			
		}
		if(isset($_GET['path']))
		{
			$directory = $_GET['path'];
			//echo "PATH SET!!!";
		}
		else
		{
			//echo "PATH not SET!!!!";
		}
		//$inv = false;
		if(isset($_GET['inv']))
		{
			$inv = $_GET['inv'];
			if($inv ==1)
				$inv = true;
			else
				$inv = false;
			//echo "PATH SET!!!";
		}
		else
		{
			
		}
		$dotdotpos = strripos($directory, "..");
		if(!file_exists(getcwd().$directory)||$dotdotpos)
			$directory = "";
			$ROOTDIR = getcwd().$directory;
		//echo "$ROOTDIR";
		$fileList = scandir($ROOTDIR);
		$fileList = 0;
		$fileList = scandir($ROOTDIR);
		if($inv == 1)
		{
			if($sort=="time")
			{
				usort($fileList, "compareByTimeInv");
			}
			elseif($sort=="size")
			{
				usort($fileList, "compareBySizeInv");
			}
			else
			{
				$fileList = scandir($ROOTDIR,1);
			}
		}
		else
		{
			if($sort=="time")
			{
				usort($fileList, "compareByTime");
			}
			elseif($sort=="size")
			{
				usort($fileList, "compareBySize");
			}
			else
			{
				$fileList = scandir($ROOTDIR);
			}
		}
		$notinv=!$inv;
		echo "<div style = 'width: 540px;'><a href='fileManager.php?path=$path&sort=name&inv=$notinv' style = 'float: left; color: black; margin-left: 22px; width: 150px;'>Name</a><a href='fileManager.php?path=$path&sort=time&inv=$notinv' style = 'color: black; float: left; margin-left: 19px; width: 150px;'>Creation Date</a><a href='fileManager.php?path=$path&sort=size&inv=$notinv' style = 'color: black; float: left; margin-left: 37px;'>Size</a></div>";
		foreach ($fileList as $key=>$value)
		{
			if(is_dir($ROOTDIR.DIRECTORY_SEPARATOR.$value))
			{
				if ($value == "..")
				{
					$pos = strripos($directory, "\\");
					$rest = substr($directory, 0, $pos);
					$path = $rest;
				}
				else
					$path = $directory.DIRECTORY_SEPARATOR.$value;
				$lastEdit = date ("F d Y", filemtime($ROOTDIR.DIRECTORY_SEPARATOR.$value)); 
				echo "<div class = 'file'><div class = 'FMiandn'>
				<a href='fileManager.php?path=$path&sort=name&inv=' style = 'display: block; color: black;'>
				<img src = 'IMG/folder.png' class = 'FMicon'>$value</a></div>
				<div class = 'FMlastEdit'>$lastEdit</div></div>";
			}
			elseif (is_file($ROOTDIR.DIRECTORY_SEPARATOR.$value))
			{
				$size = FileSizeConvert(filesize($ROOTDIR.DIRECTORY_SEPARATOR.$value));
				$lastEdit = date ("F d Y", filemtime($ROOTDIR.DIRECTORY_SEPARATOR.$value));
				echo "<div class = 'file'><div class = 'FMiandn'>
				<div float: left; href='#'><img src ='IMG/file.png' class = 'FMicon'>$value</div>
				</div><div class = 'FMlastEdit'>$lastEdit</div><div style = 'margin-left: 100px; float: left;'>$size</div></div>";
			}
			echo "</hr>";
		}
	?>
</div>
<?php
require('footer.php');
?>