<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<nav class="header-top-menu">

<?
foreach($arResult as $arItem):
	if($arParams['MAX_LEVEL'] == 1 && $arItem['DEPTH_LEVEL'] > 1)
		continue;
?>
	<?if($arItem['SELECTED']):?>
		<a href="<?=$arItem['LINK']?>" class="header-top-menu-link selected"><?=$arItem['TEXT']?></a>
	<?else:?>
		<a class="header-top-menu-link" href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
	<?endif?>

<?endforeach?>

</nav>
<?endif?>