<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');


date_default_timezone_set('Europe/London');


require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel-1.8/Classes/PHPExcel.php';
$excel = PHPExcel_IOFactory::load($_SERVER['DOCUMENT_ROOT'] . '/upload/test_import/testt.xlsx');
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

function sectionAdd($name)
{
    $params = array(
        "max_len" => "100", // обрезает символьный код до 100 символов
        "change_case" => "L", // буквы преобразуются к нижнему регистру
        "replace_space" => "_", // меняем пробелы на нижнее подчеркивание
        "replace_other" => "_", // меняем левые символы на нижнее подчеркивание
        "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
        "use_google" => "false", // отключаем использование google
    );

    $bs = new CIBlockSection;

    $arFields = array(
        "ACTIVE" => "Y",
        "IBLOCK_ID" => 1,
        "NAME" => $name,
        "CODE" => CUtil::translit($name, "ru", $params),
    );
    $bs->Add($arFields);

}

function addProduct($elem)
{
    $paramsItem = array(
        "max_len" => "100", // обрезает символьный код до 100 символов
        "change_case" => "L", // буквы преобразуются к нижнему регистру
        "replace_space" => "_", // меняем пробелы на нижнее подчеркивание
        "replace_other" => "_", // меняем левые символы на нижнее подчеркивание
        "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
        "use_google" => "false", // отключаем использование google
    );

    $el = new CIBlockElement;

    $PROP = [];
    $PROP["BREND"] = $elem["Бренд"];

    $arLoadProductArray = array(
        "IBLOCK_ID" => 1,
        "IBLOCK_SECTION_ID" => $elem["secion_id"],
        "XML_ID" => $elem["ID"],
        "PROPERTY_VALUES" => $PROP,
        "NAME" => $elem["Название"],
        "ACTIVE" => "Y",
        "PREVIEW_TEXT" => $elem["Название"],
        "DETAIL_TEXT" => $elem["Название"],
        "PREVIEW_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . "/upload/no_image.png"),
        "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . "/upload/no_image.png"),
        "CODE" => CUtil::translit($elem["Название"], "ru", $paramsItem),
    );

    if ($PRODUCT_ID = $el->Add($arLoadProductArray)) {
        $arFields1 = array(
            "ID" => $PRODUCT_ID,
            "TYPE " => \Bitrix\Catalog\ProductTable::TYPE_PRODUCT
        );
        CCatalogProduct::Add($arFields1);
        priceProduct($PRODUCT_ID, $elem['Цена']);
        amountProduct($PRODUCT_ID, $elem['Доступное количество']);
    } else {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/error_log.txt', print_r(['NEW' => $elem], true), FILE_APPEND);
    }
}

function updateProduct($elem, $PRODUCT_ID)
{

    $el = new CIBlockElement;

    $PROP = [];
    $PROP["BREND"] = $elem["Бренд"];

    $arLoadProductArray = array(
        "IBLOCK_ID" => 1,
        "IBLOCK_SECTION_ID" => $elem["secion_id"],
        "XML_ID" => $elem["ID"],
        "PROPERTY_VALUES" => $PROP,
        "NAME" => $elem["Название"],
        "ACTIVE" => "Y",
        "PREVIEW_TEXT" => $elem["Название"],
        "DETAIL_TEXT" => $elem["Название"],
        "PREVIEW_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . "/upload/no_image.png"),
        "DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . "/upload/no_image.png"),
    );
    priceProduct($PRODUCT_ID, $elem['Цена']);
    amountProduct($PRODUCT_ID, $elem['Доступное количество']);
    if (!$el->Update($PRODUCT_ID, $arLoadProductArray)) {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/error_log.txt', print_r(['UPDATE' => $elem], true), FILE_APPEND);
    }
}

function priceProduct($PRODUCT_ID, $PRICE)
{
    $PRICE = explode(' ',$PRICE)[0];

    $arFields = array(
        "PRODUCT_ID" => $PRODUCT_ID,
        "CATALOG_GROUP_ID" => 1,
        "PRICE" => $PRICE,
        "CURRENCY" => "RUB",
    );

    $res = CPrice::GetList(
        array(),
        array(
            "PRODUCT_ID" => $PRODUCT_ID,
            "CATALOG_GROUP_ID" => 1
        )
    );

    if ($arr = $res->Fetch()) {
        CPrice::Update($arr["ID"], $arFields);
    } else {
        CPrice::Add($arFields);
    }
}

function amountProduct($PRODUCT_ID, $AMOUNT)
{
    $arFields = array(
        "PRODUCT_ID" => $PRODUCT_ID,
        "STORE_ID" => 1,
        "AMOUNT" => $AMOUNT,
    );
    $rsStore = CCatalogStoreProduct::GetList(array(), array(
        'PRODUCT_ID' => $PRODUCT_ID,
        'STORE_ID' => 1),
        false,
        false,
        array('ID'));

    if ($arStore = $rsStore->Fetch()) {
        CCatalogStoreProduct::Update($arStore["ID"], $arFields);
    } else {
        CCatalogStoreProduct::Add($arFields);
    }

}

//Получение и добавление разделов в инфоблок
$sectionRequest = CIBlockSection::GetList(
    array("SORT" => "ASC"),
    array('IBLOCK_ID' => 1),
    false,
    array('ID', 'NAME'),
    false
);
$sections = [];

while ($sect = $sectionRequest->GetNext()) {
    $sections[] = $sect;
}


$infoSect = [];

foreach ($sections as $nameSect) {
    if (!in_array($nameSect["NAME"], $infoSect)) {
        $infoSect[] = $nameSect["NAME"];
    }
}

foreach ($excel->getWorksheetIterator() as $worksheet) {
    $lists[] = $worksheet->toArray();
}

echo "<pre>";
$product = [];
$props = $lists[0][0];
$nameSection = [];

foreach ($lists[0] as $key => $list) {
    // Перебор строк
    foreach ($list as $k => $propProduct) {
        $tmp[$props[$k]] = $propProduct;
    }
    $product[] = $tmp;
    $tmp = [];

}
unset($product[0]);
foreach ($product as $nameSect) {
    if (!in_array($nameSect["Раздел"], $nameSection)) {
        $nameSection[] = $nameSect["Раздел"];
    }
}

foreach ($nameSection as $valueSect) {
    if (!in_array($valueSect, $infoSect)) {
        sectionAdd($valueSect);
    }
}

$sectionRequest = CIBlockSection::GetList(
    array("SORT" => "ASC"),
    array('IBLOCK_ID' => 1),
    false,
    array('ID', 'NAME'),
    false
);
$sections = [];

while ($sect = $sectionRequest->GetNext()) {
    $sections[$sect['NAME']] = $sect;
}

//Получение и добавление элементов в разделы
$item = CIBlockElement::GetList(
    array("SORT" => "ASC"),
    array('IBLOCK_ID' => 1),
    false,
    false,
    array("ID", "XML_ID")
);

$productSite = [];

while ($sect = $item->GetNext()) {
    $productSite[$sect["XML_ID"]] = $sect;
}

foreach ($product as &$el) {
    $el['secion_id'] = $sections[$el["Раздел"]]["ID"];
}

foreach ($product as $valueSect) {
    if (isset($productSite[$valueSect["ID"]])) {
        updateProduct($valueSect, $productSite[$valueSect["ID"]]['ID']);
    } else {
        addProduct($valueSect);
    }
}
