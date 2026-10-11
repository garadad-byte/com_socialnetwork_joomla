<?php
declare(strict_types=1);

defined('_JEXEC') or die;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php $this->fetch('head'); ?>
	<link rel="stylesheet" href="<?php echo JUri::root(true); ?>/media/com_socialnetwork/css/app.css" />
	<link rel="stylesheet" href="<?php echo JUri::root(true); ?>/templates/tmpl_socialplus/css/template.css" />
	<script src="<?php echo JUri::root(true); ?>/media/com_socialnetwork/js/app.js" defer></script>
</head>
<body>
	<div class="socialnetwork-shell">
		<header class="socialnetwork-header">
			<div class="brand">Social Network</div>
			<nav class="top-nav">
				<a href="#">Feed</a>
				<a href="#">Profile</a>
				<a href="#">Communities</a>
				<a href="#">Circles</a>
			</nav>
		</header>
		<div class="socialnetwork-layout">
			<aside class="socialnetwork-sidebar">
				<ul>
					<li>Home</li>
					<li>Posts</li>
					<li>Notifications</li>
					<li>Messages</li>
				</ul>
			</aside>
			<main class="socialnetwork-main">
				<?php echo $this->loadTemplate(); ?>
			</main>
			<aside class="socialnetwork-rail">
				<div class="widget">Trending</div>
				<div class="widget">Circles</div>
				<div class="widget">Communities</div>
			</aside>
		</div>
	</div>
</body>
</html>
