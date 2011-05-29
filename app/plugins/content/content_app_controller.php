<?php

class ContentAppController extends AppController
{
    var $pluginMenuOptions = array(
        'weight' => 70,
		'title' => 'Content',
        'icon'  => 'https://s3.amazonaws.com/willetts-architect-icons/FamFamFamSilk/page.png',
        'pluginButton' => array('plugin' => 'content', 'controller' => 'content_pages')
	);
}

?>