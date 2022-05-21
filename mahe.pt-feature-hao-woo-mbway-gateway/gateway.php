<?php
/*
Plugin Name: WooCommerce MBWay Gateway
Plugin URI: https://hopeandoak.agency
Description: Extends WooCommerce with an MBWay gateway.
Version: 1.0
Author: Hope & Oak Agency
Author URI: https://hopeandoak.agency
Copyright: © 2021 Hope & Oak Agency.
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/
add_action( 'plugins_loaded', 'woocommerce_gateway_hao_mbway_init', 0 );
function woocommerce_gateway_hao_mbway_init() {
	if ( ! class_exists( 'WC_Payment_Gateway' ) ) {
		return;
	}
	/**
	 * Localisation
	 */
	load_plugin_textdomain( 'hao_mbway', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

	/**
	 * Gateway class
	 */
	class WC_Gateway_HaO_MBWay extends WC_Payment_Gateway {

		/**
		 * Array of locales
		 *
		 * @var array
		 */
		public $locale;

		/**
		 * Constructor for the gateway.
		 */
		public function __construct() {

			$this->id                 = 'hao_mbway';
			$this->icon               = '';
			$this->has_fields         = false;
			$this->method_title       = __( 'MBWay Payment Gateway', 'wc_gateway_hao_mbway' );
			$this->method_description = __( 'Take payments through MBWay service.', 'wc_gateway_hao_mbway' );

			// Load the settings.
			$this->init_form_fields();
			$this->init_settings();

			// Define user set variables.
			$this->title        = $this->get_option( 'title' );
			$this->description  = $this->get_option( 'description' );
			$this->instructions = $this->get_option( 'instructions' );

			// gateway account fields shown on the thanks page and in emails.
			$this->account_details = get_option(
				'woocommerce_hao_mbway_accounts',
				[
					[
						'account_name'    => $this->get_option( 'account_name' ),
						'account_number'  => $this->get_option( 'account_number' ),
						'delivery_time'   => $this->get_option( 'delivery_time' ),
						'gps_coordinates' => $this->get_option( 'gps_coordinates' ),
					],
				]
			);

			// Actions.
			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, [ $this, 'process_admin_options' ] );
			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, [ $this, 'save_account_details' ] );
			add_action( 'woocommerce_thankyou_hao_mbway', [ $this, 'thankyou_page' ] );

			// Customer Emails.
			add_action( 'woocommerce_email_before_order_table', [ $this, 'email_instructions' ], 10, 3 );
		}

		/**
		 * Initialise Gateway Settings Form Fields.
		 */
		public function init_form_fields() {

			$this->form_fields = [
				'enabled'         => [
					'title'   => __( 'Enable/Disable', 'hao_mbway' ),
					'type'    => 'checkbox',
					'label'   => __( 'Enable MBWay payment', 'hao_mbway' ),
					'default' => 'no',
				],
				'title'           => [
					'title'       => __( 'Title', 'hao_mbway' ),
					'type'        => 'text',
					'description' => __( 'This controls the title which the user sees during checkout.', 'hao_mbway' ),
					'default'     => __( 'MBWay Payment', 'hao_mbway' ),
					'desc_tip'    => true,
				],
				'description'     => [
					'title'       => __( 'Description', 'hao_mbway' ),
					'type'        => 'textarea',
					'description' => __( 'Payment method description that the customer will see on your checkout.', 'hao_mbway' ),
					'default'     => __( 'Make your payment directly into our MBWay account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.', 'hao_mbway' ),
					'desc_tip'    => true,
				],
				'instructions'    => [
					'title'       => __( 'Instructions', 'hao_mbway' ),
					'type'        => 'textarea',
					'description' => __( 'Instructions that will be added to the thank you page and emails.', 'hao_mbway' ),
					'default'     => '',
					'desc_tip'    => true,
				],
				'account_details' => [
					'type' => 'account_details',
				],
			];

		}

		/**
		 * Generate account details html.
		 *
		 * @return string
		 */
		public function generate_account_details_html() {

			ob_start();

			?>
			<tr valign="top">
				<th scope="row" class="titledesc"><?php esc_html_e( 'Account details:', 'hao_mbway' ); ?></th>
				<td class="forminp" id="hao_mbway_accounts">
					<div class="wc_input_table_wrapper">
						<table class="widefat wc_input_table sortable" cellspacing="0">
							<thead>
								<tr>
									<th class="sort">&nbsp;</th>
									<th><?php esc_html_e( 'Name', 'hao_mbway' ); ?></th>
									<th><?php esc_html_e( 'MBWay number', 'hao_mbway' ); ?></th>
									<th><?php esc_html_e( 'Delivery Time', 'hao_mbway' ); ?></th>
									<th><?php esc_html_e( 'GPS Coordinates', 'hao_mbway' ); ?></th>
								</tr>
							</thead>
							<tbody class="accounts">
								<?php
								$i = -1;
								if ( $this->account_details ) {
									foreach ( $this->account_details as $account ) {
										$i++;

										echo '<tr class="account">
											<td class="sort"></td>
											<td><input type="text" value="' . esc_attr( wp_unslash( $account['account_name'] ) ) . '" name="hao_mbway_account_name[' . esc_attr( $i ) . ']" /></td>
											<td><input type="text" value="' . esc_attr( $account['account_number'] ) . '" name="hao_mbway_account_number[' . esc_attr( $i ) . ']" /></td>
											<td><input type="text" value="' . esc_attr( $account['delivery_time'] ) . '" name="hao_mbway_delivery_time[' . esc_attr( $i ) . ']" /></td>
											<td><input type="text" value="' . esc_attr( $account['gps_coordinates'] ) . '" name="hao_mbway_gps_coordinates[' . esc_attr( $i ) . ']" /></td>
										</tr>';
									}
								}
								?>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="7"><a href="#" class="add button"><?php esc_html_e( '+ Add account', 'hao_mbway' ); ?></a> <a href="#" class="remove_rows button"><?php esc_html_e( 'Remove selected account(s)', 'hao_mbway' ); ?></a></th>
								</tr>
							</tfoot>
						</table>
					</div>
					<script type="text/javascript">
						jQuery(function() {
							jQuery('#hao_mbway_accounts').on( 'click', 'a.add', function(){

								var size = jQuery('#hao_mbway_accounts').find('tbody .account').length;

								jQuery('<tr class="account">\
										<td class="sort"></td>\
										<td><input type="text" name="hao_mbway_account_name[' + size + ']" /></td>\
										<td><input type="text" name="hao_mbway_account_number[' + size + ']" /></td>\
										<td><input type="text" name="hao_mbway_delivery_time[' + size + ']" /></td>\
										<td><input type="text" name="hao_mbway_gps_coordinates[' + size + ']" /></td>\
									</tr>').appendTo('#hao_mbway_accounts table tbody');

								return false;
							});
						});
					</script>
				</td>
			</tr>
			<?php
			return ob_get_clean();

		}

		/**
		 * Save account details table.
		 */
		public function save_account_details() {

			$accounts = [];

			// phpcs:disable WordPress.Security.NonceVerification.Missing -- Nonce verification already handled in WC_Admin_Settings::save()
			if ( isset( $_POST['hao_mbway_account_name'] ) && isset( $_POST['hao_mbway_account_number'] )
				&& isset( $_POST['hao_mbway_delivery_time'] ) && isset( $_POST['hao_mbway_gps_coordinates'] ) ) {

				$account_names   = wc_clean( wp_unslash( $_POST['hao_mbway_account_name'] ) );
				$account_numbers = wc_clean( wp_unslash( $_POST['hao_mbway_account_number'] ) );
				$delivery_times  = wc_clean( wp_unslash( $_POST['hao_mbway_delivery_time'] ) );
				$gps_coordinates = wc_clean( wp_unslash( $_POST['hao_mbway_gps_coordinates'] ) );

				foreach ( $account_names as $i => $name ) {
					if ( ! isset( $account_names[ $i ] ) ) {
						continue;
					}

					$accounts[] = [
						'account_name'    => $account_names[ $i ],
						'account_number'  => $account_numbers[ $i ],
						'delivery_time'   => $delivery_times[ $i ],
						'gps_coordinates' => $gps_coordinates[ $i ],
					];
				}
			}
			// phpcs:enable

			update_option( 'woocommerce_hao_mbway_accounts', $accounts );
		}

		/**
		 * Output for the order received page.
		 *
		 * @param int $order_id Order ID.
		 */
		public function thankyou_page( $order_id ) {

			if ( $this->instructions ) {
				echo wp_kses_post( wpautop( wptexturize( wp_kses_post( $this->instructions ) ) ) );
			}
			$this->bank_details( $order_id );

		}

		/**
		 * Add content to the WC emails.
		 *
		 * @param WC_Order $order Order object.
		 * @param bool     $sent_to_admin Sent to admin.
		 * @param bool     $plain_text Email format: plain text or HTML.
		 */
		public function email_instructions( $order, $sent_to_admin, $plain_text = false ) {

			if ( ! $sent_to_admin && 'hao_mbway' === $order->get_payment_method() && $order->has_status( 'on-hold' ) ) {
				if ( $this->instructions ) {
					echo wp_kses_post( wpautop( wptexturize( $this->instructions ) ) . PHP_EOL );
				}
				$this->bank_details( $order->get_id() );
			}

		}

		/**
		 * Get bank details and place into a list format.
		 *
		 * @param int $order_id Order ID.
		 */
		private function bank_details( $order_id = '' ) {

			if ( empty( $this->account_details ) ) {
				return;
			}

			$hao_mbway_accounts = apply_filters( 'woocommerce_hao_mbway_accounts', $this->account_details, $order_id );

			if ( ! empty( $hao_mbway_accounts ) ) {
				$account_html = '';
				$has_details  = false;

				foreach ( $hao_mbway_accounts as $hao_mbway_account ) {
					$hao_mbway_account = (object) $hao_mbway_account;

					$account_html .= '<ul class="wc-hao_mbway-bank-details order_details hao_mbway_details">' . PHP_EOL;

					// gateway account fields shown on the thanks page and in emails.
					$account_fields = apply_filters(
						'woocommerce_hao_mbway_account_fields',
						[
							'account_name'    => [
								'label' => __( 'Name', 'hao_mbway' ),
								'value' => $hao_mbway_account->account_name,
							],
							'account_number'  => [
								'label' => __( 'MBWay number', 'hao_mbway' ),
								'value' => $hao_mbway_account->account_number,
							],
							'delivery_time'   => [
								'label' => __( 'Delivery Time', 'hao_mbway' ),
								'value' => $hao_mbway_account->delivery_time,
							],
							'gps_coordinates' => [
								'label' => __( 'GPS Coordinates', 'hao_mbway' ),
								'value' => $hao_mbway_account->gps_coordinates,
							],
						],
						$order_id
					);

					foreach ( $account_fields as $field_key => $field ) {
						if ( ! empty( $field['value'] ) ) {
							$account_html .= '<li class="' . esc_attr( $field_key ) . '">' . wp_kses_post( $field['label'] ) . ': <strong>' . wp_kses_post( wptexturize( $field['value'] ) ) . '</strong></li>' . PHP_EOL;
							$has_details   = true;
						}
					}

					$account_html .= '</ul>';
				}

				if ( $has_details ) {
					echo '<section class="woocommerce-hao_mbway-bank-details"><h2 class="wc-hao_mbway-bank-details-heading">' . esc_html__( 'Your payment details', 'hao_mbway' ) . '</h2>' . wp_kses_post( PHP_EOL . $account_html ) . '</section>';
				}
			}

		}

		/**
		 * Process the payment and return the result.
		 *
		 * @param int $order_id Order ID.
		 * @return array
		 */
		public function process_payment( $order_id ) {

			$order = wc_get_order( $order_id );

			$order->update_status( 'on-hold', __( 'Awaiting MBWay payment', 'hao_mbway' ) );

			// Remove cart.
			WC()->cart->empty_cart();

			// Return thankyou redirect.
			return [
				'result'   => 'success',
				'redirect' => $this->get_return_url( $order ),
			];

		}

	}

	/**
	* Add the Gateway to WooCommerce
	**/
	function woocommerce_add_gateway_hao_mbway( $methods ) {
		$methods[] = 'WC_Gateway_HaO_MBWay';
		return $methods;
	}

	add_filter( 'woocommerce_payment_gateways', 'woocommerce_add_gateway_hao_mbway' );
}
