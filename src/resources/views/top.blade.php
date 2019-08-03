<!doctype html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>遅刻理由ジェネレーター</title>

        <!-- Reset -->
        <link href="{{ asset('css/reset.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/top.css') }}" rel="stylesheet" type="text/css">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <style>
            html, body, div, span, applet, object, iframe,
            h1, h2, h3, h4, h5, h6, p, blockquote, pre,
            a, abbr, acronym, address, big, cite, code,
            del, dfn, em, img, ins, kbd, q, s, samp,
            small, strike, strong, sub, sup, tt, var,
            b, u, i, center,
            dl, dt, dd, ol, ul, li,
            fieldset, form, label, legend,
            table, caption, tbody, tfoot, thead, tr, th, td,
            article, aside, canvas, details, embed, 
            figure, figcaption, footer, header, hgroup, 
            menu, nav, output, ruby, section, summary,
            time, mark, audio, video {
                margin: 0;
                padding: 0;
                border: 0;
                font-size: 100%;
                font: inherit;
                vertical-align: baseline;
            }
            /* HTML5 display-role reset for older browsers */
            article, aside, details, figcaption, figure, 
            footer, header, hgroup, menu, nav, section {
                display: block;
            }
            body {
                line-height: 1;
            }
            ol, ul {
                list-style: none;
            }
            blockquote, q {
                quotes: none;
            }
            blockquote:before, blockquote:after,
            q:before, q:after {
                content: '';
                content: none;
            }
            table {
                border-collapse: collapse;
                border-spacing: 0;
            }



            /*---------------
                common 
            ---------------*/
            .clearfix::after {
                content: '';
                clear: both;
                display: block;
            }

            .inner{
                margin: 0 auto;
                width: 1100px;
            }


            /*---------------
                header 
            ---------------*/
            .header {
                background-color: #000;
                box-sizing: border-box;
                font-size: 0;
                padding: 10px 0;
                width: 100%;
            }

            .header__title {
                background-color: #fff;
                display: inline-block;
                float: left;
                font-size: 110px;
                height: 100px;
                line-height: 105px;
                padding: 5px;
                text-align: center;
                width: 450px;
            }

            .header__title__sub {
                float: left;
                margin-left: 10px;
                width: 370px;
            }

            .header__title_sub--generator {
                background-color: #fff;
                font-size: 50px;
                height: 55px;
                line-height: 55px;
                text-align: center;
            }

            .header__title__sub--misawa {
                background-color: #696969;
                color: #fff;
                font-size: 30px;
                height: 55px;
                line-height: 55px;
                text-align: center;
                width: 100%;                
            }

            .header__catch {
                border: 1px solid #fff;
                box-sizing: border-box;
                color: #fff;
                display: inline-block;
                float: left;
                font-size: 35px;
                height: 110px;
                line-height: 50px;
                margin-left: 10px;
                text-align: center;
                width: 250px;
            }

            /*---------------
                main
            ---------------*/
            .main__contents {
                float: left;
                font-size: 18px;
                padding: 40px 0;
                width: 700px;
            }

            
            .main__contents--description {
                line-height: 25px;
                margin-bottom: 40px;
            }
            
            .main__contents--keyword p {
                margin-bottom: 5px;
            }

            .main__contents--keyword li {
                margin-bottom: 15px;
            }

            
            .main__contents--keyword li:last-child {
                margin-bottom: 0;
            }

            .main__contents--inputarea {
                box-sizing: border-box;
                font-size: 18px;
                height: 25px;
                outline: none;
                padding: 5px;
                width: 400px;
            }

            .main__contents--btn {
                margin-top: 30px;
                padding-left: 100px; 
            }

            .main__contents--submit {
                background-color: #696969;
                border-radius: 25px;
                color: #fff;
                outline: none;
                padding: 10px 0;
                width: 200px;
            }

            .main__img {
                float: right;
                width: 400px;
            }

            /*---------------
                footer
            ---------------*/
            .footer {
                background-color: #696969;
                padding: 20px 0;
                width: 100%;
            }


            .footer__text {
                color: #fff;
                display: inline-block;
                font-size: 14px;
            }

            .footer__copyright {
                float: left;
            }

            .footer__notice {
                float: right;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <header class="header">
                <div class="inner clearfix">
                    <h1 class="header__title">遅刻理由</h1>
                    <div class="header__title__sub">
                        <p class="header__title_sub--generator">ジェネレーター</p>
                        <p class="header__title__sub--misawa">by 地獄のミサワ</p>
                    </div>
                    <div class="header__catch">
                        <p>地獄の言い訳<br>作成支援</p>
                    </div>
                </div>
            </header>
            <main class="main">
                <div class="inner clearfix">
                    <div class="main__contents">
                        <p class="main__contents--description">よう、兄弟。遅刻しちまったか。まあ慌てるな。<br>キーワードを打ち込んでくれりゃあ俺が理由を作成するぜ。</p>
                        <form action="/misawa/generate" method="post">
                            {{ csrf_field() }}
                            <ul class="main__contents--keyword">
                                <li>
                                    <p>&#x25B6; 人物</p>
                                    <input type="text" class="main__contents--inputarea" name="person" placeholder="おかん">
                                </li>
                                <li>
                                    <p>&#x25B6; 場所</p>
                                    <input type="text" class="main__contents--inputarea" name="place" placeholder="本能寺">
                                </li>
                                <li>
                                    <p>&#x25B6; 遅刻時間</p>
                                    <input type="text" class="main__contents--inputarea" name="time" placeholder="2時間">
                                </li>
                            </ul>
                            <div class="main__contents--btn">
                                <button type="submit" class="main__contents--submit">遅刻理由を作成する</button>
                            </div>
                        </form>
                    </div>
                    <div class="main__img">
                        <img src="{{ asset('/image/misawa.jpeg') }}" alt="">
                    </div>
                </div>
            </main>
            <footer class="footer">
                <div class="inner clearfix">
                    <p class="footer__copyright footer__text">&copy; Hackathon2019</p>
                    <p class="footer__notice footer__text">&#x203B; 自己責任でご利用ください</p>
                </div>
            </footer>
        </div>
    </body>
</html>
