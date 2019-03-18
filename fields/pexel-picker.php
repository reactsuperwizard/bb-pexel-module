<input id="bbpx_url" type="hidden" name="{{data.name}}" value="{{data.value}}" />
<img id="cur-pexels-img" src="{{data.value}}" width="200" height="200" alt="Image From Pexels">

<div id="bbpx_area" class="bbpx_area">
    <div class="bbpx_area_content">
        <div class="bbpx_area_content_col">
            <div class="bbpx_area_content_col_inner">
                <div class="bbpx_area_content_col_top">
                    <input type="text" id="bbpx_input" name="bbpx_input" class="w200"
                           placeholder="<?php esc_html_e( 'keyword', 'bbpx' ); ?>"/>
                    <input type="button" id="bbpx_search" class="p20"
                           value="<?php esc_html_e( 'Search', 'bbpx' ); ?>"/>
                </div>
                <div class="bbpx_area_content_col_mid">
                    <div id="bbpx_container" class="bbpx_container"></div>
                </div>
                <div class="bbpx_area_content_col_bot">
                    <div id="bbpx_page" class="bbpx_page"></div>
                </div>
            </div>
        </div>
    </div>
</div>