<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file: 
 * 
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 * Example: 
 */

?>
<div class="fl-pexels">
	<img src="<?php echo $settings->pexels_src; ?>" width="<?php echo $settings->pexels_width; ?>" height="<?php echo $settings->pexels_height; ?>" alt="">
</div>