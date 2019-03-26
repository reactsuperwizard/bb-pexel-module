<div class="pexel-wrapper fl-builder-custom-field">
    <input id="bbpx_url" type="hidden" name="{{data.name}}" value="{{data.value}}" />
    <a class="fl-pexels-photo-select" href="javascript:void(0);" onclick="return false;">Select Photo</a>
    <div class="pexel-main">
        <div class="pexel-img-container">
            <div>
                <img id="cur-pexels-img" src="{{data.value}}" width="200" height="200" alt="Image From Pexels">
            </div>
            <div style="padding:10px">
                <a class="fl-pexels-photo-edit" href="javascript:void(0);" onclick="return false;">Edit</a>
                <a class="fl-pexels-photo-remove" href="javascript:void(0);" onclick="return false;">Remove</a>
            </div>
        </div>
    </div>
    <div id="cboxOverlay" style="display:none"></div>
    <div id="bbpx_area" class="bbpx_area">
        <div class="bbpx_area_content">
            <div class="bbpx_area_content_col">
                <div class="bbpx_area_content_col_inner">
                    <div class="bbpx_area_content_col_top">
                        <input type="text" id="bbpx_input" name="bbpx_input" class="w200"
                        placeholder="<?php esc_html_e( 'keyword', 'bbpx' ); ?>"/>
                        <input type="button" id="bbpx_search" class="p20"
                        value="<?php esc_html_e( 'Search', 'bbpx' ); ?>"/>
                        <input type="button" id="bbpx_choose" value="<?php esc_html_e( 'OK', 'bbpx' ); ?>" style="width:100px"/>
                        <button id="bbpx_close" style="float:right;height:24px">X</button>
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
</div>
    