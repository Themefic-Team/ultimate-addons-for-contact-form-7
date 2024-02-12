(function ($) {
    $(document).ready(function () {

        //Receive Webmaster Given Time
        


        // Saving Data to Submit Later
        var form = $('form.wpcf7-form');
        var formFields = form.find('input, textarea');
    
        function isExpired(timestamp) {
            return Date.now() > timestamp;
        }
    
        var savedFormData = localStorage.getItem('contactFormData');
        var savedExpiryTime = localStorage.getItem('contactFormDataExpiry');
    
        if (savedFormData && savedExpiryTime && !isExpired(parseInt(savedExpiryTime))) {
            savedFormData = JSON.parse(savedFormData);
            for (var field in savedFormData) {
                if (savedFormData.hasOwnProperty(field)) {
                    form.find('[name="' + field + '"]').val(savedFormData[field]);
                }
            }
        } else {
            localStorage.removeItem('contactFormData');
            localStorage.removeItem('contactFormDataExpiry');
        }
    
        formFields.on('change', function () {
            var formData = {};
    
            formFields.each(function () {
                formData[$(this).attr('name')] = $(this).val();
            });
    
            localStorage.setItem('contactFormData', JSON.stringify(formData));
            localStorage.setItem('contactFormDataExpiry', (Date.now() + (5 * 60 * 60 * 1000)).toString());
        });
    
        form.on('submit', function () {
            localStorage.removeItem('contactFormData');
            localStorage.removeItem('contactFormDataExpiry');
        });
    });
    

})(jQuery);