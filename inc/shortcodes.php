<?php

if( !shortcode_exists( 'social_icons' ) ) {
    add_shortcode( 'social_icons', 'dv_social_icons_sc' );
    function dv_social_icons_sc( $atts ){
        $facebook_link = get_option( 'facebook_link' );
        $instagram_link = get_option( 'instagram_link' );

        $facebook_icon = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M20.48 0H3.52A3.52 3.52 0 000 3.52v16.96A3.52 3.52 0 003.52 24h7.07v-8.48H7.8V11.3h2.8V8.44c0-2.33 1.9-4.22 4.22-4.22h4.27v4.22H14.8v2.86h4.27l-.7 4.22H14.8V24h5.67A3.52 3.52 0 0024 20.48V3.52A3.52 3.52 0 0020.48 0z" /></svg>';
        $instagram_icon = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M20.484 0H3.516A3.52 3.52 0 000 3.516v16.968A3.52 3.52 0 003.516 24h16.968A3.52 3.52 0 0024 20.484V3.516A3.52 3.52 0 0020.484 0zm-8.437 18.281a6.335 6.335 0 01-6.328-6.328 6.335 6.335 0 016.328-6.328 6.335 6.335 0 016.328 6.328 6.335 6.335 0 01-6.328 6.328zm7.031-11.25a2.112 2.112 0 01-2.11-2.11c0-1.162.947-2.109 2.11-2.109 1.163 0 2.11.947 2.11 2.11 0 1.163-.947 2.11-2.11 2.11z" /><path d="M19.078 4.219a.704.704 0 100 1.407.704.704 0 000-1.407zM12.047 7.031a4.928 4.928 0 00-4.922 4.922 4.928 4.928 0 004.922 4.922 4.928 4.928 0 004.922-4.922 4.928 4.928 0 00-4.922-4.922z" /></svg>';

        $html = '<div class="social-icons">';

        $html .= ( $facebook_link ) ? "<a href='{$facebook_link}' target='_blank'>{$facebook_icon}</a>" : '';
        $html .= ( $instagram_link ) ? "<a href='{$instagram_link}' target='_blank'>{$instagram_icon}</a>" : '';

        $html .= '</div>';
        
        if( $facebook_link || $instagram_link ){
            return $html;
        }
        
        return '';
    }
}

