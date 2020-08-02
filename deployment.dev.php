<?php
declare(strict_types=1);

return [
	'gabiamilan' => [
		'remote' => 'ftp://251653.w53.wedos.net/',
		'user' => 'w251653_w',
		'password' => 'Svatba_228',
		'local' => '.',
		'test' => false,
		'ignore' => '
			/deployment.*
			/log
			temp/*
			!temp/.htaccess
			*/tests
		',

		'include' => '
	/.htaccess
	/app
	/css
	/js
	/fonts
	/img
	/app/*
	/android-chrome-192x192.png
	/android-chrome-512x512.png
	/apple-touch-icon.png
	/favicon-16x16.png
	/favicon-32x32.png
	/favicon.ico
	/site.webmanifest
	/svatba.php
	/templates
        ',

		'allowDelete' => true,
		'before' => [
			function (Deployment\Server $server, Deployment\Logger $logger, Deployment\Deployer $deployer) {
				$logger->log('Hello!');
			},
		],
		'afterUpload' => [
			//'http://example.com/deployment.php?afterUpload',
		],
		'after' => [
			//'http://example.com/deployment.php?after',
		],
		'purge' => [
			'temp/cache',
		],
		'preprocess' => ['combined.js', 'combined.css'],
	],

	'tempDir' => __DIR__ . '/temp',
	'colors' => true,
];
