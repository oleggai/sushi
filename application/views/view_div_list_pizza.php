<div id="div_pizza">
    <div style="text-align: center; margin: 0 auto; font-size: 22px; color: #911c1d;">
    <?php echo $val["name_product"];?>
    </div>
    <a href='<?php echo URL;?>public/img<?php echo $val["image_large"];?>' data-lightbox="roadtrip"><img height='220' src='<?php echo URL;?>public/img<?php echo $val["image"];?>'></a>
    <span style="color: red;">
        Компоненты:
    </span>
    &nbsp;
    <span>
        <?php echo $val["compound"];?>
    </span>
    <div style="margin: 0 auto; text-align: center;">
    <img src="<?php echo URL;?>public/img/pizza/br_short.png">
    </div>
    <div style="position: relative; top: -10px; margin: 0 auto; text-align: center;">
        <?php foreach($val["diameter_weight_price"] as $key => $value) {?><br>
        <div style="position: relative; display: inline-block;"><img src="<?php echo URL;?>public/img/pizza/diam.png"> <?php echo $value["diameter"];?>&nbsp;см</div>
        <div style="position: relative; margin-left:10px; display: inline-block; color: #911c1d; font-size: 18px; font-weight: bold;"><?php echo $value["weight"];?>&nbsp;г</div>
        <div class="want">
            <?php echo $value["price"];?>&nbsp;Грн&nbsp;&nbsp;
            <a id="order" id-product="<?php echo $val["id_product"];?>" id-type-product="<?php echo $value["id_type"];?>" style="color: #911c1d;">
                <span>Хочу</span>
            </a>
        </div>
    <?php }?>
    </div>
</div>