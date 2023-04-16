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
$this->setFrameMode(true);


?>
<?php file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/test.txt', print_r($arResult['ITEMS'], true))?>

<div class="catalog-filter">
    <div class="section">
        <h4>Стоимость, руб</h4>
        <div class="item-range">
            <div class="top">
                <div class="input-range">
                    <input class="minCost" value="0" type="text">
                </div>
                <div class="sep"></div>
                <div class="input-range">
                    <input class="maxCost" value="1000" type="text">
                </div>
            </div>
            <div class="slider-range">
                <div class="slider-range-cost"></div>
            </div>
        </div>
    </div>

    <div class="section">
        <? foreach ($arResult['ITEMS'] as $k => $filterProp): ?>
            <? if ($k == 'BASE') {
                continue;
            } ?>
            <h4><?= $filterProp['NAME'] ?></h4>
            <div class="custom-scrollbar">
                <? foreach ($filterProp['VALUES'] as $key => $Val): ?>
                    <div class="item-checkbox">
                        <label data-role="label_<?= $Val["CONTROL_ID"] ?>"
                               class="bx-filter-param-label <? echo $Val["DISABLED"] ? 'disabled' : '' ?>"
                               for="<? echo $Val["CONTROL_ID"] ?>">
                            <input class="appli_check"
                                    data-elemet-count="<?= $Val['ELEMENT_COUNT'] ?>" name="<?= $Val['CONTROL_NAME'] ?>"
                                    id="<?= $Val['CONTROL_ID'] ?>"
                                    type="checkbox">
                            <span>

                            </span><?= $key ?>
                        </label>
                    </div>
                <? endforeach; ?>
            </div>
        <? endforeach; ?>

    </div>
    <div class="buttons flex-row justify-space">
        <a href="/catalog/filter/clear/apply/" class="reset">Сбросить</a>
        <a href="" class="bt-2 submit-filter">показать (12)</a>
    </div>
</div>


<script>
    let filter = '';
     $('.appli_check').on('click', function (){
         let nameParam = $(this).attr('name');
         if (filter.length > 0){
             filter += '&' + nameParam + '=Y';
         } else {
             filter += '?ajax=y&' + nameParam + '=Y';
         }
         $.ajax({
             url: filter,
             method: 'get',
             dataType: 'text',
             success: function(data){
                 let start = data.indexOf('FILTER_URL');
                 let end = data.indexOf(',', start);
                 let tmp = data.slice(start, end);
                 let url = tmp.split(':')[1];
                 url = url.slice(1, -1);
                 $('.submit-filter').attr('href', url);
             },
         });
     })

    $('.minCost').on('blur', function (){
        let sum = $(this).val();
        if (filter.length > 0){
            filter += '&' + 'arrFilter_P1_MIN=' + sum;
        } else {
            filter += '?ajax=y&arrFilter_P1_MIN=' + sum;
        }
        $.ajax({
            url: filter,
            method: 'get',
            dataType: 'text',
            success: function(data){
                let start = data.indexOf('FILTER_URL');
                let end = data.indexOf(',', start);
                let tmp = data.slice(start, end);
                let url = tmp.split(':')[1];
                url = url.slice(1, -1);
                $('.submit-filter').attr('href', url);
            },
        });
    })

    $('.maxCost').on('blur', function (){
        let sum = $(this).val();
        if (filter.length > 0){
            filter += '&' + 'arrFilter_P1_MAX=' + sum;
        } else {
            filter += '?ajax=y&arrFilter_P1_MAX=' + sum;
        }
        $.ajax({
            url: filter,
            method: 'get',
            dataType: 'text',
            success: function(data){
                let start = data.indexOf('FILTER_URL');
                let end = data.indexOf(',', start);
                let tmp = data.slice(start, end);
                let url = tmp.split(':')[1];
                url = url.slice(1, -1);
                $('.submit-filter').attr('href', url);
            },
        });
    })

</script>