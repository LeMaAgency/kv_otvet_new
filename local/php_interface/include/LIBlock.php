<?php

/**
 * Class LIblock
 */
class LIblock
{
    /**
     * @var array
     */
    protected static $iblocks = array();
    /**
     * @var array
     */
    protected static $props = array();
    /**
     * @var array
     */
    protected static $propValues = array();
    /**
     * @var array
     */
    protected static $iblockSections = array();

    /**
     * @var string
     */
    protected static $cacheKey = 'LIblockData';
    /**
     * @var int
     */
    protected static $cacheTime = 2592000;


    /**
     * @return array
     */
    public static function getPropEnumValues($propId = null)
    {
        if(empty(static::$propValues))
            static::loadData();

        if(isset($propId))
            return isset(static::$propValues[$propId]) ? static::$propValues[$propId] : false;
        else
            return static::$propValues;
    }

    /**
     * @param $iblockCode string IBlock symbolic code
     * @return bool|int
     */
    public static function getId($iblockCode)
    {
        if(empty(static::$iblocks))
            static::loadData();

        if(isset(static::$iblocks[$iblockCode]))
            return static::$iblocks[$iblockCode];

        return false;
    }

    /**
     * @param $iblockCode string IBlock symbolic code
     * @param $propCode string property symbolic code
     *
     * @return bool|null
     */
    public static function getPropId($iblockCode, $propCode)
    {
        if(empty(static::$props))
            static::loadData();

        $iblockId = static::getId($iblockCode);
        if(!$iblockId)
            return false;

        if(isset(static::$props[$iblockId][$propCode]))
            return static::$props[$iblockId][$propCode];

        return false;
    }

    /**
     * @param $iblockCode
     * @param $propCode
     * @param $xmlId
     *
     * @return bool|mixed
     */
    public static function getPropEnumId($iblockCode, $propCode, $xmlId)
    {
        if(empty(static::$propValues))
            static::loadData();

        $propId = static::getPropId($iblockCode, $propCode);

        if(!$propId)
            return false;

        if(isset(static::$propValues[$propId][$xmlId]['ID']))
            return static::$propValues[$propId][$xmlId]['ID'];

        return false;
    }

    /**
     * @param $iblockCode
     * @param $sectionCode
     *
     * @return bool|mixed
     */
    public static function getSectionInfo($iblockCode, $sectionCodeOrId, $byCode = true)
    {
        if(empty(static::$iblockSections))
            static::loadData();

        $iblockId = static::getId($iblockCode);
        if(!$iblockId)
            return false;

        $key = $byCode ? 'BY_CODE' : 'BY_ID';

        if(isset(static::$iblockSections[$iblockId][$key][$sectionCodeOrId]))
            return static::$iblockSections[$iblockId][$key][$sectionCodeOrId];

        return false;
    }
    /**
     * @param $iblockCode
     * @param $sectionCode
     *
     * @return bool|mixed
     */
    public static function getSectionsByIblockCode($iblockCode, $byCode = true)
    {
        if(empty(static::$iblockSections))
            static::loadData();

        $iblockId = static::getId($iblockCode);
        if(!$iblockId)
            return false;

        $key = $byCode ? 'BY_CODE' : 'BY_ID';

        if(isset(static::$iblockSections[$iblockId][$key]))
            return static::$iblockSections[$iblockId][$key];

        return false;
    }
    /**
     * @param $iblockCode
     * @param $sectionCode
     *
     * @return bool|mixed
     */
    public static function getSectionsByIblockId($iblockId, $byCode = true)
    {
        if(empty(static::$iblockSections))
            static::loadData();

        if(!$iblockId)
            return false;

        $key = $byCode ? 'BY_CODE' : 'BY_ID';

        if(isset(static::$iblockSections[$iblockId][$key]))
            return static::$iblockSections[$iblockId][$key];

        return false;
    }

