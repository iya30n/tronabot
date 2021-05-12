<?php

$router->get('', 'HomeController@index');
$router->get('setWebhook', 'WebhookController@set');
$router->get('deleteWebhook', 'WebhookController@delete');