<div id="cart">
  <a href="<?php echo document::link(WS_DIR_HTTP_HOME . 'checkout.php'); ?>" class="image"><img src="<?php echo WS_DIR_IMAGES; ?>icons/32x32/cart.png" alt="" /></a>
  <a href="<?php echo document::link(WS_DIR_HTTP_HOME . 'checkout.php'); ?>" class="content">
    <strong><?php echo language::translate('title_cart', 'Cart'); ?>:</strong><br />
    <span class="quantity"><?php echo cart::$data['total']['items']; ?></span> <?php echo language::translate('text_items', 'item(s)'); ?>
    - <span class="formatted_value">
<?php
  if (!empty(customer::$data['display_prices_including_tax'])) {
    echo currency::format(cart::$data['total']['value'] + cart::$data['total']['tax']);
  } else {
    echo currency::format(cart::$data['total']['value']);
  }
?>
    </span>
  </a>
</div>
<script>
  function updateCart() {
    $.ajax({
      url: '<?php echo document::link(WS_DIR_AJAX .'cart.json.php'); ?>',
      type: 'get',
      cache: false,
      async: true,
      dataType: 'json',
      beforeSend: function(jqXHR) {
        jqXHR.overrideMimeType("text/html;charset=<?php echo language::$selected['charset']; ?>");
      },
      error: function(jqXHR, textStatus, errorThrown) {
        //alert('Error');
      },
      success: function(data) {
        $('#cart .quantity').html(data['quantity']);
        $('#cart .formatted_value').html(data['formatted_value']);
      },
      complete: function() {
        $('*').css('cursor', '');
      }
    });
  }
  var timerCart = setInterval("updateCart()", 60000); // Keeps session alive
</script>