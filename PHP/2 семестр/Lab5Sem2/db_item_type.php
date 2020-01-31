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
$item_type = "";
if(isset($_GET['item_type']))
		{
			$item_type = $_GET['item_type'];
		}
$test = $db_new -> query("SELECT Id_Items, Name, brand, price, image FROM items WHERE Id_Items_Type IN (SELECT Id_Items_Type FROM items_type WHERE Type_Name = '$item_type') ORDER BY Name ASC");
echo '<div id="size">
<div id="list">';
if (count($test)== 0)
{
	echo "No results";
}
else
foreach ($test as $tests)
{
	echo '
			<div class="dental_motod">
            <div class="dental_img_block">
                <img class="thumbnail" alt="dental image" src="'.$tests['image'].'"/>
                
            </div>
            <div class="dental_info">
                <span class="dental_name dental_full_name">'.$tests['brand'].'</span>
                <span class="dental_model dental_full_name">'.$tests['Name'].'</span>
            </div>
			<div id="desc">
				<div class="dental_price">
                    <span>'.$tests['price'].'€</span>
				</div>
				<a href="db_item_page.php?Id_Items='.$tests['Id_Items'].'" id="btn">Show details</a>
			</div>
        </div>';
}
echo '</div>
</div>';
?>
<?php
require('footer.php');
?>