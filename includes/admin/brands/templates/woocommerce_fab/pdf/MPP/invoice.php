<?php

global $wpo_wcpdf;

$wcpdf_items = $wpo_wcpdf->get_order_items();

$order = new WC_Order($wpo_wcpdf->export->order->id);
$composite_items = array_filter($order->get_items(), function($item) { return ((isset($item['composite_children'])) || (!isset($item['composite_parent']) && !isset($item['composite_children']))); });
$item_number = 1;

$taopixID = get_post_meta($wpo_wcpdf->export->order->id, 'TaopixID', true);

?>

<?php if( sizeof( $composite_items ) > 0 ) : foreach( $composite_items as $composite_item_id => $composite_item ) : ?>

<?php if ($item_number > 1) : ?>
<div style="page-break-before: always;"></div>
<?php endif; ?>

<h3>Страница <?php echo $item_number++; ?> из <?php echo count($composite_items); ?></h3>

<table class="head container">
	<tr>
		<td class="header">
		<?php
		if( $wpo_wcpdf->get_header_logo_id() ) {
			$wpo_wcpdf->header_logo();
		} else {
			echo apply_filters( 'wpo_wcpdf_packing_slip_title', __( 'Packing Slip', 'wpo_wcpdf' ) );
		}
		?>
		</td>
		<td class="shop-info">
			<div class="shop-name"><h3><?php $wpo_wcpdf->shop_name(); ?></h3></div>
			<div class="shop-address"><?php $wpo_wcpdf->shop_address(); ?></div>
		</td>
	</tr>
</table>

<h1 class="document-type-label">
<?php if( $wpo_wcpdf->get_header_logo_id() ) echo apply_filters( 'wpo_wcpdf_packing_slip_title', __( 'Бланк заказа', 'wpo_wcpdf' ) ); echo '&nbsp;'; ?>
<span><?php $line_number = $order->get_items()[$composite_item_id]['tpx_line_number']; $wpo_wcpdf->order_number(); echo $taopixID ? " ($taopixID" . ($line_number ? ".$line_number" : '') . ')' : ''; ?></span>
</h1>

<?php do_action( 'wpo_wcpdf_after_document_label', $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order ); ?>

<table class="order-data-addresses">
	<tr>
		<td class="address shipping-address">
			<!-- <h3><?php _e( 'Shipping Address:', 'wpo_wcpdf' ); ?></h3> -->
			<?php $wpo_wcpdf->shipping_address(); ?>
			<?php if ( isset($wpo_wcpdf->settings->template_settings['packing_slip_email']) ) { ?>
			<div class="billing-email"><?php $wpo_wcpdf->billing_email(); ?></div>
			<?php } ?>
			<?php if ( isset($wpo_wcpdf->settings->template_settings['packing_slip_phone']) ) { ?>
			<div class="billing-phone"><?php $wpo_wcpdf->billing_phone(); ?></div>
			<?php } ?>
		</td>
		<td class="address billing-address">
			<?php if ( isset($wpo_wcpdf->settings->template_settings['packing_slip_billing_address']) && $wpo_wcpdf->ships_to_different_address()) { ?>
			<h3><?php _e( 'Billing Address:', 'wpo_wcpdf' ); ?></h3>
			<?php $wpo_wcpdf->billing_address(); ?>
			<?php } ?>
		</td>
		<td class="order-data">
			<table>
				<?php do_action( 'wpo_wcpdf_before_order_data', $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order ); ?>
				<!--
        <tr class="order-number">
					<th><?php _e( 'Order Number:', 'wpo_wcpdf' ); ?></th>
					<td><strong><?php $wpo_wcpdf->order_number(); ?></strong></td>
				</tr>
				<tr class="order-number">
					<th><?php _e( 'Taopix Number:', 'wpo_wcpdf' ); ?></th>
					<td><?php echo get_post_meta($wpo_wcpdf->export->order->id, 'TaopixID', true); ?></td>
				</tr>
        -->
				<tr class="order-date">
          <th><?php _e( 'Order Date:', 'wpo_wcpdf' ); ?></th>
          <td><?php $wpo_wcpdf->order_date(); ?></td>
        </tr>
        <!--
				<tr class="shipping-method">
					<th><?php _e( 'Shipping Method:', 'wpo_wcpdf' ); ?></th>
					<td><?php $wpo_wcpdf->shipping_method(); ?></td>
				</tr>
        -->
				<?php do_action( 'wpo_wcpdf_after_order_data', $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order ); ?>
			</table>			
		</td>
	</tr>
</table>

<?php if ($item_number == -1) : ?>
<div class="customer-notes">
	<?php if ( $wpo_wcpdf->get_shipping_notes() ) : ?>
		<h3><?php _e( 'Customer Notes', 'wpo_wcpdf' ); ?></h3>
		<?php $wpo_wcpdf->shipping_notes(); ?>
	<?php endif; ?>
