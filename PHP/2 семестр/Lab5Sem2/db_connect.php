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
$test = $db_new -> query('SELECT * FROM items_type ORDER BY Id_Items_Type ASC');
echo "<div class='categories'><p id = 'catTitle'>Categories</p>";
if (count($test)== 0)
{
	echo "No results";
}
else
foreach ($test as $tests)
{
	echo "<a href='db_item_type.php?item_type=$tests[Type_Name]' style = 'display: block; border-color: #20207E; border-width: 1px;  border-bottom-width: 0px; border-style: solid; color: white;'>$tests[Type_Name]</a>";
}
echo "<hr id = 'catHr' noshade><div>";
?>
<?php
require('footer.php');
?>