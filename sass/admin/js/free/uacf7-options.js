// const { divide } = require("lodash");

(function ($) {
    'use strict';
    $(document).ready(function () {

        // get UACF7_metabox and get te append into the form tag
        if ($('.uacf7-metabox.uacf7').length > 0) {
            $('.uacf7-metabox.uacf7').each(function () {
                var $this_clone = $(this).clone();
                $('#contact-form-editor').append($this_clone);
                $('#contact-form-editor').find('.uacf7-metabox').css('display', 'block');
                $(this).remove();
                $('#form-panel').append('<button class="tf-admin-btn tf-btn-secondary uacf7-settings-addon-btn">Addons Settings</button>');
            });
            // scroll to uacf7-metabox gap 50px

            $('.uacf7-settings-addon-btn').on('click', function (e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $(".uacf7-metabox").offset().top - 50
                }, 1000);
            });

        }

        // Field: code_editor
        var TF = TF || {};
        TF.funcs = {};
        TF.vars = {
            onloaded: false,
            $body: $('body'),
            $window: $(window),
            $document: $(document),
            $form_warning: null,
            is_confirm: false,
            form_modified: false,
            code_themes: [],
            is_rtl: $('body').hasClass('rtl'),
        };

        $(document).ready(function () {
            $(".tf-field-code-editor").each(function () {
                if (typeof CodeMirror !== 'function') { return; }
                // console.log("working");
                // return false;
                var $this =
                    $(this),
                    $textarea = $this.find('textarea'),
                    $inited = $this.find('.CodeMirror'),
                    data_editor = $textarea.data('editor');

                if ($inited.length) {
                    $inited.remove();
                }

                var interval = setInterval(function () {
                    if ($this.is(':visible')) {

                        var code_editor = CodeMirror.fromTextArea($textarea[0], data_editor);
                        // load code-mirror theme css.
                        if (data_editor.theme !== 'default' && TF.vars.code_themes.indexOf(data_editor.theme) === -1) {

                            var $cssLink = $('<link>');

                            $('#tf-codemirror-css').after($cssLink);

                            $cssLink.attr({
                                rel: 'stylesheet',
                                id: 'tf-codemirror-' + data_editor.theme + '-css',
                                href: data_editor.cdnURL + '/theme/' + data_editor.theme + '.min.css',
                                type: 'text/css',
                                media: 'all'
                            });

                            TF.vars.code_themes.push(data_editor.theme);

                        }

                        CodeMirror.modeURL = data_editor.cdnURL + '/mode/%N/%N.min.js';
                        CodeMirror.autoLoadMode(code_editor, data_editor.mode);

                        code_editor.on('change', function (editor, event) {
                            $textarea.val(code_editor.getValue()).trigger('change');
                        });

                        clearInterval(interval);

                    }
                });
            });
        });

        // Create an instance of Notyf
        const notyf = new Notyf({
            ripple: true,
            duration: 3000,
            dismissable: true,
            position: {
                x: 'right',
                y: 'top',
            },
        });

        /*
        * window url on change tab click
        * @author: Foysal
        */
        $(window).on('hashchange load', function () {
            let hash = window.location.hash;
            let query = window.location.search;
            let slug = hash.replace('#tab=', '');
            if (hash) {
                let selectedTab = $('.tf-tablinks[data-tab="' + slug + '"]'),
                    parentDiv = selectedTab.closest('.tf-admin-tab-item');

                selectedTab.trigger('click');
                parentDiv.trigger('click');
            }

            if (query.indexOf('dashboard') > -1) {
                let submenu = $("#toplevel_page_tf_settings").find(".wp-submenu");
                submenu.find("a").filter(function (a, e) {
                    return e.href.indexOf(query) > -1;
                }).parent().addClass("current");
            }
        });
        $(document).ready(function () {
            let hash = window.location.hash;
            let query = window.location.search;
            let slug = hash.replace('#tab=', '');
            if (hash) {
                let selectedTab = $('.tf-tablinks[data-tab="' + slug + '"]'),
                    parentDiv = selectedTab.closest('.tf-admin-tab-item');

                selectedTab.trigger('click');
                parentDiv.trigger('click');
            }

            if (query.indexOf('dashboard') > -1) {
                let submenu = $("#toplevel_page_tf_settings").find(".wp-submenu");
                submenu.find("a").filter(function (a, e) {
                    return e.href.indexOf(query) > -1;
                }).parent().addClass("current");
            }
        });

        /*
        * Tab click
        * @author: Foysal
        */
        $(document).on('click', '.tf-tablinks', function (e) {
            e.preventDefault();
            let firstTabId,
                $this = $(this),
                parentDiv = $this.closest('.tf-admin-tab-item'),
                parentTabId = parentDiv.children('.tf-tablinks').attr('data-tab'),
                tabcontent = $('.tf-tab-content'),
                tablinks = $('.tf-tablinks');

            tabcontent.hide();
            tablinks.removeClass('active');

            let tabId = $this.attr('data-tab');
            $('#' + tabId).css('display', 'flex');

            if ($this.next().hasClass('tf-submenu')) {
                firstTabId = parentDiv.find('.tf-submenu li:first-child .tf-tablinks').data('tab');
            }

            if (firstTabId === tabId) {
                parentDiv.find('.tf-submenu li:first-child .tf-tablinks').addClass('active');
            } else {
                $this.addClass('active');
            }
            // url hash update
            window.location.hash = '#tab=' + tabId;

            $(".tf-admin-tab").removeClass('active');

            let submenu = $("#toplevel_page_tf_settings").find(".wp-submenu");
            submenu.find("a").filter(function (a, e) {
                let slug = e.hash.replace('#tab=', '');
                return tabId === slug || parentTabId === slug;
            }).parent().addClass("current").siblings().removeClass("current")
        });

        /*
        * Submenu toggle
        * @author: Foysal
        */
        $(document).on('click', '.tf-admin-tab-item', function (e) {
            e.preventDefault();
            let $this = $(this);

            $this.addClass('open');
            $this.children('ul').slideDown();
            $this.siblings('.tf-admin-tab-item').children('ul').slideUp();
            $this.siblings('.tf-admin-tab-item').removeClass('open');
            $this.siblings('.tf-admin-tab-item').find('li').removeClass('open');
            $this.siblings('.tf-admin-tab-item').find('ul').slideUp();
        });

        /*
        * Each date field initialize flatpickr
        * @author: Foysal
        */
        const tfDateInt = dateSelector => {
            $(dateSelector).each(function () {
                let $this = $(this),
                    dateField = $this.find('input.flatpickr'),
                    format = dateField.data('format'),
                    multiple = dateField.data('multiple'),
                    minDate = dateField.data('min-date');

                if (dateField.length === 2) {
                    let startDate = $this.find('.tf-date-from input.flatpickr').flatpickr({
                        dateFormat: format,
                        minDate: minDate,
                        altInput: true,
                        // altFormat: uacf7_options.tf_admin_date_format,
                        onChange: function (selectedDates, dateStr, instance) {
                            endDate.set('minDate', dateStr);
                        }
                    });
                    let endDate = $this.find('.tf-date-to input.flatpickr').flatpickr({
                        dateFormat: format,
                        minDate: minDate,
                        altInput: true,
                        // altFormat: uacf7_options.tf_admin_date_format,
                        onChange: function (selectedDates, dateStr, instance) {
                            startDate.set('maxDate', dateStr);
                        }
                    });
                } else {
                    dateField.flatpickr({
                        dateFormat: format,
                        minDate: minDate,
                        altInput: true,
                        // altFormat: uacf7_options.tf_admin_date_format,
                        mode: multiple ? 'multiple' : 'single',
                    });
                }
            });
        }
        tfDateInt('.tf-field-date');

        /*
        * Each time field initialize flatpickr
        * @author: Foysal
        */
        const tfTimeInt = timeSelector => {
            $(timeSelector).each(function () {
                let $this = $(this),
                    timeField = $this.find('input.flatpickr'),
                    format = timeField.data('format');

                timeField.flatpickr({
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: format,
                    minuteIncrement: 30,
                });
            });
        }
        tfTimeInt('.tf-field-time');


        /*
        * Each color field initialize wpColorPicker
        * @author: Foysal
        */
        const tfColorInt = colorSelector => {
            $(colorSelector).each(function () {
                let $this = $(this),
                    colorField = $this.find('input.tf-color');

                colorField.wpColorPicker();
            });
        }
        tfColorInt('.tf-field-color');

        /*
        * Custom modal
        * @author: Foysal
        */
        TF_dependency();

        function TF_dependency() {
            $('.tf-tab-content, .tf-taxonomy-metabox').each(function () {
                var $this = $(this);
                $this.find('[data-controller]').each(function () {
                    var $tffields = $(this);
                    if ($tffields.length) {
                        // alert($tffields.length);
                        var normal_ruleset = $.tf_deps.createRuleset(),
                            global_ruleset = $.tf_deps.createRuleset(),
                            normal_depends = [],
                            global_depends = [];

                        $tffields.each(function () {

                            var $field = $(this),
                                controllers = $field.data('controller').split('|'),
                                conditions = $field.data('condition').split('|'),
                                values = $field.data('value').toString().split('|'),
                                is_global = $field.data('depend-global') ? true : false,
                                ruleset = normal_ruleset;

                            $.each(controllers, function (index, depend_id) {

                                var value = values[index] || '',
                                    condition = conditions[index] || conditions[0];

                                ruleset = ruleset.createRule($this.find('[data-depend-id="' + depend_id + '"]'), condition, value);

                                ruleset.include($field);

                                if (is_global) {
                                    global_depends.push(depend_id);
                                } else {
                                    normal_depends.push(depend_id);
                                }

                            });

                        });

                        if (normal_depends.length) {
                            $.tf_deps.enable($this, normal_ruleset, normal_depends);
                        }

                        if (global_depends.length) {
                            $.tf_deps.enable(TF.vars.$body, global_ruleset, global_depends);
                        }
                    }
                });


            });
        }


        /*
        * Custom modal
        * @author: Foysal
        */
        $(document).on('click', '.tf-modal-btn', function (e) {
            e.preventDefault();
            let $this = $(this),
                modal = $('#tf-icon-modal');

            if (modal.length > 0 && modal.hasClass('tf-modal-show')) {
                modal.removeClass('tf-modal-show');
                $('body').removeClass('tf-modal-open');
            } else {
                modal.addClass('tf-modal-show');
                $('body').addClass('tf-modal-open');
            }
        });
        $(document).on("click", '.tf-modal-close', function () {
            $('.tf-modal').removeClass('tf-modal-show');
            $('body').removeClass('tf-modal-open');
        });
        $(document).on('click', function (event) {
            if (!$(event.target).closest(".tf-modal-content,.tf-modal-btn").length) {
                $("body").removeClass("tf-modal-open");
                $(".tf-modal").removeClass("tf-modal-show");
            }
        });

        /*
        * Icon tab
        * @author: Foysal
        */
        $(document).on('click', '.tf-icon-tab', function (e) {
            e.preventDefault();
            let $this = $(this),
                tab = $this.data('tab');

            $('.tf-icon-tab').removeClass('active');
            $this.addClass('active');

            $('#' + tab).addClass('active').siblings().removeClass('active');
        });

        /*
        * Icon select
        * @author: Foysal
        */
        $(document).on('click', '.tf-icon-select .tf-admin-btn, .tf-icon-select .tf-icon-preview', function (e) {
            e.preventDefault();
            let btn = $(this);

            let fieldId = btn.closest('.tf-icon-select').attr('id');
            $('#tf-icon-modal').data('icon-field', fieldId);
        });

        /*
        * Icon select
        * @author: Foysal
        */
        $(document).on('click', '.tf-icon-list li', function (e) {
            e.preventDefault();
            let $this = $(this);

            $('.tf-icon-list li').removeClass('active');
            $this.addClass('active');

            //remove disabled class
            $('.tf-icon-insert').removeClass('disabled');
        });

        /*
        * Icon insert
        * @author: Foysal
        */
        $(document).on('click', '.tf-icon-insert', function (e) {
            e.preventDefault();
            let $this = $(this),
                fieldId = $('#tf-icon-modal').data('icon-field'),
                field = $('#' + fieldId),
                preview = field.find('.tf-icon-preview'),
                icon = $('.tf-icon-list li.active').data('icon');

            if (icon) {
                preview.removeClass('tf-hide');
                field.find('.tf-icon-preview-wrap i').attr('class', icon);
                field.find('.tf-icon-value').val(icon).trigger('change');

                //Close modal
                $('.tf-modal').removeClass('tf-modal-show');
                $('body').removeClass('tf-modal-open');
            }
        })

        /*
        * Icon search
        * @author: Foysal
        */
        $(document).on('change keyup', '.tf-icon-search-input', function () {

            let searchVal = $(this).val(),
                $icons = $('#tf-icon-modal').find('.tf-icon-list li');

            $icons.each(function () {

                var $this = $(this);

                if ($this.data('icon').search(new RegExp(searchVal, 'i')) < 0) {
                    $this.hide();
                } else {
                    $this.show();
                }

            });

        });

        /*
        * Icon remove
        * @author: Foysal
        */
        $(document).on('click', '.tf-icon-preview .remove-icon', function (e) {
            e.preventDefault();
            let $this = $(this),
                preview = $this.closest('.tf-icon-preview'),
                iconSelect = $this.closest('.tf-icon-select'),
                iconLi = $('#tf-icon-modal').find('.tf-icon-list li');

            preview.addClass('tf-hide');
            iconSelect.find('.tf-icon-preview-wrap i').attr('class', '');
            iconSelect.find('.tf-icon-value').val('').trigger('change');

            //remove active class
            iconLi.removeClass('active');
        });

        // uacf7 addone count activate and deactivate addon
        function uacf7_addon_count() {


            var all = $('.uacf7-addon-input-field[type="checkbox"]').length;
            var activated = $('.addon-status.pro').length;
            var deactivate = $('.addon-status.free').length;

            $('.uacf7-addon-filter-button.all .uacf7-addon-filter-cta-count').text(all);
            $('.uacf7-addon-filter-button.activete .uacf7-addon-filter-cta-count').text(activated);
            $('.uacf7-addon-filter-button.deactive .uacf7-addon-filter-cta-count').text(deactivate);
        }
        uacf7_addon_count();


        // Uacf7 Addon save data
        $(document).on('change', '.uacf7-addon-input-field', function (e) {
            e.preventDefault();
            uacf7_addon_count();
            if ($(this).is(':checked')) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
            $(".tf-option-form.tf-ajax-save").submit();

        });


        $(document).on('click', '.uacf7-addon-filter-button', function (e) {
            e.preventDefault();
            $(this).addClass('active').siblings().removeClass('active');
            if ($(this).hasClass('all')) {
                $('.uacf7-single-addon-setting').css('display', 'block');
            } else if ($(this).hasClass('activete')) {
                $('.uacf7-single-addon-setting').css('display', 'none');
                $('.uacf7-single-addon-setting .addon-status.pro').closest('.uacf7-single-addon-setting').css('display', 'block');
            } else if ($(this).hasClass('deactive')) {
                $('.uacf7-single-addon-setting').css('display', 'none');
                $('.uacf7-single-addon-setting .addon-status.free').closest('.uacf7-single-addon-setting').css('display', 'block');
            }
        });

        // Uacf7 Ultimate Innput Filter
        $(document).on('keyup', '#uacf7-addon-filter', function () {
            $('.uacf7-addon-filter-button.all').addClass('active').siblings().removeClass('active');
            $('.uacf7-addons-settings-page').find('.tf-field-notice-inner').remove();
            var filter_string = $(this).val().toLowerCase();
            if (filter_string == '') {

                $('.uacf7-single-addon-setting').css('display', 'block');
            } else {
                $('.uacf7-single-addon-setting').css('display', 'none');
                $('.uacf7-single-addon-setting[data-filter*="' + filter_string + '"]').css('display', 'block');
                if ($('.uacf7-single-addon-setting[data-filter*="' + filter_string + '"]').length == 0) {
                    $('.uacf7-addons-settings-page').append('<div class="tf-field-notice-inner tf-notice-danger" style="display: block;">No Addon Found ....</div>');
                } else {
                    $('.uacf7-addons-settings-page').find('.tf-field-notice-inner').remove();
                }
            }


        });
        /*
        * Options ajax save
        * @author: Foysal
        */
        $(document).on('submit', '.tf-option-form.tf-ajax-save', function (e) {
            e.preventDefault();
            let $this = $(this),
                submitBtn = $this.find('.tf-submit-btn'),
                data = new FormData(this);
            var fontsfile = $('.itinerary-fonts-file').prop("files");
            if (typeof fontsfile !== "undefined") {
                for (var i = 0; i < fontsfile.length; i++) {
                    data.append('file[]', fontsfile[i]);
                }
            }
            // get tf_import_option from data  
            let tf_import_option = false
            if (typeof data.get('tf_import_option') !== "undefined" && data.get('tf_import_option') != null && data.get('tf_import_option').trim() != '') {

                //  confirm data before send
                if (!confirm(uacf7_setting_options.tf_export_import_msg.import_confirm)) {
                    return;
                }

                tf_import_option = true;
            }

            data.append('action', 'uacf7_options_save');

            $.ajax({
                url: uacf7_setting_options.ajax_url,
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    if (tf_import_option == true) {
                        $this.find('.tf-import-btn').addClass('tf-btn-loading');
                    }
                    submitBtn.addClass('tf-btn-loading');
                },
                success: function (response) {
                    let obj = JSON.parse(response);
                    if (obj.status === 'success') {
                        notyf.success(obj.message);

                        if (tf_import_option == true) {
                            window.location.reload();;
                        }

                    } else {
                        notyf.error(obj.message);
                    }
                    submitBtn.removeClass('tf-btn-loading');

                    if (tf_import_option == true) {
                        $this.find('.tf-import-btn').removeClass('tf-btn-loading');
                    }

                },
                error: function (error) {
                    console.log(error);
                }
            });
        });

        /*
        * Each select2 field initialize select2
        * @author: Foysal, Sydur
        */
        const tfSelect2Int = select2Selector => {
            let $this = select2Selector,
                id = $this.attr('id'),
                placeholder = $this.data('placeholder');

            $('#' + id + '').select2({
                placeholder: placeholder,
                allowClear: true,
            });
        }

        $('select.tf-select2').each(function () {
            var $this = $(this);
            tfSelect2Int($this);
        });


        /*
        * Options WP editor
        * @author: Sydur
        */
        function TF_wp_editor($id) {
            wp.editor.initialize($id, {
                tinymce: {
                    wpautop: true,
                    plugins: 'charmap colorpicker hr lists paste tabfocus textcolor fullscreen wordpress wpautoresize wpeditimage wpemoji wpgallery wplink wptextpattern',
                    toolbar1: 'formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,wp_more,spellchecker,fullscreen,wp_adv,listbuttons',
                    toolbar2: 'styleselect,strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help',
                    //   textarea_rows : 20
                },
                quicktags: { buttons: 'strong,em,link,block,del,ins,img,ul,ol,li,code,more,close' },
                mediaButtons: false,
            });
        }

        $('textarea.wp_editor, textarea.tf_wp_editor').each(function () {
            let $id = $(this).attr('id');
            TF_wp_editor($id);
        });

        /*
        * Booking Confirmation Field Fixed
        * @since 2.9.28
        * @author: Jahid
        */
        TF_Booking_Confirmation();
        function TF_Booking_Confirmation() {
            if ($('.tf-repeater-wrap .tf-single-repeater-book-confirm-field').length > 0) {
                $('.tf-repeater-wrap .tf-single-repeater-book-confirm-field').each(function () {
                    let $this = $(this);
                    let repeaterCount = $this.find('input[name="tf_repeater_count"]').val();
                    if (0 == repeaterCount || 1 == repeaterCount || 2 == repeaterCount) {
                        $this.find('.tf_hidden_fields').hide();
                        $this.find('.tf-repeater-icon-clone').hide();
                        $this.find('.tf-repeater-icon-delete').hide();
                    }
                });
            }
        }
        /*
        * Add New Repeater Item
        * @author: Sydur
        */
        $(document).on('click', '.tf-repeater-icon-add', function () {
            var $this = $(this);
            var $this_parent = $this.parent().parent();
            var id = $(this).attr("data-repeater-id");
            var max = $(this).attr("data-repeater-max");
            var add_value = $this_parent.find('.tf-single-repeater-clone-' + id + ' .tf-single-repeater-' + id + '').clone();
            var count = $this_parent.find('.tf-repeater-wrap-' + id + ' .tf-single-repeater-' + id + '').length;
            var parent_field = add_value.find(':input[name="tf_parent_field"]').val();
            var current_field = add_value.find(':input[name="tf_current_field"]').val();
            var maxIndex = parseInt($(this).closest('.tf-repeater').attr("data-max-index")) + 1;
            $(this).closest('.tf-repeater').attr("data-max-index", maxIndex);

            $this_parent.find('.tf-repeater-wrap .tf-field-notice-inner').remove();
            // Chacked maximum repeater
            if (max != '' && count >= max) {
                $this_parent.find('.tf-repeater-wrap').append('<div class="tf-field-notice-inner tf-notice-danger" style="display: block;">You have reached limit.</div>');
                return false;
            }

            // Repeater Count Add Value
            add_value.find(':input[name="tf_repeater_count"]').val(maxIndex);

            let repeatDateField = add_value.find('.tf-field-date');
            if (repeatDateField.length > 0) {
                repeatDateField.find('input').each(function () {

                    if ($(this).attr('name') == '' || typeof $(this).attr('name') === "undefined") {
                        $(this).remove()
                    }
                });
                tfDateInt(repeatDateField);
            }

            let repeatTimeField = add_value.find('.tf-field-time');
            if (repeatTimeField.length > 0) {
                tfTimeInt(repeatTimeField);
            }

            let repeatColorField = add_value.find('.tf-field-color');
            if (repeatColorField.length > 0) {
                repeatColorField.find('input.tf-color').each(function () {
                    var color_field = $(this).clone();

                    if ($(this).closest('li').length > 0) {
                        $(this).closest('li').append(color_field);
                    } else {
                        $(this).closest('.tf-fieldset').append(color_field);
                    }
                    $(this).closest('.wp-picker-container').remove();
                });

                tfColorInt(repeatColorField);
            }

            if (parent_field == '') {
                // Update  repeater name And id
                add_value.find(':input').each(function () {
                    this.name = this.name.replace('_____', '').replace('[' + current_field + '][00]', '[' + current_field + '][' + maxIndex + ']');
                    this.id = this.id.replace('_____', '').replace('[' + current_field + '][00]', '[' + current_field + '][' + maxIndex + ']');
                });
                var update_paren = add_value.find('.tf-repeater input[name="tf_parent_field"]').val();
                if (typeof update_paren !== "undefined") {
                    var update_paren = update_paren.replace('[' + current_field + '][00]', '[' + current_field + '][' + maxIndex + ']');
                }
                add_value.find('.tf-repeater input[name="tf_parent_field"]').val(update_paren);

            } else {
                // Update  repeater name And id
                var update_paren = add_value.find(':input[name="tf_parent_field"]').val();
                add_value.find(':input').each(function () {
                    this.name = this.name.replace('_____', '').replace('[' + current_field + '][00]', '[' + current_field + '][' + maxIndex + ']');
                    this.id = this.id.replace('_____', '').replace('[' + current_field + '][00]', '[' + current_field + '][' + maxIndex + ']');
                });
            }
            // Update Repeaterr label
            add_value.find('label').each(function () {
                var for_value = $(this).attr("for");
                if (typeof for_value !== "undefined") {
                    for_value = for_value.replace('_____', '').replace('[' + current_field + '][00]', '[' + current_field + '][' + maxIndex + ']');
                    $(this).attr("for", for_value);
                }
            });
            // Update Icon select id
            add_value.find('.tf-icon-select').each(function (index) {
                var icon_id = $(this).attr("id");
                if (typeof icon_id !== "undefined") {
                    icon_id = icon_id + index + maxIndex;
                    $(this).attr("id", icon_id)

                }
            });
            // Update Data depend id
            add_value.find('[data-depend-id]').each(function () {
                var data_depend_id = $(this).attr("data-depend-id");
                if (typeof data_depend_id !== "undefined") {
                    data_depend_id = data_depend_id.replace('[' + current_field + '][00]', '[' + current_field + '][' + maxIndex + ']');
                    $(this).attr("data-depend-id", data_depend_id);
                }
            });
            // Update Data Controller
            add_value.find('[data-controller]').each(function () {
                var data_controller = $(this).attr("data-controller");
                if (typeof data_controller !== "undefined") {
                    data_controller = data_controller.replace('[' + current_field + '][00]', '[' + current_field + '][' + maxIndex + ']');
                    $(this).attr("data-controller", data_controller);
                }
            });

            // Replace Old editor
            add_value.find('.wp-editor-wrap').each(function () {
                var textarea = $(this).find('.tf_wp_editor').show();
                // Get content of a specific editor:
                var tf_editor_ex_data = $('#' + textarea.attr('id') + '').val();
                if (tf_editor_ex_data && typeof tf_editor_ex_data !== "undefined") {
                    var textarea_content = tinymce.get(textarea.attr('id')).getContent();
                } else {
                    var textarea_content = '';
                }
                textarea.val(textarea_content);
                $(this).closest('.tf-field-textarea').append(textarea);
                $(this).remove();
            });

            // Update Data Append value
            var append = $this_parent.find('.tf-repeater-wrap-' + id + '');

            add_value.appendTo(append).show();

            // replace new editor
            add_value.find('textarea.parent_wp_editor').each(function () {
                var count = Math.random().toString(36).substring(3, 9) + 1;
                // this.id = this.id.replace('' + current_field + '__00', '' + current_field + '__' + count + '');
                $(this).attr('id', current_field + count);
                $(this).attr('data-count-id', count);
                var parent_repeater_id = $(this).attr('id');
                TF_wp_editor(parent_repeater_id);
            });

            // replace new Select 2
            add_value.find('select.tf-select2-parent').each(function () {
                this.id = this.id.replace('' + current_field + '__00', '' + current_field + '__' + maxIndex + '');
                var parent_repeater_id = $(this).attr('id');
                var $this = $(this);
                tfSelect2Int($this);
            });

            // repeater dependency repeater
            TF_dependency();

            // Booking Confirmation repeater Hidden field
            TF_Booking_Confirmation();
        });

        // Repeater Delete Value
        $(document).on('click', '.tf-repeater-icon-delete', function () {
            var max = $(this).attr("data-repeater-max");
            var $this_parent = $(this).closest('.tf-repeater-wrap');
            var count = $this_parent.find('.tf-single-repeater').length;
            // Chacked maximum repeater

            if (confirm("Are you sure to delete this item?")) {
                $this_parent.find('.tf-field-notice-inner').remove();
                $(this).closest('.tf-single-repeater').remove();
            }
            return false;
        });

        /*
        * Clone Repeater Item
        * @author: Sydur
        */
        $(document).on('click', '.tf-repeater-icon-clone', function () {
            var $this_parent = $(this).closest('.tf-repeater-wrap');
            let clone_value = $(this).closest('.tf-single-repeater').clone();
            var max = $(this).attr("data-repeater-max");
            var parent_field = clone_value.find('input[name="tf_parent_field"]').val();
            var current_field = clone_value.find('input[name="tf_current_field"]').val();
            var repeater_count = clone_value.find('input[name="tf_repeater_count"]').val();
            var count = $this_parent.find('.tf-single-repeater-' + current_field + '').length;
            var maxIndex = parseInt($(this).closest('.tf-repeater').attr("data-max-index")) + 1;
            $(this).closest('.tf-repeater').attr("data-max-index", maxIndex);

            $this_parent.find('.tf-field-notice-inner').remove();
            // Chacked maximum repeater
            if (max != '' && count >= max) {
                $this_parent.append('<div class="tf-field-notice-inner tf-notice-danger" style="display: block;">You have reached limit in free version. Please subscribe to Pro for unlimited access</div>');
                return false;
            }

            // Repeater Room Unique ID
            var room_uniqueid = clone_value.find('.unique-id input');
            if (typeof room_uniqueid !== "undefined") {
                clone_value.find('.unique-id input').val(new Date().valueOf() + count);
            }

            let repeatDateField = clone_value.find('.tf-field-date');

            if (repeatDateField.length > 0) {
                repeatDateField.find('input').each(function () {
                    if ($(this).attr('name') == '' || typeof $(this).attr('name') === "undefined") {
                        $(this).remove();
                    }
                });
                tfDateInt(repeatDateField);
            }

            let repeatTimeField = clone_value.find('.tf-field-time');
            if (repeatTimeField.length > 0) {
                tfTimeInt(repeatTimeField);
            }

            let repeatColorField = clone_value.find('.tf-field-color');
            if (repeatColorField.length > 0) {
                repeatColorField.find('input.tf-color').each(function () {
                    var color_field = $(this).clone();

                    if ($(this).closest('li').length > 0) {
                        $(this).closest('li').append(color_field);
                    } else {
                        $(this).closest('.tf-fieldset').append(color_field);
                    }
                    $(this).closest('.wp-picker-container').remove();
                });

                tfColorInt(repeatColorField);
            }
            if (parent_field == '') {
                // Replace input id and name
                clone_value.find(':input').each(function () {
                    if ($(this).closest('.tf-single-repeater-clone').length == 0) {
                        this.name = this.name.replace('_____', '').replace('[' + current_field + '][' + repeater_count + ']', '[' + current_field + '][' + maxIndex + ']');
                        this.id = this.id.replace('_____', '').replace('[' + current_field + '][' + repeater_count + ']', '[' + current_field + '][' + maxIndex + ']');
                    }
                });
                var update_paren = clone_value.find('.tf-repeater input[name="tf_parent_field"]').val();
                if (typeof update_paren !== "undefined") {
                    var update_paren = update_paren.replace('[' + current_field + '][' + repeater_count + ']', '[' + current_field + '][' + maxIndex + ']');
                }
                clone_value.find('.tf-repeater input[name="tf_parent_field"]').val(update_paren);

            } else {
                // Replace input id and name
                clone_value.find(':input').each(function () {
                    if ($(this).closest('.tf-single-repeater-clone').length == 0) {
                        this.name = this.name.replace('_____', '').replace('[' + current_field + '][' + repeater_count + ']', '[' + current_field + '][' + maxIndex + ']');
                        this.id = this.id.replace('_____', '').replace('[' + current_field + '][' + repeater_count + ']', '[' + current_field + '][' + maxIndex + ']');
                    }
                });
            }
            clone_value.find('label').each(function () {
                var for_value = $(this).attr("for");
                if (typeof for_value !== "undefined") {
                    for_value = for_value.replace('_____', '').replace('[' + current_field + '][' + repeater_count + ']', '[' + current_field + '][' + maxIndex + ']');
                    var for_value = $(this).attr("for", for_value);
                }
            });
            // Update Icon select id
            clone_value.find('.tf-icon-select').each(function (index) {
                var icon_id = $(this).attr("id");
                if (typeof icon_id !== "undefined") {
                    icon_id = icon_id + index + maxIndex;
                    $(this).attr("id", icon_id)

                }
            });
            // Replace Data depend id ID
            clone_value.find('[data-depend-id]').each(function () {
                var data_depend_id = $(this).attr("data-depend-id");
                if (typeof data_depend_id !== "undefined") {
                    data_depend_id = data_depend_id.replace('[' + current_field + '][' + repeater_count + ']', '[' + current_field + '][' + maxIndex + ']');
                    $(this).attr("data-depend-id", data_depend_id);
                }
            });
            // Replace Data depend id ID
            clone_value.find('[data-controller]').each(function () {
                var data_controller = $(this).attr("data-controller");
                if (typeof data_controller !== "undefined") {
                    data_controller = data_controller.replace('[' + current_field + '][' + repeater_count + ']', '[' + current_field + '][' + maxIndex + ']');
                    $(this).attr("data-controller", data_controller);
                }
            });
            // Replace Data repeter Count id ID
            clone_value.find('input[name="tf_repeater_count"]').val(maxIndex)

            // Replace Old editor
            clone_value.find('.wp-editor-wrap').each(function () {
                var textarea = $(this).find('.tf_wp_editor').show();
                // Get content of a specific editor:
                var tf_editor_ex_data = $('#' + textarea.attr('id') + '').val();
                var textarea_id = textarea.attr('id');
                if (textarea_id != '' && typeof textarea_id !== "undefined") {
                    // var textarea_content = tinymce.get(textarea.attr('id')).getContent();
                    var textarea_content = tinymce.editors[textarea_id].getContent();
                } else {
                    var textarea_content = '';
                }
                textarea.val(textarea_content);
                $(this).closest('.tf-field-textarea').append(textarea);
                $(this).remove();
            });

            // Replace Old Select 2
            clone_value.find('.tf-field-select2').each(function () {

                var get_selected_value = $(this).find('select.tf-select-two').select2('val')
                $(this).find('select.tf-select-two').removeAttr("data-select2-id aria-hidden tabindex");
                $(this).find('select.tf-select-two option').removeAttr("data-select2-id");
                $(this).find('select.tf-select-two').removeClass("select2-hidden-accessible");
                var select2 = $(this).find('select.tf-select-two').show();

                select2.val(get_selected_value);
                $(this).find('.tf-fieldset').append(select2);
                $(this).find('span.select2-container').remove();
            });

            //Append Value
            $(this).closest('.tf-repeater-wrap').append(clone_value).show();

            // Clone Wp Editor
            clone_value.find('textarea.parent_wp_editor, textarea.wp_editor').each(function () {
                var count = Math.random().toString(36).substring(3, 9) + 1;
                $(this).attr('id', current_field + count);
                $(this).attr('data-count-id', count);
                var parent_repeater_id = $(this).attr('id');
                TF_wp_editor(parent_repeater_id);
            });

            // Clone Select 2
            clone_value.find('select.tf-select2-parent, select.tf-select2').each(function () {
                this.id = this.id.replace('' + current_field + '__' + repeater_count, '' + current_field + '__' + maxIndex + '');
                var $this = $(this);
                tfSelect2Int($this);
            });

            // Dependency value
            TF_dependency();
        });

        // Repeater show hide
        $(document).on('click', '.tf-repeater-title, .tf-repeater-icon-collapse', function () {
            var tf_repater_fieldname = $(this).closest('.tf-single-repeater').find('input[name=tf_current_field]').val();
            $(this).closest('.tf-single-repeater-' + tf_repater_fieldname + '').find('.tf-repeater-content-wrap').slideToggle();
            $(this).closest('.tf-single-repeater-' + tf_repater_fieldname + '').children('.tf-repeater-content-wrap').toggleClass('hide');
            if ($(this).closest('.tf-single-repeater-' + tf_repater_fieldname + '').children('.tf-repeater-content-wrap').hasClass('hide') == true) {
                $(this).closest('.tf-single-repeater-' + tf_repater_fieldname + ' .tf-repeater-header').children('.tf-repeater-icon-collapse').html('<i class="fa-solid fa-angle-down"></i>');
            } else {
                $(this).closest('.tf-single-repeater-' + tf_repater_fieldname + ' .tf-repeater-header').children('.tf-repeater-icon-collapse').html('<i class="fa-solid fa-angle-up"></i>');
            }
        });

        // Repeater Drag and  show
        $(".tf-repeater-wrap").sortable({
            handle: '.tf-repeater-icon-move',
            start: function (event, ui) { // turn TinyMCE off while sorting (if not, it won't work when resorted)
                var textareaID = $(ui.item).find('.tf_wp_editor').attr('id');

            },
            stop: function (event, ui) { // re-initialize TinyMCE when sort is completed
                $(ui.item).find('.tf_wp_editor').each(function () {
                    var textareaID = $(this).attr('id');
                    tinyMCE.execCommand('mceRemoveEditor', false, textareaID);
                    tinyMCE.execCommand('mceAddEditor', false, textareaID);
                });

                // $(this).find('.update-warning').show();
            }
        });


        // TAB jquery
        $(document).on('click', '.tf-tab-item', function () {
            var $this = $(this);
            var tab_id = $this.data('tab-id');
            if ($this.parent().parent().find('.tf-tab-item-content').hasClass("show") == true) {
                $this.parent().parent().find('.tf-tab-item-content').removeClass('show');
            }

            $this.parent().find('.tf-tab-item').removeClass('show');

            $this.addClass('show');
            $this.parent().parent().find('.tf-tab-item-content[data-tab-id = ' + tab_id + ']').addClass('show');

        });


        $(document).on('click', '.tf-import-btn', function (event) {
            event.preventDefault();
            var textarea = $('textarea[name="tf_import_option"]');
            var form_id = textarea.attr('data-form-id');
            var importData = textarea.val().trim();
            if (importData == '') {
                alert(uacf7_setting_options.tf_export_import_msg.import_empty);
                let importField = $('textarea[name="tf_import_option"]');
                importField.focus();
                importField.css('border', '1px solid red');
                return;
            }

            if (form_id == 0) {
                // Triger the form submit
                $(".tf-option-form.tf-ajax-save").submit();
            } else {
                //confirm data before send
                if (!confirm(uacf7_setting_options.tf_export_import_msg.import_confirm)) {
                    return;
                }
                $.ajax({
                    url: uacf7_setting_options.ajax_url,
                    method: 'POST',
                    data: {
                        action: 'uacf7_option_import',
                        tf_import_option: importData,
                        form_id: form_id,
                        ajax_nonce: uacf7_setting_options.nonce,
                    },
                    beforeSend: function () {
                        $('.tf-import-btn').html('Importing...');
                        $('.tf-import-btn').attr('disabled', 'disabled');
                    },
                    success: function (response) {
                        if (response.data.status == 'success') {
                            // alert(uacf7_setting_options.tf_export_import_msg.imported);
                            $('.tf-import-btn').html('Imported');
                            notyf.success(response.data.message);
                            window.location.reload();
                        } else {
                            notyf.error(response.data.message);
                            // alert('Something went wrong!');
                        }
                    }
                });
            }
        });

        // $(document).on('click', '.tf-import-btn', function (event) {
        //     event.preventDefault();

        //     // Get the import URL from the button's href attribute 
        //     // Get the import data from the textarea

        //     var textarea = $('textarea[name="tf_import_option"]');
        //     var form_id = textarea.attr('data-form-id');
        //     var importData = textarea.val().trim();
        //     if (importData == '') {
        //         alert(uacf7_setting_options.tf_export_import_msg.import_empty);
        //         let importField = $('textarea[name="tf_import_option"]');
        //         importField.focus();
        //         importField.css('border', '1px solid red');
        //         return;
        //     } else {
        //         //confirm data before send
        //         if (!confirm(uacf7_setting_options.tf_export_import_msg.import_confirm)) {
        //             return;
        //         }

        //         $.ajax({
        //             url: uacf7_setting_options.ajax_url,
        //             method: 'POST',
        //             data: {
        //                 action: 'uacf7_option_import',
        //                 tf_import_option: importData,
        //                 form_id: form_id,
        //                 ajax_nonce: uacf7_setting_options.nonce,
        //             },
        //             beforeSend: function () {
        //                 $('.tf-import-btn').html('Importing...');
        //                 $('.tf-import-btn').attr('disabled', 'disabled');
        //             },
        //             success: function (response) {
        //                 if (response.success) {
        //                     alert(uacf7_setting_options.tf_export_import_msg.imported);
        //                     $('.tf-import-btn').html('Imported');
        //                     window.location.reload();
        //                 } else {
        //                     alert('Something went wrong!');
        //                 }
        //             }
        //         });
        //     }
        // });

    });

    // $(document).ready(function () {
    //     $('.tf-import-btn').on('click', function (event) {

    //     })
    // });

    //export the data in txt file
    jQuery(document).ready(function ($) {
        $('.tf-export-btn').on('click', function (event) {
            event.preventDefault();

            // Get the textarea value
            var textarea = $('textarea[name="tf_export_option"]');
            var option_name = textarea.attr('data-option');
            var textareaValue = textarea.val();

            // Create a blob with the textarea value
            var blob = new Blob([textareaValue], { type: 'text/plain' });

            // Create a temporary URL for the blob
            var url = window.URL.createObjectURL(blob);

            // Create a temporary link element
            var link = document.createElement('a');
            link.href = url;
            link.download = option_name + '.json';

            // Programmatically click the link to initiate the file download
            link.click();

            // Clean up the temporary URL
            window.URL.revokeObjectURL(url);
        });
    });
})(jQuery);


