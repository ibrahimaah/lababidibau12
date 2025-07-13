<style>
.js-cookie-consent.cookie-consent {
                position: fixed;
                bottom: 0;
                margin: 0;
                padding: 20px;
                text-align: center;
                width: 100%;
                background-color: #222;
                z-index:99999
            }
            span.cookie-consent__message {
                color: #fff;
            }
            button.js-cookie-consent-agree {
                border: none;
                border-radius: 3px;
                background: #ee1a36;
                padding: 10px 15px;
                font-size: 16px;
                color: #fff;
            }
</style>
<div class="js-cookie-consent cookie-consent">

    <span class="cookie-consent__message">
    Diese Webseite verwendet Cookies. Durch die weitere Nutzung der Webseite stimmen Sie der Verwendung von Cookies zu . <a style="color:white;text-decoration:underline" href="{{ route('privacy_policy') }}">Datenschutzerklärung</a>
    </span>

    <button class="js-cookie-consent-agree cookie-consent__agree">
        Akzeptieren
    </button>
    

</div>
