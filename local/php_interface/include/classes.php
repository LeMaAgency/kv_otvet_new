<?php

\Bitrix\Main\Loader::includeModule('lema.lib');

class DomclickExport extends \Lema\Base\XmlExport
{
    /**
     * Show YML file
     *
     * @param array $params
     * @return mixed
     *
     * @access public
     */
    public function showData(array $params = array())
    {
        if(!empty($params['sendHeader']))
        {
            header('Content-type: text/xml; charset=' . SITE_CHARSET);
        }

        ?><<?php ?>?xml version="1.0" encoding="<?=SITE_CHARSET?>"?>
<realty-feed xmlns="http://webmaster.yandex.ru/schemas/feed/realty/2010-06">
    <generation-date><?=isset($this->time) ? date('c', $this->time) : date('c')?></generation-date>
    <?foreach($this->products as $id => $info):
        $alternateDescr = null;
        ?>

        <offer internal-id="<?=$id?>">

            <?foreach($params['fields'] as $name => $key):
            ?>
                <?if(is_array($key)):?>
                    <<?=$name;?>>
                        <?foreach($key as $innerName => $innerKey):
                            $value = array_key_exists($innerKey, $info) ? htmlspecialcharsbx($info[$innerKey]) : $innerKey;
                            if(empty($value))
                                continue;
                            ?>
                            <<?=$innerName;?>><?=$value;?></<?=$innerName?>>
                        <?endforeach;?>
                    </<?=$name;?>>
                <?else:
                    if(!isset($info[$key]))
                        continue;
                    ?>
                    <<?=$name;?>><?=isset($info[$key]) ? htmlspecialcharsbx($info[$key]) : null;?></<?=$name?>>
                <?endif;?>
            <?endforeach;?>

            <?foreach($params['checkValueFields'] as $name => $key):
                ?>
                <?if(is_array($key) && !empty($info[$key['value']])):?>
                    <<?=$name;?>>
                    <?foreach($key as $innerName => $innerKey):
                        $value = array_key_exists($innerKey, $info) ? htmlspecialcharsbx($info[$innerKey]) : $innerKey;
                        if(empty($value))
                            continue;
                        ?>
                        <<?=$innerName;?>><?=$value;?></<?=$innerName?>>
                    <?endforeach;?>
                    </<?=$name;?>>
                <?endif;?>
            <?endforeach;?>
            <<?=$info['areaTypeTag'];?>>
                <value><?=$info['PROPERTY_SQUARE_VALUE'];?></value>
                <unit>кв. м</unit>
            </<?=$info['areaTypeTag'];?>>


            <?if(in_array($info['category'], array('дом с участком', 'участок'))):?>
                <land-space>
                    <value><?=$info['PROPERTY_SQUARE_VALUE'];?></value>
                    <unit>кв. м</unit>
                </land-space>
            <?endif;?>

            <?if(!empty($info['images'])):?>
                <?foreach($info['images'] as $src):?>
                    <image><?=$this->serverUrl . $src;?></image>
                <?endforeach;?>
            <?endif;?>

            <?if(!empty($params['params'])):?>
                    <?foreach($params['params'] as $data):
                        if(empty($info[$data[1]]))
                            continue;
                        $alternateDescr .= $data[0] . ': ' . $info[$data[1]] . ';' . PHP_EOL;
                        ?>
                        <param name="<?=$data[0];?>"<?if(isset($data['unit'])){?>
                            unit="<?=$data['unit']?>"<?}?>><?=htmlspecialcharsbx($info[$data[1]]);?></param>
                    <?endforeach;?>
                <?endif;?>
            <?
            $description = trim($info[(empty($info['DETAIL_TEXT']) ? 'PREVIEW' : 'DETAIL') . '_TEXT']);
            if(empty($description))
                $description = trim($alternateDescr);
            ?>
            <description><?=htmlspecialcharsbx($description);?></description>

        </offer>

    <?endforeach;?>
</realty-feed>
        <?php
    }
}


class DomSakhExport extends \Lema\Base\XmlExport
{
    /**
     * Show YML file
     *
     * @param array $params
     *
     * @return mixed
     *
     * @access public
     */
    public function showData(array $params = array())
    {
        if(!empty($params['sendHeader']))
        {
            header('Content-type: text/xml; charset=' . SITE_CHARSET);
        }

        ?><<?php ?>?xml version="1.0" encoding="<?=SITE_CHARSET?>"?>
<dom-sakh-com xmlns="http://sakh.com/schemas/feed/dom/2013-11">
    <generation-date><?=isset($this->time) ? date('c', $this->time) : date('c')?></generation-date>
    <?
    foreach($this->products as $id => $info):
        $alternateDescr = null;
        ?>

    <offer internal-id="<?=$id?>">
        <?
        foreach($params['fields'] as $name => $key):
            if(!isset($info[$key]))
            {
                continue;
            }
            ?>
            <<?=$name;?>><?=isset($info[$key]) ? htmlspecialcharsbx(is_array($info[$key]) ? join(', ', $info[$key]) : $info[$key]) : null;?></<?=$name?>>
        <? endforeach; ?>
        <location>
            <locality-name><?=$info['locality-name']?></locality-name>
            <sub-locality-name><?=$info['sub-locality-name']?></sub-locality-name>
            <address><?=$info['address']?></address>
        </location>
        <sales-agent>
            <nick>Kv-otvet</nick>
            <name><?=$info['PROPERTY_USER_NAME_VALUE'];?></name>
            <phone><?=$info['PROPERTY_USER_PHONE_VALUE'];?></phone>
            <email><?=$info['PROPERTY_USER_EMAIL_VALUE'];?></email>
        </sales-agent>
        <price>
            <value><?=$info['PROPERTY_PRICE_VALUE'];?></value>
        </price>
        <?if(in_array($info['category'], array('дом', 'земля'))):?>
            <land-space><?=$info['PROPERTY_SQUARE_VALUE'];?></land-space>
        <?else:?>
            <area><?=$info['PROPERTY_SQUARE_VALUE'];?></area>
        <?endif;?>

        <?
        if(!empty($info['images'])):?>
            <?
            foreach($info['images'] as $src):?>
                <image><?=$this->serverUrl . $src;?></image>
            <? endforeach; ?>
        <? endif; ?>

        <?if(!empty($params['boolListFields'])):?>
            <?foreach($params['boolListFields'] as $name => $key):
                $value = isset($info[$key]) && ($info[$key] == 'Y' || $info[$key] === true) ? 'true' : 'false';
                ?>
                <<?=$name;?>><?=$value;?></<?=$name?>>
            <? endforeach; ?>
        <? endif; ?>
        <?
        if(!empty($params['params'])):?>
            <?
            foreach($params['params'] as $data):
                if(empty($info[$data[1]]))
                {
                    continue;
                }
                $alternateDescr .= $data[0] . ': ' . $info[$data[1]] . ';' . PHP_EOL;
                ?>
                <param name="<?=$data[0];?>"<?
                if(isset($data['unit']))
                {
                    ?>
                    unit="<?=$data['unit']?>"<?
                } ?>><?=htmlspecialcharsbx($info[$data[1]]);?></param>
            <? endforeach; ?>
        <? endif; ?>
        <?
        $description = trim($info[(empty($info['DETAIL_TEXT']) ? 'PREVIEW' : 'DETAIL') . '_TEXT']);
        if(empty($description))
        {
            $description = trim($alternateDescr);
        }
        ?>
        <description><?=htmlspecialcharsbx($description);?></description>

        </offer>

    <? endforeach; ?>
</dom-sakh-com>
        <?php
    }
}