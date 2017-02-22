<?php

/**
 * For Simpla CMS
 *
 * @link		http://forum.simplacms.ru/profile/1024/Wizard
 * @author		Wizard
 *
 */

	session_start();
	chdir('..');
	require_once('api/Simpla.php');
	$simpla = new Simpla();
	$simpla->compare->add_item($simpla->request->get('compare', 'integer'));
	$compare = $simpla->compare->get_compare_informer();
	$simpla->design->assign('compare', $compare);

	$result = $simpla->design->fetch('compare_informer.tpl');
	header("Content-type: application/json; charset=UTF-8");
	header("Cache-Control: must-revalidate");
	header("Pragma: no-cache");
	header("Expires: -1");
    print json_encode($result);
