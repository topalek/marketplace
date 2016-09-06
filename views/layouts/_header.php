<div class="header">
    <div class="header__top">
        <div class="l-center">
            <ul class="top-menu">
                <li class="top-menu__item">
                    <a href="/rus/ob_ipopo.html">
                        Об Ipopo
                    </a>
                </li>
                <li class="top-menu__item">
                    <a href="/rus/schastlivyj_istorii.html">
                        Счастливые истории
                    </a>
                </li>
                <li class="top-menu__item">
                    <a href="/rus/postavschiki_horoshego_nastroeniya.html">
                        Поставщики хорошего настроения
                    </a>
                </li>
                <li class="top-menu__item">
                    <a href="/rus/office_ipopo.html">
                        Офис Ipopo
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="l-center">
        <div class="header__main">
            <a href="/" class="logo">
                <i class="icon-logo"></i>
                <div>
                    Агентство полезных подарков
                </div>
            </a>
            <div class="menu-block-wrap ">
                <div class="menu-block">
                    <div class="menu-block__wrapper">

                    </div>
                    <a href="/wishlist.html" class="menu-block__in">
                        <div class="menu-block__content">
                            <i class="menu-block__icon icon-cloud"></i>
                            <span>Создай вишлист</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="menu-block-wrap is-turned is-pink">
                <div class="menu-block">
                    <div class="menu-block__wrapper">

                    </div>
                    <a href="/akcii.html" class="menu-block__in">
                        <div class="menu-block__content">
                            <i class="menu-block__icon icon-gift-shine"></i>
                            <span>Акции конкурсы</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="menu-block-wrap is-yellow">
                <div class="menu-block">
                    <div class="menu-block__wrapper">

                    </div>
                    <a href="/card.html" class="menu-block__in">
                        <div class="menu-block__content">
                            <i class="menu-block__icon icon-love"></i>
                            <span>Отправляй открытки</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="menu-block-wrap is-turned is-blue">
                <div class="menu-block">
                    <div class="menu-block__wrapper">

                    </div>
                    <div class="menu-block__in">
                        <div class="img-bodys"></div>
                        <div class="user">
                            <a href="" class="user__name"><span>Гость</span>
                            </a>
                            <a id="wl_name_href" href="/rus/my-wishlist-edit//.html" class="user__name">
                                <span id="wl_name"></span>
                            </a>
                            <input type="hidden" id="wl_name_orig" value="">
                            <div>
                                <div class="user__info">

                                            <span class="user__link">
                                                <i class="user__icon icon-present-white"></i>
                                                <span id="gift_num">0</span>
                                            </span>

                                    <a id="enter_LK" class="enter_LK">Вход</a>
                                </div>

                                <div class="user__info">

                                            <span class="user__link">
                                                <i class="user__icon icon-card-white"></i>
                                                <span id="gift_sum">0</span>
                                            </span>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-menu-wrap">
                <div class="btn-menu js-btn-menu" style="top: -2px;">
                    <div class="btn-menu__wrapper"></div>
                    <a href="#" class="btn-menu__in">
                        <div class="btn-menu__content">
                            <span>Меню</span>
                            <div class="burger">
                                <div class="burger__line is-lily"></div>
                                <div class="burger__line is-orangead"></div>
                                <div class="burger__line is-sky"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .menu { position: absolute; background: #e9d7af; top: 0; right: 0; left: 0; z-index: 20; height: auto; -moz-transform: translate3d(0, -110%, 0); -ms-transform: translate3d(0, -110%, 0); -webkit-transform: translate3d(0, -110%, 0); transform: translate3d(0, -110%, 0); -moz-transition: -moz-transform 0.4s; -o-transition: -o-transform 0.4s; -webkit-transition: -webkit-transform 0.4s; transition: transform 0.4s; }
    .menu.is-active { -moz-transform: translate3d(0, 0, 0); -ms-transform: translate3d(0, 0, 0); -webkit-transform: translate3d(0, 0, 0); transform: translate3d(0, 0, 0); }
    .menu__wrap { max-width: 320px; margin: 0 auto; }
    .menu__wrap.is-country { padding-left: 128px; }
    .menu__wrap.is-lang { padding-left: 31px; }
    .menu__limit { width: 290px; margin: 0 auto; position: relative; }
    .menu__arr { position: absolute; right: 10px; -moz-transition: right 0.2s; -o-transition: right 0.2s; -webkit-transition: right 0.2s; transition: right 0.2s; }
    .menu__arr:before, .menu__arr:after { content: ""; position: absolute; height: 2px; width: 17px; right: 0; background-color: #8d5bb4; }
    .menu__arr:before { top: 0; -ms-transform: rotate(45deg); -webkit-transform: rotate(45deg); transform: rotate(45deg); }
    .menu__arr:after { top: 11px; -ms-transform: rotate(-45deg); -webkit-transform: rotate(-45deg); transform: rotate(-45deg); }
    .menu__item { display: block; padding: 0px 10px; }
    .menu__item .user { -moz-transition: margin 0.2s; -o-transition: margin 0.2s; -webkit-transition: margin 0.2s; transition: margin 0.2s; }
    .menu__item .user:hover span { text-shadow: none; }
    .menu__item .user__name { margin-bottom: 0; }
    .menu__item .user__name span { font-size: 18px; font-family: "ptsans-regular", Arial, sans-serif; font-weight: 400; text-transform: none; }
    .menu__item .user__info { margin-left: 0; margin-right: 20px; }
    .menu__item .user__info span { font-family: "ptsans-bold", Arial, sans-serif; font-weight: 700; font-size: 14px; }
    @media only screen and (max-width: 479px) { .menu__item { text-align: left; } }
    .menu__item:active .menu__icon { margin-right: 8px; }
    .menu__item:active .user { margin-left: 2px; }
    .menu__item.is-ipopo { padding-top: 13px; padding-bottom: 26px; background-color: #8d5bb4; z-index: 3; }
    .menu__item.is-lily { background-color: #e192e5; padding: 5px 10px; position: relative; z-index: 25; }
    .menu__item.is-lily:before { content: ""; background-color: #e192e5; position: absolute; left: 0; right: 0; top: -5px; height: 15px; transform: translate3d(0, 0, 0) rotate(-0.8deg); z-index: 20; box-shadow: 0 -1px 1px #8d5bb4; }
    .menu__item.is-lily:after { content: ""; background-color: #e192e5; position: absolute; left: 0; right: 0; bottom: -5px; height: 15px; transform: translate3d(0, 0, 0) rotate(0.8deg); z-index: 20; box-shadow: 0 1px 1px #feb737; }
    .menu__item.is-orangead { background-color: #feb737; padding: 13px 10px; z-index: 1; }
    .menu__item.is-sky { background: #a6c3fd; padding: 16px 10px; position: relative; }
    .menu__item.is-sky:before { content: ""; background-color: #a6c3fd; position: absolute; left: 0; right: 0; top: -5px; height: 15px; transform: translate3d(0, 0, 0) rotate(-0.8deg); z-index: 25; }
    .menu__item span { vertical-align: middle; font-size: 20px; text-transform: uppercase; font-family: "blogger_sans-bold", Georgia, sans-serif; font-weight: 700; color: white; }
    @media only screen and (max-width: 479px) { .menu__item span { font-size: 18px; } }
    .menu__icon { vertical-align: middle; margin-right: 6px; position: relative; z-index: 25; -moz-transition: margin 0.2s; -o-transition: margin 0.2s; -webkit-transition: margin 0.2s; transition: margin 0.2s; }
    .menu__out { background-color: #8d5bb4; text-align: center; padding: 16px 0; cursor: pointer;}
    .menu__out:active span { margin-top: 2px; }
    .menu__out span { font-size: 20px; display: inline-block; color: white; text-transform: none; font-family: "ptsans-regular", Arial, sans-serif; font-weight: 400; -moz-transition: margin 0.2s; -o-transition: margin 0.2s; -webkit-transition: margin 0.2s; transition: margin 0.2s; }
    @media only screen and (max-width: 479px) { .menu__out span { font-size: 16px;  cursor: pointer;} }
    .menu__element { margin: 0 10px; border-bottom: 1px solid white; padding: 15px 10px; display: block; -moz-transition: padding 0.2s; -o-transition: padding 0.2s; -webkit-transition: padding 0.2s; transition: padding 0.2s; }
    .menu__element.is-hidden { height: 0; display: none; -moz-transition: height 0.6s; -o-transition: height 0.6s; -webkit-transition: height 0.6s; transition: height 0.6s; }
    .menu__element.is-hidden.is-active { height: auto; display: block; }
    .menu__element:last-child { border: none; }
    .menu__element .is-lang { border: none; }
    .menu__element:active { padding-left: 12px; }
    .menu__element:active span { color: #734597; }
    .menu__element:active .menu__arr { right: 8px; }
    .menu__element .menu__wrap { max-width: 300px; }
    @media only screen and (max-width: 479px) { .menu__element { text-align: left; } }
    .menu__element span { font-size: 16px; color: #8d5bb4; vertical-align: middle; font-family: "ptsans-regular", Arial, sans-serif; font-weight: 400; -moz-transition: color 0.2s; -o-transition: color 0.2s; -webkit-transition: color 0.2s; transition: color 0.2s; }
    @media only screen and (max-width: 479px) { .menu__element span { font-size: 16px; } }
    .menu__element i { vertical-align: middle; margin-right: 7px; }

    .menu-block-wrap { float: left; position: relative; width: 19.7%; height: 123px; margin-left: 0.9%; }
    @media only screen and (max-width: 1200px) { .menu-block-wrap { width: 18%; } }
    @media only screen and (max-width: 1023px) { .menu-block-wrap { display: none; } }
    @media only screen and (max-width: 1200px) { .menu-block-wrap .user__info span { display: none; } }
    .menu-block-wrap:hover .menu-block__wrapper { height: 113px; background-color: #7b4ca2; }
    .menu-block-wrap:hover .menu-block__in { height: 100px; background-color: #9262b7; }
    .menu-block-wrap:hover.is-turned .menu-block__in { height: 110px; }
    .menu-block-wrap:hover.is-pink .menu-block__wrapper { background-color: #d674db; }
    .menu-block-wrap:hover.is-pink .menu-block__in { background-color: #e39ae7; }
    .menu-block-wrap:hover.is-yellow .menu-block__wrapper { background-color: #fea421; }
    .menu-block-wrap:hover.is-yellow .menu-block__in { background-color: #febb41; }
    .menu-block-wrap:hover.is-active .menu-block__wrapper { background-color: #e5d0a4; height: 103px; }
    .menu-block-wrap:hover.is-active .menu-block__in { background-color: #e9d7af; height: 90px; cursor: default; }
    .menu-block-wrap:active .menu-block__wrapper { background-color: #704594; }
    .menu-block-wrap:active .menu-block__in { background-color: #9465b9; }
    .menu-block-wrap:active .menu-block__content { text-shadow: 1px 2px 1px #563671; }
    .menu-block-wrap:active.is-pink .menu-block__wrapper { background-color: #d164d7; }
    .menu-block-wrap:active.is-pink .menu-block__in { background-color: #e49ee8; }
    .menu-block-wrap:active.is-pink .menu-block__content { text-shadow: 1px 2px 1px #a962ad; }
    .menu-block-wrap:active.is-yellow .menu-block__wrapper { background-color: #fe9c0d; }
    .menu-block-wrap:active.is-yellow .menu-block__in { background-color: #febc46; }
    .menu-block-wrap:active.is-yellow .menu-block__content { text-shadow: 1px 2px 1px #cc8825; }
    .menu-block-wrap:active.is-active .menu-block__wrapper { background-color: #e5d0a4; }
    .menu-block-wrap:active.is-active .menu-block__in { background-color: #e9d7af; }
    .menu-block-wrap:active.is-active .menu-block__content { text-shadow: none; }
    .menu-block-wrap.is-yellow .menu-block__wrapper { background: #fea82b; }
    .menu-block-wrap.is-yellow .menu-block__in { background: #feb737; }
    .menu-block-wrap.is-turned .menu-block { overflow: hidden; height: 123px; }
    .menu-block-wrap.is-turned .menu-block__content { transform: translate3d(0, 0, 0) rotate(2deg); }
    .menu-block-wrap.is-turned .menu-block__wrapper { transform: translate3d(0, 0, 0) rotate(-2deg); }
    .menu-block-wrap.is-turned .menu-block__in { height: 100px; border-radius: 0 0 10px 20px; transform: translate3d(0, 0, 0) rotate(-4deg); top: -5px; left: 0px; border-radius: 0 0 15px 10px; }
    .menu-block-wrap.is-pink .menu-block__wrapper { background: #d87cdd; }
    .menu-block-wrap.is-pink .menu-block__in { background: #e192e5; }
    .menu-block-wrap.is-blue .menu-block__wrapper { background: #91b2fb; }
    .menu-block-wrap.is-blue .menu-block__in { background: #a6c3fc; }
    .menu-block-wrap.is-active .menu-block__in { background-color: #e9d7af; }
    .menu-block-wrap.is-active .menu-block__wrapper { background-color: #e5d0a4; }

    .menu-block { position: absolute; top: -12px; left: 0px; z-index: 0; width: 100%; }
    .menu-block .user { transform: translate3d(0, 0, 0) rotate(2deg); position: absolute; bottom: 11px; left: 18%; }
    .menu-block__wrapper { transform: translate3d(0, 0, 0) rotate(2deg); background: #804fa9; border-radius: 0 0 15px 10px; width: 100%; height: 103px; position: relative; z-index: 0; -moz-transition: height 0.2s, background-color 0.2s; -o-transition: height 0.2s, background-color 0.2s; -webkit-transition: height 0.2s, background-color 0.2s; transition: height 0.2s, background-color 0.2s; }
    .menu-block__in { transform: translate3d(0, 0, 0) rotate(-1deg); position: absolute; display: block; top: 3px; left: 2px; z-index: 1; width: 94%; height: 90px; border-radius: 0 0 10px 15px; background: #8d5bb4; -moz-transition: height 0.2s, background-color 0.2s; -o-transition: height 0.2s, background-color 0.2s; -webkit-transition: height 0.2s, background-color 0.2s; transition: height 0.2s, background-color 0.2s; }
    .menu-block__content { position: absolute; bottom: 15px; left: 15%; transform: translate3d(0, 0, 0) rotate(2deg); -moz-transition: text-shadow 0.1s; -o-transition: text-shadow 0.1s; -webkit-transition: text-shadow 0.1s; transition: text-shadow 0.1s; }
    @media only screen and (max-width: 1200px) { .menu-block__content { left: 10%; } }
    .menu-block__content span { display: inline-block; vertical-align: middle; font-family: "blogger_sans-bold", Georgia, sans-serif; font-weight: 700; font-size: 18px; max-width: 40%; color: white; text-transform: uppercase; }
    @media only screen and (max-width: 1200px) { .menu-block__content span { font-size: 16px; } }
    @media only screen and (max-width: 1041px) { .menu-block__content span { font-size: 15px; } }
    .menu-block__icon { display: inline-block; vertical-align: middle; }
    @media only screen and (max-width: 1200px) { .menu-block .icon-cloud { background: url("/img/svg/cloud.svg") no-repeat 0 0; -moz-background-size: 57px 43px; -o-background-size: 57px 43px; -webkit-background-size: 57px 43px; background-size: 57px 43px; width: 57px; height: 43px; display: inline-block; } }
    @media only screen and (max-width: 1200px) { .menu-block .icon-gift-shine { background: url("/img/svg/gift-shine.svg") no-repeat 0 0; -moz-background-size: 57px 57px; -o-background-size: 57px 57px; -webkit-background-size: 57px 57px; background-size: 57px 57px; width: 57px; height: 57px; display: inline-block; } }
    @media only screen and (max-width: 1200px) { .menu-block .icon-love { background: url("/img/svg/love-2.svg") no-repeat 0 0 !important; -moz-background-size: 57px 57px; -o-background-size: 57px 57px; -webkit-background-size: 57px 57px; background-size: 57px 57px; width: 57px; height: 57px; display: inline-block; } }


</style>