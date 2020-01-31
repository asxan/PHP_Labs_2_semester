<?php
	function printItem($prod_year, $type, $prod_country, $id){
		echo("
				<p>Year: $prod_year</p>
				<p>Country: $prod_country</p>
				<p>Type: $type</p>
				<a onclick='hide($id)' href='#'>Hide</a>
		");
	}
	if(isset($_GET['id']))
	{
	$xmlPath="xml/shop.xml";
		
		if(file_exists($xmlPath))
		{
			$dom = new DOMDocument('1.0', 'utf-8');
			$dom->load($xmlPath);
			if($dom->validate())
			{
				$root = $dom->documentElement;
				$items = $root->childNodes;
				foreach($items as $dental)
				{
					if(($dental->nodeType == XML_ELEMENT_NODE)&& ($_GET['id']==$dental->getAttribute('id')))
					{
						$id = $_GET['id'];
						$prod_country = $dental->getElementsByTagName("prod_country")[0]->nodeValue;
						$type = $dental->getElementsByTagName("type")[0]->nodeValue;
						$prod_year = $dental->getElementsByTagName("prod_year")[0]->nodeValue;
						printItem($prod_year,$type,$prod_country, $id);
					}
				}
			}
			else
			{
				echo('<p class="error">Wrong path to xml</p>');
			}
		}
		else echo('<p class="error">ID error</p>');
	}
	else
	{
		echo('<p class="error">ID error</p>');
	}
?>