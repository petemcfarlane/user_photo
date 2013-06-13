<?php
OCP\User::checkLoggedIn();
OCP\App::checkAppEnabled('user_photo');

$tmpl = new OCP\Template('user_photo', 'settings');

//$tmpl->assign('webROOT', OC::$WEBROOT );
$tmpl->assign('user', OC_User::getUser());

return $tmpl->fetchPage();