<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"></link>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="favicon.ico" />
    <?php include_stylesheets() ?>
  </head>
    <body>
	<!-- Container -->
    	<!-- Header -->
    	<?php
           include_partial('global/header');
        ?>
    	<!-- Header Ends -->
        <!-- Content -->
        <?php echo $sf_content ?>
        <!-- Content Ends -->
        <!-- Footer -->
        <?php include_partial('global/footer') ?>
        <!-- Footer -->
    <!-- Container Ends -->
  </body>
  <?php include_javascripts() ?>
</html>
