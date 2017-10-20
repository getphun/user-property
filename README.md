# user-property

Adalah modul yang menambah properti user hingga tak terbatas. Mengingat modul `user`
hanya menyimpan data minimal user, modul ini ada untuk menambah data user yang
lebih banyak.

Modul ini membutuhkan konfigurasi tambahan pada level aplikasi yang berisi daftar
properti user yang ingin ditambahkan beserta tipe nya. Contoh konfigurasi tersebut
adalah sebagai berikut:

```php
// ./etc/config.php

return [
    'name' => 'Phun',
    ...
    'user_property' => [
        'avatar' => [
            'form-position' => 'center',
            'type'  => 'file',
            'label' => 'Avatar',
            'rules' => [
                'file' => 'image/*'
            ],
            'format' => 'media'
        ],
        'birthday' => [
            'form-position' => 'left',
            'type'  => 'date',
            'label' => 'Birthday',
            'rules' => [
                'date' => 'Y-m-d'
            ],
            'format' => 'date'
        ]
    ]
];
```

Silahkan mengacu pada wiki untuk informasi lebih lanjut tentang konfigurasi user
properti.