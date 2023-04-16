<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>

<div class="categories">
    <h4>Категории товаров</h4>
    <div class="slider-categories">
        <?foreach ($arResult["SECTIONS"] as $SECTION):?>
        <a href="<?=$SECTION["SECTION_PAGE_URL"]?>" class="item">
            <span class="name"><?=$SECTION["NAME"]?></span>
            <span class="total"><?=$SECTION["ELEMENT_CNT"]?></span>
        </a>
        <?endforeach;?>
    </div>
</div>