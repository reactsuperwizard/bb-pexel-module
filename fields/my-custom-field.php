<input id="wppx_url" type="hidden" name="{{data.name}}" value="{{data.value}}" />
<img id="cur-pexels-img" src="{{data.value}}" width="200" height="200" alt="Image From Pexels">

<div id="wppx_area" class="wppx_area">
    <div class="wppx_area_content">
        <div class="wppx_area_content_col">
            <div class="wppx_area_content_col_inner">
                <div class="wppx_area_content_col_top">
                    <input type="text" id="wppx_input" name="wppx_input" class="w200"
                           placeholder="<?php esc_html_e( 'keyword', 'wppx' ); ?>"/>
                    <input type="button" id="wppx_search" class="p20"
                           value="<?php esc_html_e( 'Search', 'wppx' ); ?>"/>
                </div>
                <div class="wppx_area_content_col_mid">
                    <div id="wppx_container" class="wppx_container"></div>
                </div>
                <div class="wppx_area_content_col_bot">
                    <div id="wppx_page" class="wppx_page"></div>
                </div>
            </div>
        </div>
    </div>
</div>