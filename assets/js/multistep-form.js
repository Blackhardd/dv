jQuery(document).ready(function($){
    if($('.multistep-form').length){
        let active_step = 1
        let max_step = 2;

        let step_condition = false;

        let $form = $('.multistep-form');
        let $form_response = $('.multistep-form__response');
        let $form_fail = $('.multistep-form__failed');

        let $email = $form.find('[name="email"]');
        let $phone = $form.find('[name="phone"]');
        let $birth_date = $form.find('[name="birthdate"]');
        //let $acceptance = $form.find('[name="acceptance"]');
        let $height = $form.find('[name="height"]');
        let $weight = $form.find('[name="weight"]');
        let $infertility = $form.find('[name="infertility_threatment"]');
        let $insurance = $form.find('[name="insurance_registration"]');

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
            if(validate_active_step() && validate_required()){
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
                    else if($(this).is('[type="date"]') && compare_years(new Date($(this).val()), new Date($(this).attr('max')))){
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

        function validate_email(){
            if(active_step == 1){
                const re = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
                if($email.val() && !re.test(String($email.val()).toLowerCase())){
                    $form_response.html('<div class="message error">Neplatná emailová adresa.</div>');
                    $email.parent().addClass('error');
                    setTimeout(function(){
                        $email.parent().removeClass('error');
                    }, 2000);
                }

                return re.test(String($email.val()).toLowerCase());
            }
            return true;
        }

        function validate_phone(){
            if(active_step == 1){
                const re = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/i;
                if($phone.val() && !re.test(String($phone.val()).toLowerCase())){
                    $form_response.html('<div class="message error">Neplatné telefonní číslo.</div>');
                    $phone.parent().addClass('error');
                    setTimeout(function(){
                        $phone.parent().removeClass('error');
                    }, 2000);
                }

                return re.test(String($phone.val()).toLowerCase());
            }
            return true;
        }

        function validate_height(){
            if(active_step == 2 && step_condition == 'new'){
                if($height.val() < $height.attr('min') || $height.val() > $height.attr('max')){
                    form_failed('BMI 💁‍♀️', 'Index tělesné hmotnosti, obvykle označovaný zkratkou BMI (z anglického body mass index) je číslo používané jako indikátor podváhy, normální tělesné hmotnosti, nadváhy a obezity. Pro účely dárcovství vajíček preferujeme, aby se hodnota BMI pohybovala v rozmezí 17 – 30. Tento index je důležitý ne z hlediska „krásy“, ale protože je pro nás na prvním místě Vaše zdraví.');
                }

                return $height.val() >= $height.attr('min') && $height.val() <= $height.attr('max');
            }
            return true;
        }

        function validate_weight(){
            if(active_step == 2 && step_condition == 'new'){
                if($weight.val() < $weight.attr('min') || $weight.val() > $weight.attr('max')){
                    form_failed('BMI 💁‍♀️', 'Index tělesné hmotnosti, obvykle označovaný zkratkou BMI (z anglického body mass index) je číslo používané jako indikátor podváhy, normální tělesné hmotnosti, nadváhy a obezity. Pro účely dárcovství vajíček preferujeme, aby se hodnota BMI pohybovala v rozmezí 17 – 30. Tento index je důležitý ne z hlediska „krásy“, ale protože je pro nás na prvním místě Vaše zdraví.');
                }

                return $weight.val() >= $weight.attr('min') && $weight.val() <= $weight.attr('max');
            }
            return true;
        }

        function validate_infertility(){
            if(active_step == 2 && step_condition == 'new'){
                if($infertility.is(':checked')){
                    form_failed('Léčila jste se pro neplodnost 🙅‍♀️', 'Pokud byl důvodem léčby Vaší neplodnosti mužský faktor, kontaktujte prosím recepci našeho centra pro bližší informace. Pokud jste se léčila s vlastní neplodností, není možné Vás do dárcovství zařadit.');
                }

                return !$infertility.is(':checked');
            }
            return true;
        }

        function validate_insurance(){
            if(active_step == 2 && step_condition == 'new'){
                if(!$insurance.is(':checked')){
                    form_failed('Zdravotní pojištění 🤦‍♀️', 'Nejste přihlášená k veřejnému zdravotnímu pojištění v ČR.')
                }

                return $insurance.is(':checked');
            }
            return true;
        }

        function validate_birth_date(){
            if(active_step == 1){
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

        function validate_required(){
            return validate_email() && validate_phone() && validate_birth_date() && validate_height() && validate_weight() && validate_infertility() && validate_insurance();
        }

        function diff_years(dt1, dt2){
            return dt2.getFullYear() - dt1.getFullYear();
        }

        function compare_years(dt1, dt2){
            return dt1.getTime() > dt2.getTime();
        }
    }
});