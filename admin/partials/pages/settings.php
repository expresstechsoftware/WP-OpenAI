<?php 

$api_keys = sanitize_text_field( ( trim( get_option( 'ets_wp_openai_api_keys' ) ) ) );
$end_point = sanitize_text_field( ( trim( get_option( 'ets_wp_openai_end_point' ) ) ) );

?>

<div class="wrap">
  <h1><?php esc_html_e( 'Settings', 'connect-ai-discord' );?></h1>

  <?php if ( isset( $_GET['ets_settings_saved'] ) ) { ?>
  <div id="setting-error-settings_updated" class="notice notice-success settings-error is-dismissible"> 
    <p><strong><?php esc_html_e( $_GET['ets_settings_saved'])?></strong></p>
    <button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php esc_html__( 'Dismiss this notice.','connect-ai-discord'); ?></span></button>
  </div>
  <?php } ?>
<div class="form-container">
  <form method="POST" action="<?php echo esc_url( get_site_url() . '/wp-admin/admin-post.php' ); ?>">
  <?php wp_nonce_field( 'ets_wp_openai_settings_nonce', 'ets-wp-openai-settings-nonce' ); ?>
    <input type="hidden" name="action" value="ets_wp_openai_save_settings">
    <input type="hidden" name="current_url" value="<?php echo esc_url( ets_wp_openai_get_current_screen_url() )?>">
<table class="form-table">
  <tr class="form-row">
    <th class="form-cell">
      <label for="api_keys"><?php esc_html_e( 'API keys', 'connect-ai-discord' );?></label>
        </th>
        <td class="form-cell">
          <input type="password"  id="api_keys" name="api_keys" class=" regular-text" value="<? echo esc_att( $api_keys ); ?>">
        </td>
      </tr>
      <tr class="form-row">
        <th class="form-cell">
          <label for="endpoint_url"><?php esc_html_e( 'Set the API endpoint URL', 'connect-ai-discord' ); ?></label>
        </th>
        <td class="form-cell">
          <input type="text" id="endpoint_url" name="endpoint_url" class=" regular-text" value="<?php echo esc_attr( $end_point ); ?>">
        </td>
      </tr>
    </table>

    <input type="submit" value="<?php esc_html_e( 'Save Changes', 'connect-ai-discord' ); ?>" class="form-submit">
  </form>
</div>
</div>