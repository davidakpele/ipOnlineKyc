<?php
/* Smarty version 5.3.1, created on 2024-06-22 16:08:29
  from 'file:index.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.3.1',
  'unifunc' => 'content_6676dadd712c74_86170518',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '618f0272b637898f52e0682c2b6d05d7383998ac' => 
    array (
      0 => 'index.tpl',
      1 => 1719065309,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6676dadd712c74_86170518 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\ipOnline\\app\\views\\templates';
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta name="theme-color" content="#c9190c">
            <meta name="robots" content="index,follow">
            <meta htttp-equiv="Cache-control" content="no-cache">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="msapplication-TileColor" content="#c9190c">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <meta name="keywords" content="" />
            <meta name="description" content="" />
            <link href="<?php echo $_smarty_tpl->getValue('assets_link');?>
css/styles.css" rel="stylesheet">
            <link href="<?php echo $_smarty_tpl->getValue('assets_link');?>
css/bootstrap.min.css" rel="stylesheet">
            <link href="<?php echo $_smarty_tpl->getValue('assets_link');?>
fontawesome/css/all.css" rel="stylesheet">
            <link href="<?php echo $_smarty_tpl->getValue('assets_link');?>
css/styles.css" rel="stylesheet">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <?php echo '<script'; ?>
 type='text/javascript' src='<?php echo $_smarty_tpl->getValue('assets_link');?>
js/jquery.min.js'><?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
 type='text/javascript' src='<?php echo $_smarty_tpl->getValue('assets_link');?>
js/bootstrap.min.js'><?php echo '</script'; ?>
>
            <title><?php echo $_smarty_tpl->getValue('page_title');?>
</title>
        </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="<?php echo $_smarty_tpl->getValue('root_link');?>
auth/register">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $_smarty_tpl->getValue('root_link');?>
auth/login">Login</a>
      </li>
    </ul>
  </div>
</nav>
<div class="container">
<h2>Welcome to ipOnline User Platform</h2>
</div>
</body>
</html><?php }
}
