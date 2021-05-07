jQuery(document).ready(function($){
    if($('.multistep-form').length){
        let active_step = 1
        let max_step = 3;

        let step_condition = false;

        let $form = $('.multistep-form');
        let $birth_date = $form.find('[name="birthdate"]');
        let $acceptance = $form.find('[name="acceptance"]');
        let $infertility = $form.find('[name="infertility_threatment"]');
        let $insurance = $form.find('[name="insurance_registration"]');
        let $form_response = $('.multistep-form__response');
        let $form_fail = $('.multistep-form__failed');

        $('.multistep-form__back-btn').on('click', function(){
            go_prev_step();

            if(active_step == 1){
                $(this).prop('disabled', true);
            }

            if(active_step < max_step){
                $('.multistep-form__next-btn').text('Další');
            }
        });

        $('.multistep-form__next-btn').on('click', function(){
            if(validate_active_step() && validate_acceptance() && validate_birth_date() && validate_infertility() && validate_insurance()){
                go_next_step();
            }

            if(active_step > 1){
                $('.multistep-form__back-btn').prop('disabled', false);
            }

            if(active_step == max_step){
                step_condition = $('[name="donator"]:checked').val();
                $('.multistep-form__step[data-step="' + active_step + '"] .multistep-form__fields-group').removeClass('active')
                $('.multistep-form__step[data-step="' + active_step + '"] .multistep-form__fields-group[data-group="' + step_condition + '"]').addClass('active');
                $(this).text('Odeslat dotazník');
            }
        });

        function go_prev_step(){
            $form_response.html('');

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
                        setTimeout(function(){
                            location.assign(data);
                        }, 2000);
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
            let $selects = null;

            if($active_step.hasClass('multistep-form__step--conditional')){
                let $active_group = $active_step.find('.multistep-form__fields-group.active');
                $radio = $active_group.find('input[type="radio"]');
                $inputs = $active_group.find('input[type="text"],input[type="tel"],input[type="email"],input[type="number"],input[type="date"]');
                $selects = $active_group.find('select');
            }
            else{
                $radio = $active_step.find('input[type="radio"]');
                $inputs = $active_step.find('input[type="text"],input[type="tel"],input[type="email"],input[type="number"],input[type="date"]');
                $selects = $active_step.find('select');
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

            if($selects.length){
                $selects.each(function(i){
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

        function form_failed(title, message){
            $form_fail.find('.message__header').text(title);
            $form_fail.find('.message__body').text(message);
            $form.addClass('failed');
        }

        function validate_infertility(){
            if(active_step == 3 && step_condition == 'new'){
                if($infertility.is(':checked')){
                    form_failed('Léčila jste se pro neplodnost 🙅‍♀️', 'Pokud byl důvodem léčby Vaší neplodnosti mužský faktor, kontaktujte prosím recepci našeho centra pro bližší informace. Pokud jste se léčila s vlastní neplodností, není možné Vás do dárcovství zařadit.');
                }

                return !$infertility.is(':checked');
            }
            return true;
        }

        function validate_insurance(){
            if(active_step == 3 && step_condition == 'new'){
                if(!$insurance.is(':checked')){
                    form_failed('Zdravotní pojištění 🤦‍♀️', 'Nejste přihlášená k veřejnému zdravotnímu pojištění v ČR.')
                }

                return $insurance.is(':checked');
            }
            return true;
        }

        function validate_birth_date(){
            if(active_step == 2){
                if($birth_date.val()){
                    let birth_date = new Date($birth_date.val());
                    let now = new Date();

                    if(diff_years(birth_date, now) > 33){
                        form_failed('Věk 🤷‍♀️', 'Podle zákona je dárcovství možné do 35 let. Přijímáme nové zájemkyně o dárcovství do věku 33 let tak, aby stihly projít všemi potřebnými vyšetřeními a aby stimulace vaječníků proběhla do věku 34 let.');
                    }

                    return (diff_years(birth_date, now) <= 33);
                }
            }
            return true;
        }

        function validate_acceptance(){
            if(active_step == 2){
                if(!$acceptance.is(':checked')){
                    $form_response.html('<div class="message error">Měli byste přijmout informací pro dárkyně.</div>');
                }

                return $acceptance.is(':checked');
            }
            return true;
        }

        function diff_years(dt1, dt2){
            return dt2.getFullYear() - dt1.getFullYear();
        }
    }
});