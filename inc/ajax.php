<?php

add_action( 'wp_ajax_donation_apply', 'dv_donation_apply' );
function dv_donation_apply(){
    $data = dv_get_post_data();

    $html = "
        <h1>Darování vajíček</h1>
    ";

    $html .= "
        <p>
            <b>Jméno:</b> {$data['name']}<br>
            <b>Příjmení:</b> {$data['surname']}<br>
            <b>Email:</b> {$data['email']}<br>
            <b>Telefon:</b> {$data['phone']}<br>
            <b>Rok narození:</b> {$data['birthdate']}<br>  
            <b>Preferovaný způsob komunikace:</b> {$data['communication_method']}
        </p>
    ";

    if( $data['donator'] == 'new' ){
        $html .= "
            <p><b>Daruje se poprvé.</b></p>
            <p>
                <b>Výška:</b> {$data['height']} cm<br>
                <b>Váha:</b> {$data['weight']} kg<br>
                <b>Léčila jste se někdy na neplodnost:</b> 
        ";

        $html .= ( isset( $data['infertility_threatment'] ) ) ? "Ano<br>" : "Ne<br>";
        $html .= "<b>Darovala jste někdy vajíčka:</b> ";
        $html .= ( isset( $data['eggs_donated'] ) ) ? "Ano<br>" : "Ne<br>";
        $html .= "<b>Jste přihlášena k veřejnému zdravotnímu pojištění v České republice:</b> ";
        $html .= ( isset( $data['insurance_registration'] ) ) ? "Ano<br>" : "Ne<br>";
    }
    else{
        $html .= "
            <p><b>Již jste darovali.</b></p>
            <p>
                <b>Poslední darování:</b> {$data['last_donation']}<br>
                <b>Datum poslední menstruace - 1. den:</b> {$data['last_menstruation']}<br>
                <b>Hormonální antikoncepce:</b> 
        ";

        $html .= ( isset( $data['hormonal_anticonception'] ) ) ? "Ano<br>" : "Ne<br>";
    }

    $html .= "</p>";

    $is_sended = wp_mail( 'djalexmurcer@gmail.com', 'Darování vajíček', $html, ['content-type: text/html'] );

    wp_die( $is_sended );
}