if( !shortcode_exists( 'multistep_form' ) ){
    add_shortcode( 'multistep_form', 'dv_multistep_form_sc' );
    function dv_multistep_form_sc( $atts ){
        wp_enqueue_script( 'dv-multistep-form' );

        $atts = shortcode_atts( array(
            'title' => ''
        ), $atts, 'multistep_form' );

        ob_start(); ?>
            <div class="multistep-form">
                <div class="multistep-form__success">
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg>
                </div>
                <div class="multistep-form__failed">
                    <div class="message">
                        <div class="message__header"></div>
                        <div class="message__body"></div>
                    </div>
                </div>
                <div class="multistep-form__header">
                    <div class="multistep-form__title"><?=$atts['title']; ?></div>

                    <ul class="multistep-form__pagination">
                        <li class="active" data-step="1">1</li>
                        <li data-step="2">2</li>
                    </ul>
                </div>
                <form>
                    <div class="multistep-form__step active" data-step="1">
                        <div class="multistep-form__fields">
                            <div class="field">
                                <div class="input">
                                    <input type="text" name="name" id="name" placeholder="<?=__( 'Jméno', 'dv' ); ?>*">
                                </div>
                            </div>

                            <div class="field">
                                <div class="input">
                                    <input type="text" name="surname" id="surname" placeholder="<?=__( 'Příjmení', 'dv' ); ?>*">
                                </div>
                            </div>

                            <div class="field">
                                <div class="input">
                                    <input type="email" name="email" id="email" placeholder="<?=__( 'Email', 'dv' ); ?>*">
                                </div>
                            </div>

                            <div class="field">
                                <div class="input">
                                    <input type="tel" name="phone" id="phone" placeholder="<?=__( 'Telefon', 'dv' ); ?>*">
                                </div>
                            </div>

                            <div class="field">
                                <label for="birthdate"><?=__( 'Rok narození', 'dv' ); ?><span class="required-mark"></span></label>
                                <div class="input">
                                    <input type="date" max="2003-01-01" name="birthdate" id="birthdate">
                                </div>
                            </div>

                            <div class="field">
                                <label for="communication_method"><?=__( 'Preferovaný způsob komunikace', 'dv' ); ?><span class="required-mark"></span></label>
                                <div class="select">
                                    <select name="communication_method" id="communication_method">
                                        <option value="" disabled selected><?=__( 'Vybrat', 'dv' ); ?></option>
                                        <option value="E-mail"><?=__( 'E-mail', 'dv' ); ?></option>
                                        <option value="Telefon"><?=__( 'Telefon', 'dv' ); ?></option>
                                        <option value="SMS"><?=__( 'SMS', 'dv' ); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="field">
                                <label><?=__( 'V Prague Fertility Centre:', 'dv' ); ?></label>
                                <div class="radio">
                                    <input type="radio" name="donator" value="new" id="first-time">
                                    <label for="first-time"><?=__( 'Daruji zde poprvé', 'dv' ); ?></label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="donator" value="existing" id="not-first-time">
                                    <label for="not-first-time"><?=__( 'Již jsem zde darovala', 'dv' ); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="multistep-form__step multistep-form__step--conditional" data-step="2">
                        <div class="multistep-form__fields">
                            <div class="multistep-form__fields-group" data-group="new">
                                <div class="fields two">
                                    <div class="field">
                                        <label for="height"><?=__( 'Výška (cm)', 'dv' ); ?><span class="required-mark"></span></label>
                                        <div class="input">
                                            <input type="number" min="140" max="200" name="height" id="height">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="weight"><?=__( 'Váha (kg)', 'dv' ); ?><span class="required-mark"></span></label>
                                        <div class="input">
                                            <input type="number" min="45" max="90" name="weight" id="weight">
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label><?=__( 'Léčila jste se někdy na neplodnost?', 'dv' ); ?></label>
                                    <div class="toggle">
                                        <div class="toggle__label"><?=__( 'Ne', 'dv' ); ?></div>
                                        <label>
                                            <input type="checkbox" name="infertility_threatment">
                                            <span class="toggle__slider"></span>
                                        </label>
                                        <div class="toggle__label"><?=__( 'Ano', 'dv' ); ?></div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label><?=__( 'Darovala jste někdy vajíčka?', 'dv' ); ?></label>
                                    <div class="toggle">
                                        <div class="toggle__label"><?=__( 'Ne', 'dv' ); ?></div>
                                        <label>
                                            <input type="checkbox" name="eggs_donated">
                                            <span class="toggle__slider"></span>
                                        </label>
                                        <div class="toggle__label"><?=__( 'Ano', 'dv' ); ?></div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label><?=__( 'Jste přihlášena k veřejnému zdravotnímu pojištění v České republice?', 'dv' ); ?></label>
                                    <div class="toggle">
                                        <div class="toggle__label"><?=__( 'Ne', 'dv' ); ?></div>
                                        <label>
                                            <input type="checkbox" name="insurance_registration">
                                            <span class="toggle__slider"></span>
                                        </label>
                                        <div class="toggle__label"><?=__( 'Ano', 'dv' ); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="multistep-form__fields-group" data-group="existing">
                                <div class="field">
                                    <label for="last-donation"><?=__( 'Poslední darování', 'dv' ); ?></label>
                                    <div class="input">
                                        <input type="date" name="last_donation" id="last-donation">
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="last-menstruation"><?=__( 'Datum poslední menstruace - 1. den', 'dv' ); ?><span class="required-mark"></span></label>
                                    <div class="input">
                                        <input type="date" name="last_menstruation" id="last-menstruation">
                                    </div>
                                </div>
                                <div class="field">
                                    <label><?=__( 'Hormonální antikoncepce?', 'dv' ); ?><span class="required-mark"></span></label>
                                    <div class="toggle">
                                        <div class="toggle__label"><?=__( 'Ne', 'dv' ); ?></div>
                                        <label>
                                            <input type="checkbox" name="hormonal_contraception">
                                            <span class="toggle__slider"></span>
                                        </label>
                                        <div class="toggle__label"><?=__( 'Ano', 'dv' ); ?></div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <div class="input">
                                    <textarea name="comment" id="comment" rows="3" placeholder="<?=__( 'Poznámka', 'dv' ); ?>"></textarea>
                                </div>
                            </div>

                            <div class="field">
                                <?=sprintf( __( 'Potvrzuji prostudování a souhlas s %sInformací pro dárkyně%s', 'dv' ), '<a href="' . get_privacy_policy_url() . '" target="_blank">', '</a>' ); ?>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="donation_apply">
                </form>
                <div class="multistep-form__response"></div>
                <div class="multistep-form__nav">
                    <button class="multistep-form__back-btn button button--link" disabled><?=__( 'Předchozí', 'dv' ); ?></button>
                    <button class="multistep-form__next-btn button button--link"><?=__( 'Další', 'dv' ); ?></button>
                </div>
            </div>
        <?php
        return ob_get_clean();
    }
}