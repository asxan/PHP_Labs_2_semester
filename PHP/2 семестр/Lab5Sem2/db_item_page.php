<?php
require('header.php');
?>
<?php
class MySQL
{
	private $user;
	private $pass;
	private $host;
	private $db_name;
	private $db;
	public function __construct($u, $p, $h, $dname) 
	{
		$this -> user = $u;
		$this -> pass = $p;
		$this -> host = $h;
		$this -> db_name = $dname;
		$this ->db = null;
	}
	public function connect ($enc = "utf-8")
	{
		$this -> db = new mysqli($this -> host, $this -> user, $this -> pass, $this -> db_name);
		if ($this -> db -> connect_errno)
		{
			$this->logError("Не удалось подключиться к MySQL: ");
			die ($this -> db -> connect_error);
			return false;
		}
		$this->db->query("SET character_set_client = '$enc'");
		return true;
	}
	public function exec($sql)
	{
		if($this -> db == null)
			return false;
		$res = $this -> db -> query($sql);
			return $res;
	}
	public function query($sql)
	{
		if($this -> db == null)
		
		return false;
		$its = Array();
		if($res = $this -> db -> query($sql))
		{
			
			while($row = $res -> fetch_assoc())
			{
				$its[] = $row;
			}
			$res -> free();
		}
		else
		{
			
			return false;
		}
		return $its;
	}
	public function insert_id()
	{
		return $this -> db -> insert_id;
	}
	public function getError()
	{
		return $this -> db -> error;
	}
}
$db_new = new MySQL('root','','','goods_lab');
$db_new -> connect();
$Id_Items = "";
if(isset($_GET['Id_Items']))
		{
			$Id_Items = $_GET['Id_Items'];
		}
		///
		$curdate = $db_new -> query("SELECT CURDATE() as 'dt'");
		$dateInDb = $db_new -> query("SELECT dates as 'it' from views_stats where dates = '".$curdate[0]['dt']."' and Id_Items = '$Id_Items'");
		if(!(isset($_GET['detailed']) && ($_GET['detailed'] == 1 || $_GET['detailed'] == 0)))
		{
			if(count ($dateInDb)== 0)
			{
				$db_new -> exec("insert into views_stats(dates, Id_Items, views) values ('".$curdate[0]['dt']."', '.$Id_Items.', '1')");
			}
			else 
			{
				$db_new -> exec("update views_stats set views = views+1 WHERE Id_Items = '$Id_Items' and dates = '".$curdate[0]['dt']."'");
			}
		}
		
		
		///
		
$test = $db_new -> query("SELECT Name, brand, price, prod_country, prod_year, views,serial_number, image, description FROM items WHERE Id_Items = '$Id_Items'");
$err = $db_new ->getError;
echo '<div id="size">
<div id="list">';
if (count($test)== 0)
{
	echo "No results";
}
else
{
	echo '
		<div class="dental_motod">
            <div class="dental_img_block">
                <img class="thumbnail" alt="dental image" src="'.$test[0]['image'].'"/>
                
            </div>
            <div class="dental_info">
                <span class="dental_name dental_full_name">'.$test[0]['brand'].'</span>
                <span class="dental_model dental_full_name">'.$test[0]['Name'].'</span>
            </div>
			<div id="desc">
				<div class="dental_price">
                    <span>'.$test[0]['price'].'€</span>
				</div>
				<div style = "float: left; clear: both">
				<p>Year: '.$test[0]['prod_year'].'</p>
				<p>Country: '.$test[0]['prod_country'].'</p>
				<p>Serial Number: '.$test[0]['serial_number'].'</p>
				<p style="display: block; width: 500px; overflow: clip; word-wrap: break-word;" disabled readonly>Description: '.$test[0]['description'].'</p>
				
				
				
				
				';
				if(isset($_GET['detailed']) && $_GET['detailed'] == 1)
				{
					$week_stats = $db_new -> query("select sum(views) as 'week' from views_stats where Id_Items = '$Id_Items' and dates BETWEEN DATE_ADD(CURDATE(), INTERVAL -7 DAY) and CURDATE()");
					///
					$month_stats = $db_new -> query("select sum(views) as 'month' from views_stats where Id_Items = '$Id_Items' and dates BETWEEN DATE_ADD(CURDATE(), INTERVAL -1 MONTH) and CURDATE()");
					///
					$half_year_stats = $db_new -> query("select sum(views) as 'hyear' from views_stats where Id_Items = '$Id_Items' and dates BETWEEN DATE_ADD(CURDATE(), INTERVAL -6 MONTH) and CURDATE()");
				echo'
				<div  style ="float: right;" ><a style = "display: block; color: #20207E" href="db_item_page.php?Id_Items='.$Id_Items.'&detailed=0" style = "float: left; color: black; margin-left: 22px; width: 150px;">Detailed</a></div><br>
				<div style = "float: right; " >Views for week: '.$week_stats[0]['week'].'</div><br>
				<div style = "float: right; " >Views for month: '.$month_stats[0]['month'].'</div><br>
				<div style = "float: right; " >Views for half of year: '.$half_year_stats[0]['hyear'].'</div>';
				}
				else
				{
					$overal_stats = $db_new -> query("select sum(views) as 'overal' from views_stats where Id_Items = '$Id_Items'");
					echo'<div style = "float: right; clear:left;" >Views: '.$overal_stats[0]['overal'].'</div><br>';
					echo'<div style ="float: right;"><a style = "display: block; color: #20207E" href="db_item_page.php?Id_Items='.$Id_Items.'&detailed=1" style = "float: left; color: black; margin-left: 22px; width: 150px;">Detailed</a></div>';
				}
				echo'</div>
			</div>
        </div>';
}
echo '</div>
</div>';
?>
<?php
require('footer.php');
?>