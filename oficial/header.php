<?php
/* -----------------------------------------------------------------------
*  langHandler
*  -----------------------------------------------------------------------
*  Aprovechando que este módulo está aplicado en todas las paginas del
*  sitio, se incluye el langHandler aquí
*  -------------------------------------------------------------------- */
include("lang/langHandler.php");
?>
<header class="header header--brand header-original">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
					<span class="sr-only">Menu</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="./" class="navbar-brand"><img src="http://www.joygle.com/img/logo-joygle-big.png"></a>
			</div>
			<div class="collapse navbar-collapse" id="main-nav">
				<ul class="nav navbar-nav navbar-right">
				<ul class="nav navbar-nav" style="font-weight: 700;">
					<li><a href="../index.php">HOME</a></li>
					<li><a href="../about-us.php">OUR COMPANY</a></li>
					<li><a href="../sell.php">SELL</a></li>
					<li><a href="../mapping/index.php">MAPPING</a></li>
					<li><a href="../contact.php">CONTACT US</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ENG<span class="caret"></span></a>
						<ul class="dropdown-menu">
						<li><a href="#" onclick="switchLanguage('en')">English</a></li>
						<li><a href="#" onclick="switchLanguage('es')">Español</a></li>
						</ul>
					</li>
					<li><a href="#">+1 404-9573940</a></li>
				</ul>
				</ul>
			</div>
		</div>
	</nav>
	<!--
    <div class="container-header" style="display:none">
    	<div class="header__row">
			<a href="index.php" class="header__logo"><svg></svg></a>
			<div class="header__settings">
            	<div class="auth auth--header">
					<ul class="auth__nav">
						<li class="dropdown auth__nav-item">
							<a href="index.php" class="header__span-p1"><span class="header__span-p1"><?php echo MENU_ITEM1; ?></span></a>
						</li>
						<li class="dropdown auth__nav-item">
							<a href="about-us.php" class="header__span-p1"><span class="header__span-p1"><?php echo MENU_ITEM2; ?></span></a>
						</li>
						<li class="dropdown auth__nav-item">
							<a href="sell.php" class="header__span-p1"><span class="header__span-p1"><?php echo MENU_ITEM3; ?></span></a>
						</li>
						<li class="dropdown auth__nav-item">
							<a href="mapping/index.php" class="header__span-p1"><span class="header__span-p1">MAPPING</span></a>
						</li>
						<li class="dropdown auth__nav-item">
							<a href="contact.php" class="header__span-p1"><span class="header__span-p1"><?php echo MENU_ITEM4; ?></span></a>
						</li>
					</ul>
              <!-- end of block .auth header->
            	</div>
            	<div class="header__settings-column">
					<div class="dropdown dropdown--header">
						<button data-toggle="dropdown" type="button" class="dropdown-toggle dropdown__btn" style="font-weight:700; font-size:17px!important; ">
							<?php echo MENU_ITEM5; ?>
						</button>
						<div class="dropdown__menu">
							<ul>
								<li class="dropdown__item"><a href="#" onclick="switchLanguage('en')" class="dropdown__link">English</a></li>
								<li class="dropdown__item"><a href="#" onclick="switchLanguage('es')" class="dropdown__link">Español</a></li>
							</ul>
                  		</div>
                	</div>
            	</div>
            	<div class="auth auth--header">
					<ul class="auth__nav">
						<li class="dropdown auth__nav-item">
							<a href="index.php" class="header__span-p2"><span class="header__span-p2">+1 404-9573940</span></a>
						</li>
					</ul>
				<!-- end of block .auth header->
				</div>
			</div>
			<button type="button" class="header__navbar-toggle js-navbar-toggle">
				<svg class="header__navbar-show">
					<use xlink:href="#icon-menu"></use>
				</svg>
				<svg class="header__navbar-hide">
					<use xlink:href="#icon-menu-close"></use>
				</svg>
			</button>
			<!-- end of block .header__navbar-toggle->
		</div>
    </div>
	-->
</header>
<!-- END HEADER-->

<!-- BEGIN NAVBAR-->
<!--
<div id="header-nav-offset"></div>
<nav id="header-nav" class="navbar navbar--header">
    <div class="container">
        <div class="navbar__row js-navbar-row">
			<div id="navbar-collapse-1" class="navbar__wrap">
				<ul class="navbar__nav">
					<li class="navbar__item js-dropdown">
						<a class="navbar__link" onmouseover="">
							LANGUAGE - IDIOMA
							<svg class="navbar__arrow">
								<use xlink:href="#icon-arrow-right"></use>
							</svg>
						</a>
                  		<div role="menu" class="js-dropdown-menu navbar__dropdown navbar__dropdown--colls-1">
							<button class="navbar__back js-navbar-submenu-back">
								<svg class="navbar__arrow">
									<use xlink:href="#icon-arrow-left"></use>
								</svg>Back
							</button>
							<div class="navbar__submenu">
								<ul class="navbar__subnav">
									<li class="navbar__subitem"><a href="#" onclick="switchLanguage('en')" class="navbar__sublink js-navbar-sublink">English</a></li>
									<li class="navbar__subitem"><a href="#" onclick="switchLanguage('es')" class="navbar__sublink js-navbar-sublink">Español</a></li>
								</ul>
							</div>
						</div>
					</li>
					<li class="navbar__subitem"><a href="index.php" class="navbar__sublink js-navbar-sublink"><?php echo MENU_ITEM1; ?></a></li>
					<li class="navbar__subitem"><a href="about-us.php" class="navbar__sublink js-navbar-sublink"><?php echo MENU_ITEM2; ?></a></li>
					<li class="navbar__subitem"><a href="sell.php" class="navbar__sublink js-navbar-sublink"><?php echo MENU_ITEM3; ?></a></li>
					<li class="navbar__subitem"><a href="contact.php" class="navbar__sublink js-navbar-sublink"><?php echo MENU_ITEM4; ?></a></li>
 				</ul>
              	<!-- end of block  navbar__nav->
			</div>
		</div>
	</div>
</nav>
-->
<!-- END NAVBAR-->
<script src="lang/script/lang.js"></script>
