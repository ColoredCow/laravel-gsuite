<?php

return [
	'database' => [
		'user-columns' => [
			/**
			 * When storing user avatar, we need to know what column in the users table should
			 * capture it. The default column name is "avatar" but you may easily change
			 * it to anything you prefer.
			 */
			'avatar' => 'avatar',
		]
	]
];
