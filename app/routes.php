<?php

$router->get('', 'HomeController@index');
$router->get('setWebhook', 'WebhookController@set');
$router->get('getWebhookInfo', 'WebhookController@info');
$router->get('deleteWebhook', 'WebhookController@delete');

$router->post('getUpdate', 'BotController@getUpdate');
