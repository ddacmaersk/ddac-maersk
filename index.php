<?php require_once (__DIR__.'/controller/init.php');?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Head -->
        <?php 
            $page = Param::get('page'); 
            require_once (__DIR__.'/view/components/head.php'); 
        ?>
	</head>
	
	<body class="site" style="background: url(https://protiumdesign.com/wp-content/uploads/2017/01/Blurred-Sunset-Background.jpg);background-size: cover;">
		<!-- Navigation -->
		<?php require_once (__DIR__.'/view/components/nav.php'); ?>
		
        <!-- Page -->
        <main class="site-content">
		<?php
            //Get page
            if ($page) {
                if(file_exists(__DIR__.'/view/pages/'.$page.'.php')){
                    require_once(__DIR__.'/view/pages/'.$page.'.php');
                }
                else {
                    header('Location: error404');
                    exit();
                }
            }
            else {
                header('Location: '.Config::get('home'));
                exit();
            }
        ?>
        </main>
	</body>
</html>