function openTab(evt, tabName) {
    evt.preventDefault();
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tf-tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tf-tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.target.className += " active";
    jQuery(".tf-admin-tab").removeClass('active');
}

var frame, gframe;
(function ($) {
    // Single Image remove
    $(document).on("click", ".tf-image-close", function (e) {
        e.preventDefault();
        $this = $(this);
        var fieldname = $(this).attr("tf-field-name");
        var tf_preview_class = fieldname.replace(/[.[\]_-]/g, '_');

        $this.parent().parent().find('input').val('');
        $this.parent().html('');

    });

    // Gallery Image remove
    $(document).on("click", ".tf-gallery-remove", function (e) {
        e.preventDefault();
        $this = $(this);
        var fieldname = $(this).attr("tf-field-name");
        var tf_preview_class = fieldname.replace(/[.[\]_-]/g, '_');

        $this.parent().parent().find('input').val('');
        $this.parent().parent().find('.tf-fieldset-gallery-preview').html('');
        $('a.tf-gallery-edit, a.tf-gallery-remove').css("display", "none");

    });

    $(document).ready(function () {

        // Single Image Upload

        $('body').on('click', '.tf-media-upload', function (e) {
            var $this = $(this);
            var fieldname = $(this).attr("tf-field-name");
            var tf_preview_class = fieldname.replace(/[.[\]_-]/g, '_');

            frame = wp.media({
                title: "Select Image",
                button: {
                    text: "Insert Image"
                },
                multiple: false
            });
            frame.on('select', function () {

                var attachment = frame.state().get('selection').first().toJSON();
                $this.parent().parent().find('input').val(attachment.url);
                $this.parent().parent().find('.tf-fieldset-media-preview').html(`<div class="tf-image-close" tf-field-name='${fieldname}'>✖</div><img src='${attachment.url}' />`);
            });
            frame.open();
            return false;
        });

        // Gallery Image Upload

        $('body').on('click', '.tf-gallery-upload, .tf-gallery-edit', function (e) {
            var $this = $(this);
            var fieldname = $(this).attr("tf-field-name");
            var tf_preview_class = fieldname.replace(/[.[\]_-]/g, '_');
            gframe = wp.media({
                title: "Select Gallery",
                button: {
                    text: "Insert Gallery"
                },
                multiple: 'add'
            });

            gframe.on('open', function () {
                var selection = gframe.state().get('selection');
                var ids_value = $this.parent().parent().find('input').val();

                if (ids_value.length > 0) {
                    var ids = ids_value.split(',');

                    ids.forEach(function (id) {
                        attachment = wp.media.attachment(id);
                        attachment.fetch();
                        selection.add(attachment ? [attachment] : []);
                    });
                }
            });

            gframe.on('select', function () {
                var image_ids = [];
                var image_urls = [];
                var attachments = gframe.state().get('selection').toJSON();
                $this.parent().parent().find('.tf-fieldset-gallery-preview').html('');
                for (i in attachments) {
                    var attachment = attachments[i];
                    image_ids.push(attachment.id);
                    image_urls.push(attachment.url);
                    $this.parent().parent().find('.tf-fieldset-gallery-preview').append(`<img src='${attachment.url}' />`);
                }
                $this.parent().parent().find('input').val(image_ids.join(","));
                $this.parent().find('a.tf-gallery-edit, a.tf-gallery-remove').css("display", "inline-block");
            });

            gframe.open();
            return false;
        });



        // Texonomy submit event
        $('#addtag > .submit #submit').click(function () {
            $(".tf-fieldset-media-preview").html("");
        });

        // Switcher Value Changed
        $(document).on("change", ".tf-switch", function (e) {
            var $this = $(this);
            if (this.checked) {
                var $this = $(this);
                var value = $this.val(1);
            } else {
                var $this = $(this);
                var value = $this.val('');
            }
        });



        $('.tf-mobile-tabs').click(function (e) {
            e.preventDefault();
            $(".tf-admin-tab").toggleClass('active');
        });


        $('.tf-faq-title').click(function () {
            var $this = $(this);
            if (!$this.hasClass("active")) {
                $(".tf-faq-desc").slideUp(400);
                $(".tf-faq-title").removeClass("active");
            }
            $this.toggleClass("active");
            $this.next().slideToggle();
        });
    });


})(jQuery);


