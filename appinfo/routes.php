<?php

// cloud/index.php/apps/user_photo/photo/Uid
$this->create('load_photo', '/photo/{uid}')->get()->action(
    function($params){
        require __DIR__ . '/../photo.php';
    }
);

// cloud/index.php/apps/user_photo/photo/Uid/thumb
$this->create('load_thumbnail', '/photo/{uid}/{thumb}')->get()->action(
    function($params){
        require __DIR__ . '/../photo.php';
    }
);
