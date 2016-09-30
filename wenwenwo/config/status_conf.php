<?php
/**
 * Created by PhpStorm.
 * Class:
 * User: wym
 * Date: 2016/9/14
 * Time: 9:55
 */
return [
    'sms_status' => [
        'status' => [
            1=> ['name'=>'启用','class'=>'label label-info'],
            2=>['name'=>'禁用','class'=>'label label-default'],
            99=>['name'=>'删除','class'=>'label label-danger']
        ],
        'base' => [
            0=>'所有用户',
            1=>'未付费用户',
            2=>'已付费用户',
            3=>'普通会员'
        ],
        'typeid' => [
            0=>'所有类目',
            1=>'建筑施工',
            2=>'建筑财务',
            3=>'工程咨询',
            4=>'建筑财务'
        ]
    ],
];