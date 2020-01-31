<?php
require_once ('header.php');
require_once ('XMLparse.php');
$products = getProducts();
?>
    <div class="magazine">
        <div class="wrapper">
            <?php foreach ($products as $product) : ?>
                <div class="product clear-both">
                    <div class="product-thumb">
                        <img class="thumbnail" alt="product-thumb" src="<?= $product["IMAGE"] ?>"/>
                    </div>
                    <div class="info">
                        <span class="product-name"><?= $product["NAME"] ?></span>
                        <span class="product-model"><?= $product["MODEL"] ?></span>
                        <table>
                            <tr>
                                <td>Display:</td>
                                <td><?= $product["DISPLAY"] ?></td>
                            </tr>
                            <tr>
                                <td>Year:</td>
                                <td><?= $product["PROD_YEAR"] ?></td>
                            </tr>
                            <tr>
                                <td>CPU:</td>
                                <td><?= $product["CPU"] ?></td>
                            </tr>
                            <tr>
                                <td>Serial number:</td>
                                <td><?= $product["SERIAL_NUMBER"] ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="price">
                        <span>Цена: <?= $product["PRICE"] ?> ₴</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php require_once ('footer.php'); ?>