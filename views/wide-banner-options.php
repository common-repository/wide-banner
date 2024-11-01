<div class="wrap">
    <h1><?php _e( 'Wide Banner', 'wide_bn' ); ?></h1>
     <?php _e( 'You like Wide Banner plugin? Please, rate us <a href="https://fr.wordpress.org/plugins/wide-banner/" target="_blank">here</a>', 'wide_bn' ); ?>
    <hr>
 
    
</div>
<div>
    <form name="save-wb" id="save-wb" method="post">
    <table class="form-table" id="create">
        <!-- Background Color -->
        <tbody>
            <tr>
                <th>
                    <?php _e( 'Banner text', 'wide_bn' ); ?> :
                </th>
                <td>
                    <input type="text" name="wb_banner" id="wb_banner">
                </td>
            </tr>
            <tr>
                <th>
                    <?php _e( 'Background color', 'wide_bn' ); ?> :
                </th>
                <td>
                    <input type="color" name="bg_color" id="bg_color" value="#024985" class="changeit">
                    <input type="text" name="bg_color_hexa" id="bg_color_hexa" placeholder="Hex value" value="#024985">
                    <span class="explain"><?php _e( 'Select a color or entre the hex value', 'wide_bn' ); ?></span>
                </td>
            </tr>
            <tr>
                <th>
                    <?php _e( 'Text color', 'wide_bn' ); ?> :
                </th>
                <td>
                    <input type="color" name="text_color" id="text_color" value="#ffffff" class="changeit">
                    <input type="text" name="text_color_hexa" id="text_color_hexa" placeholder="Hex value" value="#ffffff">
                    <span class="explain"><?php _e( 'Select a color or entre the hex value', 'wide_bn' ); ?></span>
                </td>
            </tr>
             <tr>
                <th>
                    <?php _e( 'Add a link?', 'wide_bn' ); ?>
                </th>
                <td>
                    <select name="add_btn" id="add_btn">
                        <option value="nolink"> <?php _e( 'No link', 'wide_bn' ); ?></option>
                         <option value="btn"> <?php _e( 'Add a button', 'wide_bn' ); ?></option>
                         <option value="full"> <?php _e( 'Link on the banner', 'wide_bn' ); ?></option>
                    </select>
                </td>
            </tr>
        
            <tr class="hide">
                <th>
                    <?php _e( 'Text button', 'wide_bn' ); ?>
                </th>
                <td>
                   <input type="text" name="wb_btn_text" id="wb_btn_text">
                </td>
            </tr>
            <tr class="hide">
                <th>
                    <?php _e( 'Button background color', 'wide_bn' ); ?> :
                </th>
                <td>
                    <input type="color" name="btn_bg_color" id="btn_bg_color" value="#ffffff" class="changeit">
                    <input type="text" name="btn_bg_color_hexa" id="btn_bg_color_hexa" placeholder="Hex value" value="#ffffff">
                    <span class="explain"> <?php _e( 'Select a color or entre the hex value', 'wide_bn' ); ?></span>
                </td>
            </tr>
             <tr class="hide">
                <th>
                    <?php _e( 'Button text color', 'wide_bn' ); ?> :
                </th>
                <td>
                    <input type="color" name="btn_color" id="btn_color" value="#024985" class="changeit">
                    <input type="text" name="btn_color_hexa" id="btn_color_hexa" placeholder="Hex value" value="#024985">
                    <span class="explain"><?php _e( 'Select a color or entre the hex value', 'wide_bn' ); ?></span>
                </td>
            </tr>
            <tr class="hideFull">
                <th>
                    <?php _e( 'Link url', 'wide_bn' ); ?> :
                </th>
                <td>
                    <input type="url" name="btn_link" id="btn_link" placeholder="https://www.monsite.fr/mapage.html">
                   
                </td>
            </tr>

        </tbody>
    </table>
    <input type="submit" name="submit" id="save" class="button button-primary" value="<?php _e( 'Save settings', 'wide_bn' ); ?>">
   <div id="form-message"></div>
   </form>
     
</div>
