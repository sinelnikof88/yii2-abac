<?php

return [
    
    'params' => [
        
        'objectsModels' => [
            'Пользователи' => \common\models\basic\activeRecord\Users::class,
            'Заявки' => \common\models\basic\activeRecord\Request::class,
            'Состояние' => \common\models\basic\activeRecord\ReqState::class,
            'Статус' => \common\models\basic\activeRecord\ReqStatus::class,
        ],
        'controllersModels' => []
    ],
];
