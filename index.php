<?php
OCP\User::checkLoggedIn();
OCP\App::checkAppEnabled('user_photo');

OCP\Util::addscript( 'user_photo', 'user_photo');
OCP\Util::addstyle( 'user_photo', 'styles');

$tmpl = new OCP\Template('user_photo', 'settings');

$tmpl->assign('user', OC_User::getUser());

return $tmpl->fetchPage();