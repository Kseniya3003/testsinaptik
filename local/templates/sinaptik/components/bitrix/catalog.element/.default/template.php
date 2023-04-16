<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);?>
<!--<pre>-->
<?//var_dump($arResult); ?>
<!--</pre>-->
<div class="vieport-wrapper">

    <div class="card-page">
        <div class="container">

            <div class="breadcrumbs">
                <ul class="flex-row">
                    <li><a href="">Главная</a></li>
                    <li><a href="">Каталог товаров</a></li>
                    <li>Контурная пластика и биоревитализация</li>
                </ul>
            </div>

            <div class="flex-row justify-space">

                <div class="card-gallery">
                    <div class="slider-thumbnails">
                        <div class="item"><img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>"></div>
                    </div>
                    <div class="content">
                        <div class="markers">
                            <span class="marker-gray">Персональная акция</span>
                        </div>
                        <div class="side-markers">
                            <span class="marker-orange">-10%</span>
                            <span class="marker-violet">хит</span>
                            <span class="marker-green">new</span>
                        </div>
                        <div class="slider-gallery">
                            <div class="item"><img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["NAME"]?>"></div>
                        </div>
                    </div>
                </div>

                <div class="card-content">
                    <h1><?=$arResult["NAME"]?></h1>
                    <p><?=$arResult["PREVIEW_TEXT"]?></p>
                    <a href="" class="more">Подробнее</a>
                    <div class="panel">
                        <div class="flex-row justify-space align-center">
                            <div class="price"><?=$arResult["PRICES"]["BASE"]["VALUE"]?> р</div>
                            <a href="" class="share"></a>
                        </div>
                        <div class="tools">
                            <div class="bold">Количество</div>
                            <div class="flex-row">
                                <div class="amount-block">
                                    <div class="form-amount">
                                        <span class="minus"></span>
                                        <input type="text" value="1">
                                        <span class="plus"></span>
                                    </div>
                                </div>
                                <a href="" class="bt-2">В корзину</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="about-block">
        <article>
            <h3>Описание и характеристики товара</h3>
            <p><?=$arResult["DETAIL_TEXT"]?></p>        
        </article>
    </div>
</div>