<?php

if( !shortcode_exists( 'social_icons' ) ) {
    add_shortcode( 'social_icons', 'dv_social_icons_sc' );
    function dv_social_icons_sc( $atts ){
        $atts = shortcode_atts( array(
            'facebook' => '',
            'instagram' => ''
        ), $atts, 'social_icons' );

        $facebook_icon = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M20.48 0H3.52A3.52 3.52 0 000 3.52v16.96A3.52 3.52 0 003.52 24h7.07v-8.48H7.8V11.3h2.8V8.44c0-2.33 1.9-4.22 4.22-4.22h4.27v4.22H14.8v2.86h4.27l-.7 4.22H14.8V24h5.67A3.52 3.52 0 0024 20.48V3.52A3.52 3.52 0 0020.48 0z" /></svg>';
        $instagram_icon = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M20.484 0H3.516A3.52 3.52 0 000 3.516v16.968A3.52 3.52 0 003.516 24h16.968A3.52 3.52 0 0024 20.484V3.516A3.52 3.52 0 0020.484 0zm-8.437 18.281a6.335 6.335 0 01-6.328-6.328 6.335 6.335 0 016.328-6.328 6.335 6.335 0 016.328 6.328 6.335 6.335 0 01-6.328 6.328zm7.031-11.25a2.112 2.112 0 01-2.11-2.11c0-1.162.947-2.109 2.11-2.109 1.163 0 2.11.947 2.11 2.11 0 1.163-.947 2.11-2.11 2.11z" /><path d="M19.078 4.219a.704.704 0 100 1.407.704.704 0 000-1.407zM12.047 7.031a4.928 4.928 0 00-4.922 4.922 4.928 4.928 0 004.922 4.922 4.928 4.928 0 004.922-4.922 4.928 4.928 0 00-4.922-4.922z" /></svg>';

        $html = '<div class="social-icons">';

        $html .= ($atts['facebook']) ? "<a href='{$atts['facebook']}' target='_blank'>{$facebook_icon}</a>" : '';
        $html .= ($atts['instagram']) ? "<a href='{$atts['instagram']}' target='_blank'>{$instagram_icon}</a>" : '';

        $html .= '</div>';

        return $html;
    }
}

if( !shortcode_exists( 'multistep_form' ) ){
    add_shortcode( 'multistep_form', 'dv_multistep_form_sc' );
    function dv_multistep_form_sc(){
        wp_enqueue_script( 'dv-multistep-form' );
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
                <ul class="multistep-form__pagination">
                    <li class="active" data-step="1">1</li>
                    <li data-step="2">2</li>
                    <li data-step="3">3</li>
                </ul>
                <form>
                    <div class="multistep-form__step active" data-step="1">
                        <div class="multistep-form__fields">
                            <div class="field">
                                <label>V Prague Fertility Centre:</label>
                                <div class="radio">
                                    <input type="radio" name="donator" value="new" id="first-time">
                                    <label for="first-time">Daruji zde poprvé</label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="donator" value="existing" id="not-first-time">
                                    <label for="not-first-time">Již jsem zde darovala</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="multistep-form__step" data-step="2">
                        <div class="multistep-form__fields">
                            <div class="field">
                                <div class="input">
                                    <input type="text" name="name" id="name" placeholder="Jméno*">
                                </div>
                            </div>
                            <div class="field">
                                <div class="input">
                                    <input type="text" name="surname" id="surname" placeholder="Příjmení*">
                                </div>
                            </div>
                            <div class="field">
                                <div class="input">
                                    <input type="email" name="email" id="email" placeholder="Email*">
                                </div>
                            </div>
                            <div class="field">
                                <div class="input">
                                    <input type="tel" name="phone" id="phone" placeholder="Telefon*">
                                </div>
                            </div>
                            <div class="field">
                                <label for="birthdate">Rok narození<span class="required-mark"></span></label>
                                <div class="input">
                                    <input type="date" name="birthdate" id="birthdate">
                                </div>
                            </div>
                            <div class="field">
                                <label for="communication_method">Preferovaný způsob komunikace<span class="required-mark"></span></label>
                                <div class="select">
                                    <select name="communication_method" id="communication_method">
                                        <option value="" disabled selected>Vybrat</option>
                                        <option value="E-mail">E-mail</option>
                                        <option value="Telefon">Telefon</option>
                                        <option value="SMS">SMS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="field">
                                <div class="acceptance">
                                    <label>
                                        <input type="checkbox" name="acceptance">
                                        Potvrzuji prostudování a souhlas s <a href="#">Informací pro dárkyně</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="multistep-form__step multistep-form__step--conditional" data-step="3">
                        <div class="multistep-form__fields">
                            <div class="multistep-form__fields-group" data-group="new">
                                <div class="fields two">
                                    <div class="field">
                                        <label for="height">Výška (cm)<span class="required-mark"></span></label>
                                        <div class="input">
                                            <input type="number" min="140" max="200" name="height" id="height">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="weight">Váha (kg)<span class="required-mark"></span></label>
                                        <div class="input">
                                            <input type="number" min="45" max="90" name="weight" id="weight">
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Léčila jste se někdy na neplodnost?</label>
                                    <div class="toggle">
                                        <div class="toggle__label">Ne</div>
                                        <label>
                                            <input type="checkbox" name="infertility_threatment">
                                            <span class="toggle__slider"></span>
                                        </label>
                                        <div class="toggle__label">Ano</div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Darovala jste někdy vajíčka?</label>
                                    <div class="toggle">
                                        <div class="toggle__label">Ne</div>
                                        <label>
                                            <input type="checkbox" name="eggs_donated">
                                            <span class="toggle__slider"></span>
                                        </label>
                                        <div class="toggle__label">Ano</div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Jste přihlášena k veřejnému zdravotnímu pojištění v České republice?</label>
                                    <div class="toggle">
                                        <div class="toggle__label">Ne</div>
                                        <label>
                                            <input type="checkbox" name="insurance_registration">
                                            <span class="toggle__slider"></span>
                                        </label>
                                        <div class="toggle__label">Ano</div>
                                    </div>
                                </div>
                            </div>
                            <div class="multistep-form__fields-group" data-group="existing">
                                <div class="field">
                                    <label for="last-donation">Poslední darování</label>
                                    <div class="input">
                                        <input type="date" name="last_donation" id="last-donation">
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="last-menstruation">Datum poslední menstruace - 1. den<span class="required-mark"></span></label>
                                    <div class="input">
                                        <input type="date" name="last_menstruation" id="last-menstruation">
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Hormonální antikoncepce?<span class="required-mark"></span></label>
                                    <div class="toggle">
                                        <div class="toggle__label">Ne</div>
                                        <label>
                                            <input type="checkbox" name="hormonal_anticonception">
                                            <span class="toggle__slider"></span>
                                        </label>
                                        <div class="toggle__label">Ano</div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <div class="input">
                                    <textarea name="comment" id="comment" rows="3" placeholder="Poznámka"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="donation_apply">
                </form>
                <div class="multistep-form__response"></div>
                <div class="multistep-form__nav">
                    <button class="multistep-form__back-btn button button--link" disabled>Předchozí</button>
                    <button class="multistep-form__next-btn button button--link">Další</button>
                </div>
            </div>
        <?php
        return ob_get_clean();
    }
}