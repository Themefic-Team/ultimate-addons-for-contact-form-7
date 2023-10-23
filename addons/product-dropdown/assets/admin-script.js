jQuery( document ).ready( function(){
    
   
    jQuery('#selected_multiple').hide();
    jQuery('.tag-generator-panel-product-tag').hide();
    jQuery('.tag-generator-panel-product-category #tag-generator-panel-product-category').attr('name','');
    jQuery('.tag-generator-panel-product-tag #tag-generator-panel-product-tag').attr('name','');
    jQuery('.tag-generator-panel-select-layout-style #tag-generator-panel-select-layout-style').attr('style','');



    jQuery('#selected_multiple').hide();
    jQuery('#tag-generator-panel-select-multiple').change(function() {
        if (this.checked) {
            jQuery('#selected_multiple').show();
            jQuery('#selected_single').hide();
        } else {
            jQuery('#selected_multiple').hide();
            jQuery('#selected_single').show();
        }
    });
    
    jQuery( 'input[name="product_by"]' ).on('change', function(){
        var product_by = jQuery( this ).val();

        if( product_by == 'id' ){

            jQuery('.tag-generator-panel-product-category, .tag-generator-panel-product-tag').hide();
            jQuery('.tag-generator-panel-product-category #tag-generator-panel-product-category').attr('name','');
            jQuery('.tag-generator-panel-product-tag #tag-generator-panel-product-tag').attr('name','');

            jQuery('.tag-generator-panel-product-id').show();
            jQuery('.tag-generator-panel-product-id #tag-generator-panel-product-id').attr('name','values');

        }else if( product_by == 'category' ) {

            jQuery('.tag-generator-panel-product-category').show();
            jQuery('.tag-generator-panel-product-category #tag-generator-panel-product-category').attr('name','values');

            jQuery('.tag-generator-panel-product-id, .tag-generator-panel-product-tag').hide();
            jQuery('.tag-generator-panel-product-id #tag-generator-panel-product-id').attr('name','');
            jQuery('.tag-generator-panel-product-tag #tag-generator-panel-product-tag').attr('name','');

        }else {

            jQuery('.tag-generator-panel-product-tag').show();
            jQuery('.tag-generator-panel-product-tag #tag-generator-panel-product-tag').attr('name','values');

            jQuery('.tag-generator-panel-product-id, .tag-generator-panel-product-category').hide();
            jQuery('.tag-generator-panel-product-id #tag-generator-panel-product-id').attr('name','');
            jQuery('.tag-generator-panel-product-category #tag-generator-panel-product-category').attr('name','');

        }
    });




    // jQuery(document).on('wpcf7submit', function (event) {
    //     const formId = event.detail.contactFormId;
    //     const $form = jQuery(`.wpcf7-form-${formId}`);
    
    //     if ($form.length) {
    //         const $textarea = $form.find('textarea[data-form-id="' + formId + '"]');
    //         const targetInputName = $textarea.data('target-input');
    //         const textareaValue = $textarea.val();
    //         $form.find(`input[name="${targetInputName}"]`).val(textareaValue);
    //     }
    // });

} );
