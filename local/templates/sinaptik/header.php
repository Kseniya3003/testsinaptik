<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <? $APPLICATION->ShowHead(); ?>
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <link rel="icon" href="<?= SITE_TEMPLATE_PATH ?>/favicon.svg">

    <?

    use Bitrix\Main\Page\Asset;

    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/adapt.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/fancybox.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/fonts.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/magnific-popup.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/scrollbar.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/style.css");

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery-3.3.1.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery-ui.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.fancybox.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.magnific-popup.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.maskedinput.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.mcustomscrollbar.concat.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.nice-select.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.placeholder.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.toshowhide.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/slick.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/sticky.js");
    ?>


</head>
<body>
<div id="panel">
    <? $APPLICATION->ShowPanel(); ?>
</div>



