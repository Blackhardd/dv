jQuery(document).ready(function($){
    if($('.multistep-form').length){
        let active_step = 1
        let max_step = 3;

        let $form = $('.multistep-form');
        let $form_response = $('.multistep-form__response');

        $('.multistep-form__nav button').on('click', function(){
            if(validate_active_step()){
                go_next_step();
            }

            if(active_step == max_step){
                $(this).text('Odeslat dotazník');
            }
        });

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
                setTimeout(function(){
                    $form.removeClass('loading');
                    location.reload();
                }, 2000);
            }
        }

        function validate_active_step(){
            let is_valid = true;
            let is_radio_valid = false;

            let $active_step = $('.multistep-form__step[data-step="' + active_step + '"]');

            let $radio = $active_step.find('input[type="radio"]');
            let $inputs = $active_step.find('input[type="text"],input[type="tel"],input[type="email"],input[type="number"],input[type="date"]');

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