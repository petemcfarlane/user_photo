<?php

/**
 * ownCloud - user_photo
 *
 * @author Jorge Rafael García Ramos
 * @copyright 2012 Jorge Rafael García Ramos <kadukeitor@gmail.com>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

OCP\JSON::checkLoggedIn();
OCP\JSON::checkAppEnabled('user_photo');
OCP\JSON::callCheck();



if (isset ($_FILES['user_photo'])) {
	$file = $_FILES['user_photo'];
	$uid = OC_User::getUser();
	
	if(file_exists($file['tmp_name'])) {
		$image = new OC_Image();
		if($image->loadFromFile($file['tmp_name'])) {
			if($image->width() > 400 || $image->height() > 400) {
				$image->resize(400); // Prettier resizing than with browser and saves bandwidth.
			}
			$type = $image->mimeType();
			$string = $image->__toString();
			OC_Preferences::setValue( $uid , 'user_photo', 'photo', $string );
			OCP\JSON::success(array("uid" => $uid));
			exit();
		}
	}
	exit;
}
  