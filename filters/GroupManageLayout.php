<?php
/**
 * Created by PhpStorm.
 * User: DezMonT
 * Date: 28.02.2015
 * Time: 19:34
 */

namespace app\filters;

use Yii;
use yii\helpers\Url;

class GroupManageLayout extends GroupLayout
{
    public $layout = 'subTabbedLayout';

    public static  function getActiveMap()
    {
        $active_map =  array_merge(parent::getActiveMap(),[
            'beacons' => [GroupManageLayout::beacons()],
            'update' => [GroupManageLayout::update()],
        ]);
        return $active_map;
    }

    public static function layout(array $active = [])
    {
        $nav_bar = parent::layout(array_merge($active,[TabbedLayout::update()]));
        return $nav_bar;
    }



    public static function getLeftSubTabs(array $active = [])
    {
        $tabs =  [

            ['label'=>Yii::t('group_layout', ':group_update'),'url'=>Url::to(['group/update'] +  self::getParams()),'active'=>self::getActive($active,GroupManageLayout::update())],
            ['label'=>Yii::t('group_layout', ':group_view'),'url'=>Url::to(['group/view'] + $_GET),'active'=>self::getActive($active,TabbedLayout::view())],
            ['label'=>Yii::t('group_layout', ':group_beacons'),'url'=>Url::to(['group/beacons'] +  self::getParams()),'active'=>self::getActive($active,GroupManageLayout::beacons())],
        ];
        return $tabs;
    }

}