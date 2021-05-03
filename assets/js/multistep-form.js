jQuery(document).ready(function($){
    if($('.multistep-form').length){
        let active_step = 1
        let max_step = 3;

        let step_condition = false;

        let $form = $('.multistep-form');
        let $form_response = $('.multistep-form__response');

        $('.multistep-form__back-btn').on('click', go_prev_step);

        $('.multistep-form__next-btn').on('click', function(){
            if(validate_active_step()){
                go_next_step();
            }

            if(active_step == max_step){
                step_condition = $('[name="donator"]:checked').val();
                $('.multistep-form__step[data-step="' + active_step + '"] .multistep-form__fields-group[data-group="' + step_condition + '"]').addClass('active');
                $(this).text('Odeslat dotazník');
            }
        });

        function go_prev_step(){
            if(active_step > 1){
                active_step--;

                $('.multistep-form__step').removeClass('active');
                $('.multistep-form__pagination li').removeClass('active');

                $('.multistep-form__step[data-step="' + active_step + '"]').addClass('active');
                $('.multistep-form__pagination li[data-step="' + active_step + '"]').addClass('active');
            }
        }

        function go_next_step(){
            if(active_step < max_step){
                active_step++;

                $('.multistep-form__step').removeClass('active');
                $('.multistep-form__pagination li').removeClass('active');

                $('.multistep-form__step[data-step="' + active_step + '"]').addClass('active');
                $('.multistep-form__pagination li[data-step="' + active_step + '"]').addClass('active');
            }
            else{
                $form.addClass('loading');
                let fd = new FormData($form.find('form')[0]);

                $.ajax({
                    url: _dv.ajax_url,
                    data: fd,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(data){
                        $form.removeClass('loading');
                        $form.addClass('success');
                    }
                });
            }
        }

        function validate_active_step(){
            let is_valid = true;
            let is_radio_valid = false;

            let $active_step = $('.multistep-form__step[data-step="' + active_step + '"]');

            let $radio = null;
            let $inputs = null;

            if($active_step.hasClass('multistep-form__step--conditional')){
                let $active_group = $active_step.find('.multistep-form__fields-group.active');
                $radio = $active_group.find('input[type="radio"]');
                $inputs = $active_group.find('input[type="text"],input[type="tel"],input[type="email"],input[type="number"],input[type="date"]');
            }
            else{
                $radio = $active_step.find('input[type="radio"]');
                $inputs = $active_step.find('input[type="text"],input[type="tel"],input[type="email"],input[type="number"],input[type="date"]');
            }

            if($radio.length){
                $radio.each(function(i){
                    if($(this).is(':checked')){
                        is_radio_valid = true;
                    }
                });
            }
            else{
                is_radio_valid = true;
            }

            if($inputs.length){
                $inputs.each(function(i){
                    if(!$(this).val()){
                        let $wrapper = $(this).parent();
                        $wrapper.addClass('error');
                        setTimeout(function(){
                            $wrapper.removeClass('error');
                        }, 2000);

                        is_valid = false;
                    }
                });
            }

            if(!is_valid || !is_radio_valid){
                $form_response.html('<div class="message error">Vyplňte všechna povinná pole.</div>');
            }
            else{
                $form_response.html('');
            }

            return is_valid && is_radio_valid;
        }
    }
});