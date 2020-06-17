<?

$config = array(
    'domain' => [
        'ru_RU' =>'lpcandy.ru',
        'en_EN' =>'en.lpcandy.ru',
    ],
    'smtp' => [
        'host' => 'localhost',
        'port' => '25',
        'username' => '',
        'password' => ''
    ],
    'entityTypes' => [
        'track' => [
            'public_create' => true,
            'public_edit' => false,
            'public_read' => false,
            'upload' => true
        ],
        'project' => [
            'public_create' => false,
            'public_edit' => false,
            'public_read' => true,
            'upload' => true
        ],
    ]
);