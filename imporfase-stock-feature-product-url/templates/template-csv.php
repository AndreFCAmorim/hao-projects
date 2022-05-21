<?php
/**
 * Template Name: Stock
 */
$email__data  = validate_form( $_POST );
$email_status = null;
if ( $email__data ) {
	$email_status = send_email( $email__data );
}

while ( have_posts() ) {
	the_post(); ?>
	<article <?php post_class( 'col-md-offset-1' ); ?>>
		<div class="entry-content ">
			<?php the_content(); ?>
		</div>
	</article>
<?php
}

if ( post_password_required() ) {
	return;
}
if ( isset( $_COOKIE[ 'bawmpp-postpass_' . COOKIEHASH ] ) ) {
	$passused = $_COOKIE[ 'bawmpp-postpass_' . COOKIEHASH ];
}

if ( isset( $email_status->body['message'] ) && $email_status->body['message'] == 'success' ) {
	echo '<div class="gos_mail gos_mail__success"><p>O seu email foi enviado com sucesso! Obrigado!</p></div>';
} elseif ( isset( $_POST['email__send'] ) && $_POST['email__send'] == 'sendrefs' ) {
	echo '<div class="gos_mail gos_mail__failure"><p>O seu email não foi enviado, lamentamos. Por favor contacte-nos para <a href="mailto:vendas@imporfase.com">vendas@imporfase.com</a>!</p></div>';
}

$client_code = validate_user();

if ( empty( $client_code ) ) {
	echo 'Missing Client code';
	return;
}
$page_id = get_the_ID();

$meta_info = get_post_meta( $page_id );

$client_id = get_client_id( $meta_info, $client_code );

/* Has access but has no details */
if ( $client_id === false ) {
	//echo 'Missing Client id';
	//return;
}

$post_client_email = '';
if ( isset( $_POST['email__email'] ) ) {
	$post_client_email = $_POST['email__email'];
}
if ( empty( $post_client_email ) && $client_id !== false ) {
	$post_client_email = get_client_field( $meta_info, $client_id, 'email' );
}

?>

<div class="row">
	<div class="col-md-12">
		<div class="gloss__side">
			<!-- &#x25B2; and &#x25BC; -->
			<div class="list__toggle">
				<button id="btn-toggle-lists" class="btn btn-info btn-sm js-btn-toggle-lists js-show-lists-mode">
					<div class="js-show-lists">
						<span class="chevron">&#x25B2;</span><?php esc_html_e( 'Show Lists', 'impstock' ); ?>
					</div>
					<div class="js-hide-lists">
						<span class="chevron">&#x25BC;</span><?php esc_html_e( 'Hide Lists', 'impstock' ); ?>
					</div>
				</button>
			</div>

			<div id="list__block" class="row">
				<?php
				get_template_part( 'templates/stock/content', 'lists' );
				?>

			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="gloss__side">

			<div class="row">
				<div class="col-md-6">
					<p class="hidden-xs hidden-sm ">Carregue <kbd>enter</kbd> para pesquisar</p>
					<form
						id     = "term__form"
						class  = "form-horizontal "
						method = "get" >
						<div class="col-md-6">
							<div class="form-group ">
								<label class="floatl" for="term__text"><?php esc_html_e( 'Referência', 'impstock' ); ?></label>
								<input
									type  = "text" required
									class = "form-control "
									id    = "term__text"
									name  = "term__text"
									value = ""
									tabindex="1"
									placeholder ="<?php _e( 'ref*', 'impstock' ); ?>">
							</div>
						</div>
						<input
							type  = "hidden" required
							class = "form-control "
							id    = "page_id"
							name  = "page_id"
							value = "<?php echo get_the_ID(); ?>"
							placeholder ="<?php esc_html_e( 'ref*', 'impstock' ); ?>">
						<input
							type  = "hidden"
							name  = "client_id"
							value = "<?php echo esc_attr( $client_id ); ?>">
						<input
							type  = "hidden"
							name  = "client_code"
							value = "<?php echo esc_attr( $client_code ); ?>">
					</form>


				</div>
				<div class="col-md-6" id="stock_marcas">
					<img src="/assets/uploads/imporfase-stock.png" alt="stock dia seguinte">

					<p>Caros clientes, o que não temos em stock, arranjamos para o <strong>dia seguinte</strong>, conforme consulta com os fabricantes.</p>
					<p><a href="#imporfase__contactos">Contacte-nos</a>, veja todos os nossos contactos no fundo da página.</p>
					<h3>Veja também os catalogos dos nossos fornecedores:</h3>
					<?php
					$section_brands_local = [ 'lista flexiveis', 'lista catalisadores universais', 'cerina/Eolys' ];
					?>
					<p><a id="gloss__catalogue-walker" target="_blank" href="http://www.walkercatalogue.eu/">Catálogo Walker Online</a>
				</div>
			</div><!-- /row -->

		</div>
	</div>