</div>
<?php endif; ?>

<?php $project_name = $order->get_items()[$composite_item_id]['tpx_project_name']; if ($project_name) : ?>
<div class="customer-notes" style="margin-bottom: 9pt">
  <strong><?php echo 'Название проекта: '; ?></strong><?php echo $project_name; ?>
</div>
<?php endif; ?>

<!--
<div class="customer-notes">
  <h3>Taopix Projects:</h3>
  <ol>
  <?php
  for ($i = 1; $projectName = get_post_meta($wpo_wcpdf->export->order->id, "Project_$i", true); $i++)
  {
    echo '<li>' . $projectName . '</li>';
  }
  ?>
  </ol>
</div>
-->

<?php do_action( 'wpo_wcpdf_before_order_details', $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order ); ?>

<?php /*if( sizeof( $composite_items ) > 0 ) : foreach( $composite_items as $composite_item_id => $composite_item ) :*/ ?>
<!--
<div style="page-break-before: always;"></div>
<h2><?php _e( 'Заказ ', 'wpo_wcpdf' ); $wpo_wcpdf->order_number(); echo $taopixID ? " ($taopixID)" : ''; ?></h2>
-->
<table class="order-details">
	<thead>
		<tr>
			<th class="product"><?php _e('Product', 'wpo_wcpdf'); ?></th>
			<th class="quantity"><?php _e('Quantity', 'wpo_wcpdf'); ?></th>
			<th class="price"><?php _e('Price', 'wpo_wcpdf'); ?></th>
		</tr>
	</thead>
	<tbody>
		
    <?php
    
    $composite_children = WC_Composite_Products::instance()->order->get_composite_children($composite_item, $order);
    $ci_children = WC_Composite_Products::instance()->order->get_composite_children($composite_item, $order);
    
    foreach ($wcpdf_items as $wcpdf_item_id => $wcpdf_item)
    {
      if ($wcpdf_item_id == $composite_item_id)
      {
        $composite_item = $wcpdf_item;
        break;
      }
    }
    
    ?>
    
    <?php $projectRef = $wpo_wcpdf->export->order->get_items()[$composite_item_id]['tpx_project_ref']; if ($projectRef) : ?>
    <tr class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', $composite_item_id, $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order, $composite_item_id ); ?>">
      <td class="product">ТИП ЗАКАЗА</td>
      <td class="quantity"><?php echo strrpos($projectRef, 'MPP', -3) !== false ? 'Offline' : 'Online'; ?></td>
      <td class="no-borders"></td>
    </tr>
    <?php endif; ?>
    
		<tr class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', $composite_item_id, $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order, $composite_item_id ); ?>">
			<td class="product">
				<?php $description_label = __( 'Description', 'wpo_wcpdf' ); // registering alternate label translation ?>
				<span class="item-name"><?php echo $composite_item['name'];?></span>
				<?php do_action( 'wpo_wcpdf_before_item_meta', $wpo_wcpdf->export->template_type, $composite_item, $wpo_wcpdf->export->order  ); ?>
				<span class="item-meta"><?php echo $composite_item['meta']; ?></span>
				<dl class="meta">
					<?php $description_label = __( 'SKU', 'wpo_wcpdf' ); // registering alternate label translation ?>
					<?php if( !empty( $composite_item['sku'] ) ) : ?><dt class="sku"><?php _e( 'SKU:', 'wpo_wcpdf' ); ?></dt><dd class="sku"><?php echo $composite_item['sku']; ?></dd><?php endif; ?>
					
					<?php /*if( !empty( $composite_item['weight'] ) ) : ?><dt class="weight"><?php _e( 'Weight:', 'wpo_wcpdf' ); ?></dt><dd class="weight"><?php echo $composite_item['weight']; ?><?php echo get_option('woocommerce_weight_unit'); ?></dd><?php endif;*/ ?>
				</dl>
				<?php do_action( 'wpo_wcpdf_after_item_meta', $wpo_wcpdf->export->template_type, $composite_item, $wpo_wcpdf->export->order  ); ?>
			</td>
			<td class="quantity"><?php echo $composite_item['quantity']; ?></td>
			<td class="price"><?php echo $composite_item['order_price']; ?></td>
		</tr>
		
    <?php if( sizeof( $composite_children ) > 0 ) : foreach( $composite_children as $item_id => $item ) : ?>
    
    <?php
    
    foreach ($wcpdf_items as $wcpdf_item_id => $wcpdf_item)
    {
      if ($wcpdf_item_id == $item_id)
      {
        $item = $wcpdf_item;
        break;
      }
    }
    ?>
    
		<tr class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', $item_id, $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order, $item_id ); ?>">
			<td class="product">
				<?php $description_label = __( 'Description', 'wpo_wcpdf' ); // registering alternate label translation ?>
				<span class="item-name"><?php echo $item['name']; ?></span>
				<?php do_action( 'wpo_wcpdf_before_item_meta', $wpo_wcpdf->export->template_type, $item, $wpo_wcpdf->export->order  ); ?>
				<span class="item-meta"><?php echo $item['meta']; ?></span>
				<dl class="meta">
					<?php $description_label = __( 'SKU', 'wpo_wcpdf' ); // registering alternate label translation ?>
					<?php if( !empty( $item['sku'] ) ) : ?><dt class="sku"><?php _e( 'SKU:', 'wpo_wcpdf' ); ?></dt><dd class="sku"><?php echo $item['sku']; ?></dd><?php endif; ?>
					<?php /*if( !empty( $item['weight'] ) ) : ?><dt class="weight"><?php _e( 'Weight:', 'wpo_wcpdf' ); ?></dt><dd class="weight"><?php echo $item['weight']; ?><?php echo get_option('woocommerce_weight_unit'); ?></dd><?php endif;*/ ?>
				</dl>
				<?php do_action( 'wpo_wcpdf_after_item_meta', $wpo_wcpdf->export->template_type, $item, $wpo_wcpdf->export->order  ); ?>
			</td>
			<td class="quantity"><?php echo $item['quantity']; ?></td>
			<td class="price"><?php echo $item['order_price']; ?></td>
		</tr>
    <?php endforeach; endif; ?>
    
	</tbody>
