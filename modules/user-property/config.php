<?php
/**
 * user-property config file
 * @package user-property
 * @version 0.0.1
 * @upgrade true
 */

return [
    '__name' => 'user-property',
    '__version' => '0.0.1',
    '__git' => 'https://github.com/getphun/user-property',
    '__files' => [
        'modules/user-property' => [
            'install',
            'remove',
            'update'
        ]
    ],
    '__dependencies' => [
        'user'
    ],
    '_services' => [],
    '_autoload' => [
        'classes' => [
            'UserProperty\\Model\\UserProperty' => 'modules/user-property/model/UserProperty.php',
            'UserProperty\\Library\\User' => 'modules/user-property/library/User.php'
        ],
        'files' => []
    ]
];