</div>
<div class="row">

	<div class="col-md-12">
		<div id="js-status" class="gloss__side">
			<h3 class="clearb"><?php esc_html_e( 'Stock', 'impstock' ); ?>:</h3>

			<div id="term__body" class="term__result">
			</div>
		</div>
	</div>
</div>

<div class="email__order">
	<!-- &#x25B2; and &#x25BC; -->
	<div class="email__toggle">
		<button id="btn-toggle-cart" class="btn btn-info btn-sm js-btn-toggle-cart js-show-cart-mode">
			<div class="js-show-cart">
				<span class="chevron">&#x25B2;</span><?php esc_html_e( 'Show Cart', 'impstock' ); ?>
			</div>
			<div class="js-hide-cart">
				<span class="chevron">&#x25BC;</span><?php esc_html_e( 'Hide Cart', 'impstock' ); ?>
			</div>
		</button>
	</div>
	<form
		id = "email__form"
		class = "form-horizontal col-md-12 float-label"
		method = "post">
		<div class="col-md-12">
			<div class="form-group" >

				<textarea
					class ="form-control"
					id ="email__encs"
					name ="email__encs"
					value =""
					cols ="55"
					rows ="2"
					placeholder ="<?php _e( 'lista de referências*', 'impstock' ); ?>"></textarea>
				<label class="" for="email__encs"><?php _e( 'Referências a encomendar', 'impstock' ); ?></label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group ">
				<input
					type  ="text"
					class ="form-control "
					id    ="client__code"
					name  ="client__code"
					value ="<?php echo $client_code; ?>"
					placeholder ="<?php _e( 'Código Cliente*', 'impstock' ); ?>">
					<label class="" for="client__code"><?php _e( 'Código Privado', 'impstock' ); ?></label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group ">

				<input
					type  = "email"
					class = "form-control"
					id    = "email__email"
					name  = "email__email"
					value ="<?php echo filter_var( sanitize_text_field( $post_client_email ), FILTER_VALIDATE_EMAIL ); ?>"
					placeholder ="<?php esc_attr_e( 'email*', 'impstock' ); ?>">
				<label class="" for="email__email"><?php esc_html_e( 'Email', 'impstock' ); ?></label>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group ">
				<input type="hidden" name="client__id" id="client__id" value="<?= $client_id; ?>">
				<input type="hidden" name="email__send" value="sendrefs">
				<input type="submit" value="<?php esc_attr_e( 'Send', 'impstock' ); ?>" id="btn-submit-order" class="btn btn-default below30">
			</div>
		</div>
	</form>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="gloss__side ">
			<h3><?php esc_html_e( 'Legend', 'impstock' ); ?></h3>
			<ul id="gos__legenda">
				<li><span class="glyphicon glyphicon-ok btn btn-success"></span> Em stock</li>
				<li><span class="glyphicon glyphicon-remove btn btn-warning"></span> Última peça e reservada.</li>
				<li><span class="glyphicon glyphicon-remove btn btn-danger"></span> Stock esgostado.</li>
			</ul>
			<p><?php esc_html_e( 'Stock version', 'impstock' ); ?> <?= THEME_VERSION ?></p>
		</div>
	</div>
	<div class="col-md-6" >
		<div class="gloss__side refs__notes">
			<h2>NOTAS</h2>
			<ul>
				<li>
					<strong>Atenção:</strong> O stock é actualizado de 30 em 30 minutos.
				</li>
				<li>
					A estes preços apresentados acresce o I.V.A. à taxa em vigor.
				</li>
				<li><?php esc_html_e( 'Stock Online disponível para as seguintes marcas:', 'impstock' ); ?>
					<ul>
						<li><img src="/assets/uploads/marcas_walker-parceria-imporfase.png" alt=""></li>
						<li><img src="/assets/uploads/2012/08/marcas-veneporte-parceria-imporfase.png" alt=""></li>
						<li><img src="/assets/uploads/marcas_fabriscape-parceria-imporfase.png" alt=""></li>
						<li><img src="/assets/uploads/2012/08/marcas_klarius-parceria-imporfase.png" alt=""></li><br/>
						<li><img src="/assets/uploads/bosal-logo.gif" alt=""></li>
						<li><img src="/assets/uploads/NEW-BM-Logo-300x206.jpg" alt=""></li>
						<li><img src="/assets/uploads/marcas_cats_and_pipes_-parceria-imporfase.png" alt=""></li>
						<li><img src="/assets/uploads/marcas-fa1-parceria-imporfase.jpg" alt=""></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
