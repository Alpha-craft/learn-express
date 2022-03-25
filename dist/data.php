<?php
$email = $_SESSION['email'];
$currUser = get_user($conn, 'email', "'".$email."'");
$currUserRoles = explode(',', $currUser['role']);


$sidebar = [
  [
    'label' => 'Pembelajaran',
    'item' => [
      [
        'icon' => 'history',
        'label' => 'Absensi',
        'url' => '/absensi'
      ],       
      [
        'icon' => 'calendar',
        'label' => 'Kalender',
        'url' => '/kalender'
      ],
      [
        'icon' => 'school',
        'label' => 'Tugas',
        'url' => '/tugas'
      ],
    ]    
  ],
  [
    'label' => 'Organisasi',
    'item' => [
      [
        'icon' => 'users',
        'label' => 'Group Chat',
        'url' => '/organisasi/group-chat'
      ],       
      [
        'icon' => 'wallet',
        'label' => 'Keuangan Masjid',
        'url' => '/organisasi/keuangan'
      ],
      [
        'icon' => 'photo-video',
        'label' => 'Galeri',
        'url' => '/organisasi/galeri'
      ],
    ]    
  ],
];

if( in_array('pengajar', $currUserRoles) ){
  array_push($sidebar, [
    'label' => 'Halaman Pengajar',
    'item' => [
      [
        'icon' => 'school',
        'label' => 'Buat Assignment',
        'url' => '/tugas/new.php'
      ], 
      [
        'icon' => 'school',
        'label' => 'Buat Absensi',
        'url' => '/absensi/new.php'
      ], 
    ]
  ]);
}

if( in_array('bendahara', $currUserRoles) ){
  array_push($sidebar, [
    'label' => 'Halaman Bendahara',
    'item' => [
      [
        'icon' => 'wallet',
        'label' => 'Masukkan Data Keuangan',
        'url' => '/organisasi/keuangan/new.php'
      ] 
    ]
  ]);
}


?>