<header class="banner navbar navbar-default navbar-static-top bg_white" role="banner">
	<div class="container-fluid">
		<div class="row">

			<div class="col-xs-6 col-sm-3 col-lg-2">
				<a class="header_brand_link bg_white floatl"
					href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="/assets/elements/imporfase-logo.png" alt="Imporfase logotipo 2018"></a>
			</div>

			<?php
			if ( ! empty( validate_user() ) ) {
				?>
				<div class="header__buttons col-xs-3 col-lg-2 col-xs-offset-3 col-sm-offset-6 col-lg-offset-6">
					<form action='' method='post' id="gos_exitform">
						<div class="form-group ">
							<input type='hidden' name='gos_exit' value='exit'>
							<input type='submit' value='Sair' id='btn-submit' class='button btn noborder btn-lg button-primary buttonfy'>
						</div>
					</form>
				</div>
			<?php
			} else {
				?>
				<div class="col-xs-3 col-lg-2 col-xs-offset-3 col-sm-offset-6 col-lg-offset-6">
					<a id="gos_exitform" class="button btn noborder btn-lg button-primary buttonfy" href="/stock-online/">Stock Online</a></p>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</header>
