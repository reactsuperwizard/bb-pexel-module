.fl-node-<?php echo $id; ?> img {
    <?php if ( $settings->pexels_width_option == 'custom' ) { ?>
        width: <?php echo $settings->pexels_width; ?>px;
    <?php } ?>
    <?php if ( $settings->pexels_height_option == 'custom' ) { ?>
        height: <?php echo $settings->pexels_height; ?>px;
    <?php } ?>
}