</table>
<?php /*endforeach; endif;*/ ?>

<table class="order-details">
  <tr class="no-borders">
    <td class="no-borders"></td>
    <td class="no-borders" style="width: 45%;">
      <table class="totals">
        <tfoot>
          <!--
          <tr class="shipping-method">
            <td class="no-borders"></td>
            <th class="description">Метод доставки</th>
            <td><?php $wpo_wcpdf->shipping_method(); ?></td>
          </tr>
          -->
          <tr class="payment-method">
            <td class="no-borders"></td>
            <th class="description">Метод оплаты</th>
            <td><?php $wpo_wcpdf->payment_method(); ?></td>
          </tr>
          <tr class="weight">
            <td class="no-borders"></td>
            <th class="description">Вес продукта</th>
            <td>
            <?php
            $sum = $ci['weight'];
            $ci_children = WC_Composite_Products::instance()->order->get_composite_children($composite_items[$composite_item_id], $order);
            if(sizeof($ci_children) > 0)
            {
              foreach ($ci_children as $cc_id => $cc)
              {
                foreach ($wcpdf_items as $wcpdf_item_id => $wcpdf_item)
                {
                  if ($wcpdf_item_id == $cc_id)
                  {
                    $sum += $wcpdf_item['weight'];
                    break;
                  }
                }
              }
            }
            echo round($sum, 1) . ' кг';
            ?>
            </td>
          </tr>
          <!--
          <tr class="price">
            <td class="no-borders"></td>
            <th class="description">Цена продукта</th>
            <td><?php echo WC_Composite_Products::instance()->order->order_item_subtotal(0.0, $composite_items[$composite_item_id], $order); ?></td>
          </tr>
          -->
          <!--
          <tr class="weight">
            <td class="no-borders"></td>
            <th class="description">Вес заказа</th>
            <td>
            <?php
            $sum = 0;
            foreach ($composite_items as $ci_id => $ci)
            {
              $sum += $ci['weight'];
              $ci_children = WC_Composite_Products::instance()->order->get_composite_children($ci, $order);
              if(sizeof($ci_children) > 0)
              {
                foreach ($ci_children as $cc_id => $cc)
                {
                  foreach ($wcpdf_items as $wcpdf_item_id => $wcpdf_item)
                  {
                    if ($wcpdf_item_id == $cc_id)
                    {
                      $sum += $wcpdf_item['weight'];
                      break;
                    }
                  }
                }
              }
            }
            echo round($sum, 1) . ' кг';
            ?>
            </td>
          </tr>
          -->
          <?php $count = 0; foreach( $wpo_wcpdf->get_woocommerce_totals() as $key => $total ) : ?>
          <?php if ($count == 0) { $count++; continue; } ?>
          <tr class="<?php echo $key; ?>">
            <td class="no-borders"></td>
            <th class="description"><?php echo $total['label']; ?></th>
            <td class="price"><span class="totals-price"><?php echo $total['value']; ?></span></td>
          </tr>
          <?php endforeach; ?>
        </tfoot>
      </table>
    </td>
  </tr>
</table>

<?php do_action( 'wpo_wcpdf_after_order_details', $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order ); ?>

<?php if ( $wpo_wcpdf->get_footer() ): ?>
<div id="footer">
	<?php $wpo_wcpdf->footer(); ?>
</div><!-- #letter-footer -->
<?php endif; ?>

<?php endforeach; endif; ?>
