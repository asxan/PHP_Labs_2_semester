<?php
require('header.php');
?>
<?php
$path_to_xml = 'xml/shop.xml';
?>
	<div id="size">
				<div id="list">
					<?php
						if(file_exists($path_to_xml)){//Есть ли файл
							// Создаём XML-документ
							$dom = new DOMDocument('1.0', 'utf-8');
							// Загружаем XML-документ из файла
							$dom->load($path_to_xml);
							// Получаем корневой элемент
							$root = $dom->documentElement;
							// Получаем дочерние элементы корневого элемента
							$items = $root->childNodes;
							// Перебираем полученные элементы
							if($dom != false){
									foreach ($items as $dental) {
										if ($dental->nodeType == XML_ELEMENT_NODE)
										{
											$dentalItem = $dental->childNodes;
											$id = $dental->getAttribute('id');
											$name = $dental->getElementsByTagName("name")[0]->nodeValue; 
											$model = $dental->getElementsByTagName("model")[0]->nodeValue;
											
											$price = $dental->getElementsByTagName("price")[0]->nodeValue;
											
											
											
											$thumbnail = $dental->getElementsByTagName("image")[0]->nodeValue;
											print_dental_motod($name, $model, $price, $thumbnail, $id);
										}
									}
							}else{
								echo "Некорректный xml файл";
							}
						}else{
							echo "xml файл не существует.";
						}
					?>
				</div>
         </div>
<?php
function print_dental_motod($name, $model, $price, $thumbnail, $id){
    echo '
		<script type="text/javascript" src="scripts/scriptik.js"></script>
        <div class="dental_motod">
            <div class="dental_img_block">
                <img class="thumbnail" alt="dental image" src="'.$thumbnail.'"/>
                
            </div>
            <div class="dental_info">
                <span class="dental_name dental_full_name">'.$name.'</span>
                <span class="dental_model dental_full_name">'.$model.'</span>
            </div>
			<div id="desc">
				<div class="dental_price">
                    <span>'.$price.'€</span>
				</div>
				<a onclick="req_f('.$id.')" href="#" id="btn">Show details</a>
				<div id="item'.$id.'" class="details"></div>
			</div>
        </div>
    ';
}
?>
<?php
require('footer.php');
?>