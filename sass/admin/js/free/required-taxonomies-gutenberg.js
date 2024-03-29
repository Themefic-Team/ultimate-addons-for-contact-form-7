const {select, dispatch} = wp.data;

//required taxonomies

function TfPrePublishCheck() {
    let lockPost = false;
    uacf7_admin_params.error = false;
    uacf7_admin_params.messages = [];

    let tf_post_pre_save = Object.assign({}, select('core/editor').getCurrentPost(), select('core/editor').getPostEdits());

    if (tf_post_pre_save.hasOwnProperty('categories')) {
        tf_post_pre_save['categories'] = tf_post_pre_save['categories'].filter(function (ele) {
            return ele !== 1;
        });
    }

    jQuery.each(uacf7_admin_params.taxonomies, function (taxonomy, config) {
        if (tf_post_pre_save.hasOwnProperty(taxonomy) && tf_post_pre_save[taxonomy].length === 0) {
            dispatch('core/notices').createNotice(
                'error',
                config.message,
                {
                    id: 'tfNotice_' + taxonomy,
                    isDismissible: false
                }
            );
            uacf7_admin_params.error = lockPost = true;
        }else{
            dispatch('core/notices').removeNotice('tfNotice_' + taxonomy);
        }
    });

    if (lockPost === true) {
        dispatch('core/editor').lockPostSaving();
    } else {
        dispatch('core/editor').unlockPostSaving();
    }

}

TfPrePublishCheck();

let rpc_check_interval = setInterval(TfPrePublishCheck, 500);