// Field Dependency

(function ($) {

    'use strict';

    function Rule(controller, condition, value) {
        this.init(controller, condition, value);
    }

    $.extend(Rule.prototype, {

        init: function (controller, condition, value) {

            this.controller = controller;
            this.condition = condition;
            this.value = value;
            this.rules = [];
            this.controls = [];

        },

        evalCondition: function (context, control, condition, val1, val2) {

            if (condition == '==') {

                return this.checkBoolean(val1) == this.checkBoolean(val2);

            } else if (condition == '!=') {

                return this.checkBoolean(val1) != this.checkBoolean(val2);

            } else if (condition == '>=') {

                return Number(val2) >= Number(val1);

            } else if (condition == '<=') {

                return Number(val2) <= Number(val1);

            } else if (condition == '>') {

                return Number(val2) > Number(val1);

            } else if (condition == '<') {

                return Number(val2) < Number(val1);

            } else if (condition == '()') {

                return window[val1](context, control, val2);

            } else if (condition == 'any') {

                if ($.isArray(val2)) {
                    for (var i = val2.length - 1; i >= 0; i--) {
                        if ($.inArray(val2[i], val1.split(',')) !== -1) {
                            return true;
                        }
                    }
                } else {
                    if ($.inArray(val2, val1.split(',')) !== -1) {
                        return true;
                    }
                }

            } else if (condition == 'not-any') {

                if ($.isArray(val2)) {
                    for (var i = val2.length - 1; i >= 0; i--) {
                        if ($.inArray(val2[i], val1.split(',')) == -1) {
                            return true;
                        }
                    }
                } else {
                    if ($.inArray(val2, val1.split(',')) == -1) {
                        return true;
                    }
                }

            }

            return false;

        },

        checkBoolean: function (value) {

            switch (value) {

                case true:
                case 'true':
                case 1:
                case '1':
                    value = true;
                    break;

                case null:
                case false:
                case 'false':
                case 0:
                case '0':
                    value = false;
                    break;

            }

            return value;
        },

        checkCondition: function (context) {

            if (!this.condition) {
                return true;
            }

            var control = context.find(this.controller);

            var control_value = this.getControlValue(context, control);

            if (control_value === undefined) {
                return false;
            }

            control_value = this.normalizeValue(control, this.value, control_value);

            return this.evalCondition(context, control, this.condition, this.value, control_value);
        },

        normalizeValue: function (control, baseValue, control_value) {

            if (typeof baseValue == 'number') {
                return parseFloat(control_value);
            }

            return control_value;
        },

        getControlValue: function (context, control) {

            if (control.length > 1 && (control.attr('type') == 'radio' || control.attr('type') == 'checkbox')) {

                return control.filter(':checked').map(function () {
                    return this.value;
                }).get();

            } else if (control.attr('type') == 'checkbox' || control.attr('type') == 'radio') {

                return control.is(':checked');

            }

            return control.val();

        },

        createRule: function (controller, condition, value) {
            var rule = new Rule(controller, condition, value);
            this.rules.push(rule);
            return rule;
        },

        include: function (input) {
            this.controls.push(input);
        },

        applyRule: function (context, enforced) {

            var result;

            if (typeof (enforced) == 'undefined') {
                result = this.checkCondition(context);
            } else {
                result = enforced;
            }

            var controls = $.map(this.controls, function (elem, idx) {
                return context.find(elem);
            });

            if (result) {

                $(controls).each(function () {
                    $(this).removeClass('tf-depend-on');
                });

                $(this.rules).each(function () {
                    this.applyRule(context);
                });

            } else {

                $(controls).each(function () {
                    $(this).addClass('tf-depend-on');
                });

                $(this.rules).each(function () {
                    this.applyRule(context, false);
                });

            }
        }
    });

    function Ruleset() {
        this.rules = [];
    };

    $.extend(Ruleset.prototype, {

        createRule: function (controller, condition, value) {
            var rule = new Rule(controller, condition, value);
            this.rules.push(rule);
            return rule;
        },

        applyRules: function (context) {
            $(this.rules).each(function () {
                this.applyRule(context);
            });
        }
    });

    $.tf_deps = {

        createRuleset: function () {
            return new Ruleset();
        },

        enable: function (selection, ruleset, depends) {

            selection.on('change keyup', function (elem) {

                var depend_id = elem.target.getAttribute('data-depend-id') || elem.target.getAttribute('data-sub-depend-id');

                if (depends.indexOf(depend_id) !== -1) {
                    ruleset.applyRules(selection);
                }

            });

            ruleset.applyRules(selection);

            return true;
        }
    };

})(jQuery);



