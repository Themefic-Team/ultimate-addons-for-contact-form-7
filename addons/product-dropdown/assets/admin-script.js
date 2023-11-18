$(document).ready(function($){
    var forms  = $(".wpcf7");



    forms.each(function(){

        var formId = $(this).find('input[name="_wpcf7"]').val();

        $('.uacf7-form-'+formId).find('.tag-generator-panel-product-category').hide();
        $('.uacf7-form-'+formId).find('.tag-generator-panel-product-tag').hide();
        $('.uacf7-form-'+formId).find('.tag-generator-panel-product-category #tag-generator-panel-product-category').attr('name','');
        $('.uacf7-form-'+formId).find('.tag-generator-panel-product-tag #tag-generator-panel-product-tag').attr('name','');
        $('.uacf7-form-'+formId).find('.tag-generator-panel-select-layout-style #tag-generator-panel-select-layout-style').attr('style','');
        
        $('.uacf7-form-'+formId).find( 'input[name="product_by"]' ).on('change', function(){
            var product_by = $( this ).val();

            if( product_by == 'id' ){

                $('.uacf7-form-'+formId).find('.tag-generator-panel-product-category, .tag-generator-panel-product-tag').hide();
                $('.uacf7-form-'+formId).find('.tag-generator-panel-product-category #tag-generator-panel-product-category').attr('name','');
                $('.uacf7-form-'+formId).find('.tag-generator-panel-product-tag #tag-generator-panel-product-tag').attr('name','');

                $('.uacf7-form-'+formId).find('.tag-generator-panel-product-id').show();
                $('.uacf7-form-'+formId).find('.tag-generator-panel-product-id #tag-generator-panel-product-id').attr('name','values');

            }else if( product_by == 'category' ) {

                $('.uacf7-form-'+formId).find('.tag-generator-panel-product-category').show();
                $('.tag-generator-panel-product-category #tag-generator-panel-product-category').attr('name','values');

                $('.uacf7-form-'+formId).find('.tag-generator-panel-product-id, .tag-generator-panel-product-tag').hide();
                $('.uacf7-form-'+formId).find('.tag-generator-panel-product-id #tag-generator-panel-product-id').attr('name','');
                $('.uacf7-form-'+formId).find('.tag-generator-panel-product-tag #tag-generator-panel-product-tag').attr('name','');

            }else {

                $('.uacf7-form-'+formId).find('.tag-generator-panel-product-tag').show();
                $('.uacf7-form-'+formId).find('.tag-generator-panel-product-tag #tag-generator-panel-product-tag').attr('name','values');

                $('.uacf7-form-'+formId).find('.tag-generator-panel-product-id, .tag-generator-panel-product-category').hide();
                $('.uacf7-form-'+formId).find('.tag-generator-panel-product-id #tag-generator-panel-product-id').attr('name','');
                $('.uacf7-form-'+formId).find('.tag-generator-panel-product-category #tag-generator-panel-product-category').attr('name','');

            }
        });



    // var product_dropdown_select2 = $('.wpcf7-uacf7_product_dropdown');
    // console.log(product_dropdown_select2);
    // product_dropdown_select2.on('click', function () {
    //     alert();
    // });

    });
    
})($);
