<?
global $USER;
$rsUsers = CUser::GetList(
    ($by = 'NAME'),
    ($order = 'asc'),
    Array('GROUPS_ID' => Array(3), 'ACTIVE' => 'Y'),
    Array(
        'FIELDS' => array(
            'ID',
            'NAME',
            'LAST_NAME',
            'PERSONAL_PHOTO',
            'PERSONAL_PHONE'
        ),
        'NAV_PARAMS' => array(
            'nTopCount' => $arParams['NEWS_COUNT'],
        )
    )
);
while ($arUser = $rsUsers->Fetch()) {
    $arSpecUser[] = $arUser;
}
$arResult['ITEMS'] = $arSpecUser;

$arResult['OBJECTS_COUNT'] = 0;

$users = array();
foreach($arResult['ITEMS'] as $arItem)
    $users[$arItem['ID']] = array();

$section = \LIblock::getSectionInfo('objects', 'active');

$sectionId = empty($section['ID']) ? -1 : (int) $section['ID'];

$res = \CIBlockElement::GetList(
    array(),
    array(
        'SECTION_ID' => $sectionId,
        'IBLOCK_ID' => \LIblock::getId('objects'),
        'PROPERTY_RIELTOR' => array_keys($users),
        'ACTIVE' => 'Y',
        'INCLUDE_SUBSECTIONS' => 'Y'
    ),
    false,
    false,
    array('ID', 'PROPERTY_RIELTOR')
);

while($row = $res->Fetch())
{
    if(!empty($row['PROPERTY_RIELTOR_VALUE']))
        $users[$row['PROPERTY_RIELTOR_VALUE']][] = $row['ID'];
}

foreach($users as $k => $v)
    $users[$k] = count($v);

foreach($arResult['ITEMS'] as $k => $v)
{
    $arResult['ITEMS'][$k]['OBJECTS_COUNT'] = isset($users[$k]) ? (int) $users[$k] : 0;
}