/**
 * Shortcode generator js
 * @author Abu Hena
 * @since 2.9.3
 */
(function ($) {
    //get each of the field value
    $(document).on('click', '.tf-generate-tour .tf-btn', function (event) {
        event.preventDefault();
        var arr = [];

        $(this).parents('.tf-shortcode-generator-single').find(".tf-sg-field-wrap").each(function () {
            var $this = $(this);
            var data = $this.find('.tf-setting-field').val();
            var option_name = $this.find('.tf-setting-field').attr('data-term');
            var post_count = $this.find('.post-count').attr('data-count');

            if (option_name != undefined && option_name != '') {
                data = option_name + '=' + (data.length ? data : '""');
            }
            if (post_count != undefined && post_count != '') {
                data = post_count + '=' + (data.length ? data : '""');
            }
            arr.push(data);
        });

        var allData = arr.filter(Boolean);
        var shortcode = "[" + allData.join(' ') + "]";

        $(this).parents('.tf-shortcode-generator-single').find('.tf-shortcode-value').val(shortcode);
        $(this).parents('.tf-shortcode-generator-single').find('.tf-copy-item').slideDown();
    });

    $(document).on('click', '.tf-sg-close', function (event) {
        $(this).parents('.tf-shortcode-generators').find('.tf-sg-form-wrapper').fadeOut();
    });

    $(document).on('click', '.tf-shortcode-btn', function (event) {
        var $this = $(this);
        $this.parents('.tf-shortcode-generator-single').find('.tf-sg-form-wrapper').fadeIn();

        $this.parents('.tf-shortcode-generator-single').mouseup(function (e) {
            var container = $(this).find(".tf-shortcode-generator-form");
            var container_parent = container.parent(".tf-sg-form-wrapper");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container_parent.fadeOut();
            }
        });

    });

    //Copy the shortcode value
    $(document).on('click', '.tf-copy-btn', function () {
        var fieldIdValue = $(this).parent('.tf-shortcode-field').find('#tf-shortcode');
        if (fieldIdValue) {
            fieldIdValue.select();
            document.execCommand("copy");
        }
        //show the copied message
        $(this).parents('.tf-copy-item').append('<div><span class="tf-copied-msg">Copied<span></div>');
        $("span.tf-copied-msg").animate({ opacity: 0 }, 1000, function () {
            $(this).slideUp('slow', function () {
                $(this).remove();
            });
        });
    });



})(jQuery);