    /**
     * Load iblock data to variables
     */
    protected static function loadData()
    {
        if(!\Bitrix\Main\Loader::includeModule('iblock'))
            return;

        $cache = new \CPHPCache();

        $cache_path = '/'.self::$cacheKey.'/';

        if($cache->InitCache(static::$cacheTime, static::$cacheKey, $cache_path))
        {
            $cacheData = $cache->GetVars();
            static::$iblocks = $cacheData['iblocks'];
            static::$props = $cacheData['props'];
            static::$propValues = $cacheData['propValues'];
            static::$iblockSections = $cacheData['iblockSections'];
        }
        else
        {
            $cache->StartDataCache(static::$cacheTime, static::$cacheKey, $cache_path);

            static::loadIBlocks();
            static::loadProperties();
            static::loadIBlockSections();

            $cache->EndDataCache(array(
                'iblocks' => static::$iblocks,
                'props'  => static::$props,
                'propValues' => static::$propValues,
                'iblockSections' => static::$iblockSections,
            ));
        }
    }

    /**
     * Load iblocks to variable
     */
    protected static function loadIBlocks()
    {
        static::$iblocks = array();
        $res = \CIBlock::GetList(
            array('ID' => 'ASC'),
            array(
                'ACTIVE' => 'Y',
                'CHECK_PERMISSIONS' => 'N'
            )
        );
        while($row = $res->Fetch())
        {
            if(!empty($row['CODE']))
                static::$iblocks[$row['CODE']] = (int) $row['ID'];
        }
    }

    /**
     * Load properties to variable
     */
    protected static function loadProperties()
    {
        static::$props = array();
        static::$propValues = array();

        $res = \CIBlockProperty::GetList(
            array(),
            array('ACTIVE' => 'Y')
        );
        while($row = $res->Fetch())
        {
            if(empty(static::$props[$row['IBLOCK_ID']]))
                static::$props[$row['IBLOCK_ID']] = array();

            if($row['CODE'])
            {
                static::$props[$row['IBLOCK_ID']][$row['CODE']] = (int) $row['ID'];

                if($row['PROPERTY_TYPE'] == 'L')
                {
                    if(empty(static::$propValues[$row['ID']]))
                        static::$propValues[$row['ID']] = array();

                    $resProp = \CIBlockPropertyEnum::GetList(
                        array(),
                        array('PROPERTY_ID' => $row['ID'])
                    );
                    while($arrProp = $resProp->Fetch())
                    {
                        if($arrProp['XML_ID'])
                            static::$propValues[$row['ID']][$arrProp['XML_ID']] = $arrProp;
                    }
                }
            }
        }
    }

    /**
     * Load iblock sections to variable
     */
    protected static function loadIBlockSections()
    {
        static::loadIBlocks();

        $res = CIBlockSection::GetList(array(), array('ID', 'CODE', 'NAME', 'IBLOCK_ID', 'IBLOCK_SECTION_ID'));

        while($row = $res->Fetch())
        {
            if(!empty($row['CODE']))
            {
                static::$iblockSections[$row['IBLOCK_ID']]['BY_CODE'][$row['CODE']] = $row;
                static::$iblockSections[$row['IBLOCK_ID']]['BY_ID'][$row['ID']] = $row;
            }
        }
    }

    /**
     * Clear cache
     * @return boolean
     */
    public static function clearCache()
    {
        $obCache = new \CPHPCache();
        $obCache->CleanDir('/' . static::$cacheKey . '/');
        return true;
    }

}


// IBlock events
\AddEventHandler('iblock', 'OnAfterIBlockAdd', array('LIblock', 'clearCache'));
\AddEventHandler('iblock', 'OnAfterIBlockUpdate', array('LIblock', 'clearCache'));
\AddEventHandler('iblock', 'OnBeforeIBlockDelete', array('LIblock', 'clearCache'));
// IBlock property events
\AddEventHandler('iblock', 'OnAfterIBlockPropertyAdd', array('LIblock', 'clearCache'));
\AddEventHandler('iblock', 'OnAfterIBlockPropertyUpdate', array('LIblock', 'clearCache'));
\AddEventHandler('iblock', 'OnBeforeIBlockPropertyDelete', array('LIblock', 'clearCache'));