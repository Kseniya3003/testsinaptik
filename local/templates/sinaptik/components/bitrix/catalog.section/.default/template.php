<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

$this->setFrameMode(true);
?>
<!--<pre>-->
<!--    --><?//var_dump($arResult["ITEMS"]);?>
<!--</pre>-->
				<div class="flex-row">
                    <?foreach ($arResult["ITEMS"] as $ITEM):?>
					<div class="item-product">
						<div class="markers">
							<span class="marker-gray">Персональная акция</span>
						</div>
						<div class="side-markers">
							<span class="marker-orange">-10%</span>
							<span class="marker-violet">хит</span>
							<span class="marker-green">new</span>
						</div>
						<div class="image">
							<img src="<?=$ITEM["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$ITEM["NAME"]?>">
						</div>
						<div class="price">
							<span><?=$ITEM["PRICES"]["BASE"]["PRINT_VALUE"]?></span>
						</div>
						<div class="title"><?=$ITEM["NAME"]?></div>
						<p><?=$ITEM["PREVIEW_TEXT"]?></p>
						<div class="buttons">
							<a href="" class="bt-2">В корзину</a>
							<a href="<?=$ITEM["DETAIL_PAGE_URL"]?>" class="more"><span></span><span></span><span></span></a>
						</div>
					</div>
                    <?endforeach;?>


				<div class="pagination flex-row justify-center">
					<a href="" class="prev"></a>
					<a href="" class="active">1</a>
					<a href="">2</a>
					<a href="">3</a>
					<a href="">4</a>
					<span>...</span>
					<a href="">12</a>
					<a href="" class="next"></a>
				</div>

