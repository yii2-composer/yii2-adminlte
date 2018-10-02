AdminLTE
========
simple way to use adminlte

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist liyifei/yii2-adminlte "*"
```

or add

```
"liyifei/yii2-adminlte": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \liyifei\adminlte\AutoloadExample::widget(); ?>
```

### 配置assetmanager，使用自带jquery及bootstrap替换yii2的jquery及bootstrap
```php
'components' => [
    'assetManager'=>[
        'bundles'=>[
            'yii\web\JqueryAsset'=>[
                'class'=>'liyifei\adminlte\bundles\JqueryAsset'
            ],
            'yii\bootstrap\BootstrapAsset'=>[
                'class'=>'liyifei\adminlte\bundles\BootstrapAsset'
            ]
        ]
    ],
],
```

### DatePicker
```php
<?= 
DatePicker::widget([
   'name' => 'asdfsadf',
   'value' => '2015-10-22',
])
?>
```

### DateRangePicker
```php
<?=
DateRangePicker::widget([
                            'name' => 'qwer',
                            'value' => ''
                        ])
?>
```

```php
<?=
DateRangePicker::widget([
                            'name_start' => 'q[wer]',
                            'name_stop' => 'a[sdf]',
                            'value_start' => '2015-10-22',
                            'value_stop' => '2015-11-22',
                            'seperate' => true
                        ])
?>
```

### DateTimeRangePicker
```php
<?=
DateTimeRangePicker::widget([
                                'name' => 'qwera',
                                'value' => ''
                            ])
?>
```

```php
<?=
DateTimeRangePicker::widget([
                                'name_start' => 'q[werx]',
                                'name_stop' => 'a[sdfx]',
                                'value_start' => '2015-10-22',
                                'value_stop' => '2015-11-22',
                                'seperate' => true
                            ])
?>
```

### TimePicker
```php
<?=
TimePicker::widget([
                       'name' => 'asdfsadf',
                       'value' => '11:11',
                   ])
?>
```

```php
<?=
TimePicker::widget([
                       'name' => 'asdfsadf',
                       'value' => '11:11:11',
                   ])
?>
```

### ColorPicker
```php
<?=
ColorPicker::widget([
                        'name' => 'asdfsadf',
                        'value' => '#db3d3d',
                    ])
?>
```

### Select
```php
<?=
Select::widget([
                   'name' => 'asdfasdf',
                   'multiple' => true,
                   'value' => ['a', 'b'],
                   'options' => [
                       'a' => 'aaaa',
                       'b' => 'bbbb',
                       'c' => 'cccc'
                   ]
               ])
?>
```

### Checkbox
```php
<?=
Checkbox::widget([
                     'name' => 'asdf',
                     'checked' => true,
                     'label' => 'asdfasdf'
                 ])
?>
```

### Radio
```php
<?=
Radio::widget([
                  'name' => 'asdf',
                  'values' => [
                      ['label' => 'asdfasdf', 'checked' => true],
                      ['label' => 'qwerqwer', 'enable' => false]
                  ]
              ])
?>
```

### Modal
```php
<?php
Modal::begin([
                 'size' => Modal::SIZE_LARGE,
                 'header' => 'Hello world',
                 'toggleButton' => ['label' => 'click me'],
             ]);

echo 'Say hello...';

Modal::end();
?>
```

### Tabs
```php
<?=
Tabs::widget([
                 'items' => [
                     [
                         'label' => 'One',
                         'content' => 'Anim pariatur cliche...',
                         'active' => true
                     ],
                     [
                         'label' => 'Two',
                         'content' => 'Anim pariatur cliche...',
                         'options' => ['id' => 'myveryownID'],
                     ],
                     [
                         'label' => 'Example',
                         'url' => 'http://www.example.com',
                         'linkOptions'=>['target'=>'_blank'],
                     ],
                     [
                         'label' => 'Dropdown',
                         'items' => [
                             [
                                 'label' => 'DropdownA',
                                 'content' => 'DropdownA, Anim pariatur cliche...',
                             ],
                             [
                                 'label' => 'DropdownB',
                                 'content' => 'DropdownB, Anim pariatur cliche...',
                             ],
                         ],
                     ],
                 ],
             ]);
?>
```
