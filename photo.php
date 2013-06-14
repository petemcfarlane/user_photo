<?php
/**
 * Copyright (c) 2012 Thomas Tanghus <thomas@tanghus.net>
 * Copyright (c) 2011, 2012 Bart Visscher <bartv@thisnet.nl>
 * Copyright (c) 2011 Jakob Sack mail@jakobsack.de
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

// Init owncloud

OCP\User::checkLoggedIn();
OCP\App::checkAppEnabled('user_photo');

function getStandardImage() {
	//OCP\Response::setExpiresHeader('P10D');
	OCP\Response::enableCaching();
	OCP\Response::redirect(OCP\Util::imagePath('user_photo', 'photo.jpg'));
	exit;
}

$uid = isset($params['uid'] ) ? $params['uid'] : NULL; 
$etag = NULL;
$thumb = isset($params['thumb'] ) ? $params['thumb'] : NULL; 
$encoded_image = OC_Preferences::getValue($uid, 'user_photo', 'photo');

if(!$uid || $uid === 'new') {
	getStandardImage();
}

if(!extension_loaded('gd') || !function_exists('gd_info')) {
	OCP\Util::writeLog('contacts',
		'photo.php. GD module not installed', OCP\Util::DEBUG);
	getStandardImage();
}

$image = new OC_Image();
if (!$image) {
	getStandardImage();
}

if (!$encoded_image || !$image->loadFromBase64((string)$encoded_image)) {
	getStandardImage();
}
if ($image->valid() && $thumb) {
	if ($image->width() > $thumb || $image->height() > $thumb) {
		$image->centerCrop();
		$image->resize($thumb);
	}
}

if (!$image->valid()) {
	getStandardImage();
}

OCP\Response::enableCaching();
OCP\Response::setExpiresHeader('P1D');
$etag = md5($encoded_image);
OCP\Response::setETagHeader($etag);
header('Content-Type: '.$image->mimeType());
$image->show();