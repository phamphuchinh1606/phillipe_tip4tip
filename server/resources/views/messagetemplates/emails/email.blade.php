<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Amadeus monthly</title>
    <style>
        /* -------------------------------------
            GLOBAL RESETS
        ------------------------------------- */
        img {
            border: none;
            -ms-interpolation-mode: bicubic;
            max-width: 100%; }
        body {
            background-color: #f6f9fc;
            font-family: sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 14px;
            color: #727b85;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%; }
        table {
            border-collapse: separate;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            width: 100%; }
        table td {
            font-family: Arial, sans-serif;
            font-size: 16px;
            vertical-align: top;
            color: #727b85;}
        /* -------------------------------------
            BODY & CONTAINER
        ------------------------------------- */
        .body {
            background-color: #f6f9fc;
            width: 100%;
            color: #727b85}
        /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
        .container {
            display: block;
            Margin: 0 auto !important;
            /* makes it centered */
            max-width: 620px;}
        /* This should also be a block element, so that it will fill 100% of the .container */
        .content {
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
            max-width: 620px;
            padding: 10px; }
        /* -------------------------------------
            HEADER, FOOTER, MAIN
        ------------------------------------- */
        .header a,
        .header span{
            display: inline-block;
            vertical-align: middle; }
        .header span{
            color: transparent;
            height: 22px;
            width: 1px;
            background-color: #dfdfdf;
            overflow: hidden;
            margin: 0 15px;
        }
        .main {
            background: #ffffff;
            width: 100%;
            border: 1px solid #cbd8e6;}
        .wrapper {
            box-sizing: border-box;
        }
        .banner{
            display: block;
            margin: 0;
        }
        .content-block {
            padding-bottom: 10px;
            padding-top: 10px;
        }
        .footer {
            background-color: #47525d;
            margin: 0;
            clear: both;
            text-align: center;
            padding: 20px 45px;}
        .footer td,
        .footer p,
        .footer span,
        .footer a {
            font-size: 14px;
            text-align: center; }
        .footer a{
            color: #ffffff;
            display: inline-block;
            padding: 0 15px;
            margin-bottom: 15px;
        }
        /* -------------------------------------
            TYPOGRAPHY
        ------------------------------------- */
        h1,
        h2,
        h3,
        h4 {
            color: #727b85;
            font-family: sans-serif;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
            Margin-bottom: 30px; }
        h1 {
            font-size: 35px;
            font-weight: 300;
            text-align: center;
            text-transform: capitalize; }
        p,
        ul,
        ol {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            font-weight: normal;
            margin: 0;
            margin-bottom: 30px; }
        p li,
        ul li,
        ol li {
            list-style-position: inside;
            margin-left: 5px; }
        a {
            color: #3498db;
            text-decoration: underline; }
        /* -------------------------------------
            BANNER
        ------------------------------------- */
        .banner table,
        .banner-small table{
            background-repeat: no-repeat;
        }
        .banner-small{
            height: 130px;
        }
        .banner-title,
        .banner-small-title{
            color: #ffffff;
            font-weight: bold;
            background-color: #005eb8;
            padding: 15px 25px;
            margin: 0;
        }
        .banner-title{
            font-size: 22px;
            text-align: center;
        }
        .banner-small-title{
            font-size: 18px;
        }
        /* -------------------------------------
            TITLEs
        ------------------------------------- */

        .title{
            background-color: #f4f4f4;
            font-size: 22px;
            color: #005eb8;
            margin: 0;
            padding: 15px 10px;
            font-weight: bold;
            text-align: center;
        }
        /* -------------------------------------
            BOXs
        ------------------------------------- */
        .box-item{
            padding: 30px 0;
            border-bottom: 1px solid #cbd8e6;
        }
        .box-item h3{
            font-size: 16px;
            line-height: 1;
            color: #454545;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .box-item p{
            color: #727b85;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .box-item-small{
            border: 1px solid #cbd8e6;
        }
        .box-item-small h3{
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            color: #ffffff;
            background-color: #005eb8;
            display: block;
            padding: 10px 20px;
            margin: 0;
        }
        .box-item-small p{
            font-size: 14px;
        }
        .box-month{
            border: 1px solid #cbd8e6;
        }
        /* -------------------------------------
            BUTTONS
        ------------------------------------- */

        .btn {
            box-sizing: border-box;
            width: 100%; }
        .btn > tbody > tr > td {
            padding-bottom: 15px; }
        .btn table {
            width: auto; }
        .btn table td {
            background-color: #ffffff;
            border-radius: 5px;
            text-align: center; }
        .btn a {
            background-color: #ffffff;
            border: solid 1px #3498db;
            border-radius: 0;
            box-sizing: border-box;
            color: #00a9e0;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            text-align: center;
            font-weight: bold;
            margin: 0;
            padding: 8px 15px;
            text-decoration: none;  }
        .btn-primary table td {
            background-color: #3498db; }
        .btn-primary a {
            background-color: #00a9e0;
            border-color: #00a9e0;
            color: #ffffff; }
        /* -------------------------------------
            OTHER STYLES THAT MIGHT BE USEFUL
        ------------------------------------- */
        .preheader {
            color: transparent;
            display: none;
            height: 0;
            max-height: 0;
            max-width: 0;
            opacity: 0;
            overflow: hidden;
            mso-hide: all;
            visibility: hidden;
            width: 0; }
        .powered-by a {
            text-decoration: none; }
        hr {
            border: 0;
            border-bottom: 1px solid #f6f6f6;
            Margin: 20px 0; }
        .mrgl-15{
            margin-left: 15px;
        }
        .mrgr-15{
            margin-right: 15px;
        }
        /* -------------------------------------
            RESPONSIVE AND MOBILE FRIENDLY STYLES
        ------------------------------------- */
        @media only screen and (max-width: 620px) {
            table[class=body] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important; }
            table[class=footer] a{
                padding: 0 10px;  }
            table[class=body] .wrapper,
            table[class=body] .article {
                padding: 10px !important; }
            table[class=body] .content {
                padding: 0 !important; }
            table[class=body] .container {
                padding: 0 !important;
                width: 100% !important; }
            table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important; }
            table[class=body] .btn table {
                width: 100% !important; }
            table[class=body] .btn a {
                width: 100% !important;
                color: #ffffff!important;}
            table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important; }}
        /* -------------------------------------
            PRESERVE THESE STYLES IN THE HEAD
        ------------------------------------- */
        @media all {
            .ExternalClass {
                width: 100%; }
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%; }
            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important; }
            .btn-primary table td:hover {
                background-color: #34495e !important; }
            .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important; } }
    </style>
</head>
<body class="">
<table cellpadding="0" cellspacing="0" border="0" style="padding:0px;margin:0px;width:100%;">
    <tr><td colspan="3" style="padding:0px;margin:0px;font-size:20px;height:20px;" height="20">&nbsp;</td></tr>
    <tr>
        <td style="padding:0px;margin:0px;">&nbsp;</td>
        <td style="padding:0px;margin:0px;" width="560">

            <!-- PLACE CONTENT HERE -->
            <table border="0" cellpadding="0" cellspacing="0" class="body">
                <tr>
                    <td class="container">
                        <div class="content">

                            <!-- START CENTERED WHITE CONTAINER -->
                            <span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>
                            <table class="main" border="0" cellpadding="0" cellspacing="0">

                                <!-- START MAIN CONTENT AREA -->
                                <tr>
                                    <td class="wrapper">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <table border="0" cellpadding="0" cellspacing="0">
                                                        <thead>
                                                        <tr>
                                                            <td align="center" style="padding: 25px">
                                                                <table cellpadding="0" cellspacing="0" border="0" style="padding:0px;margin:0px;width:100%;">
                                                                    <tr><td colspan="4" style="padding:0px;margin:0px;font-size:20px;height:20px;" height="20">&nbsp;</td></tr>
                                                                    <tr>
                                                                        <td style="padding:0px;margin:0px;">&nbsp;</td>
                                                                        <td style="padding:0px;margin:0px;vertical-align: middle;" width="150">
                                                                            <a href="http://www.amadeus.com"><img src="http://amadeusnew.wp-dev.com.au/themes/amadeus/images/amadeus.png" alt="logo"></a>
                                                                        </td>
                                                                        <td style="padding:0px;margin:0px;vertical-align: middle;" width="150">
                                                                            <span> | &nbsp;&nbsp;</span><a href="http://www.amadeus.com" style="font-family: 'Titillium Web', sans-serif; font-size: 16px; line-height:48px;color: #005eb8;text-decoration: none">RFP Hub</a>
                                                                        </td>
                                                                        <td style="padding:0px;margin:0px;">&nbsp;</td>
                                                                    </tr>
                                                                    <tr><td colspan="3" style="padding:0px;margin:0px;font-size:20px;height:20px;" height="20">&nbsp;</td></tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" background="images/banner.jpg">
                                                                    <tr>
                                                                        <td height="130px">
                                                                        </td>
                                                                    </tr>

                                                                </table>
                                                                <h2 class="banner-title">RFP Hub February Updates</h2>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 35px 45px;">
                                                                <p><strong>Hi Andrew,</strong></p>

                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam luctus semper arcu, sed aliquet tortor pellentesque ac. Vivamus vel sem sapien. In condimentum vel urna eget consectetur. </p>

                                                                <p style="margin: 0;">Thanks,<br/>
                                                                    Amadeus Asia Pacific</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><h2 class="title">Latest news</h2></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0 30px;">
                                                                <div class="box-item">
                                                                    <table border="0" cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                            <td width="122px">
                                                                                <img src="images/img-thumbnail.jpg" alt="">
                                                                            </td>
                                                                            <td style="padding-left: 30px;">
                                                                                <h3>Title goes here</h3>
                                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam luctus semper arcu, sed aliquet tortor pellentesque ac....</p>
                                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td class="btn btn-primary">
                                                                                            <a href="#">Read more</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0 30px;">
                                                                <div class="box-item">
                                                                    <table border="0" cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                            <td width="122px">
                                                                                <img src="images/img-thumbnail.jpg" alt="">
                                                                            </td>
                                                                            <td style="padding-left: 30px;">
                                                                                <h3>Title goes here</h3>
                                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam luctus semper arcu, sed aliquet tortor pellentesque ac....</p>
                                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td class="btn btn-primary">
                                                                                            <a href="#">Read more</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="padding: 30px; font-size: 16px;"><a href="#">View all blog article</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h2 class="title">Latest product & services updates</h2></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 30px 30px 0;">
                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td>
                                                                            <div class="box-item-small mrgr-15">
                                                                                <h3>Amadeus Negotiated Space</h3>
                                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                                    <tr>
                                                                                        <td style="padding: 20px">
                                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam luctus semper arcu, sed aliquet tortor pellentesque ac....</p>
                                                                                            <table border="0" cellpadding="0" cellspacing="0">
                                                                                                <tbody>
                                                                                                <tr>
                                                                                                    <td class="btn btn-primary">
                                                                                                        <a href="#" style="font-size: 14px">Read more</a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>

                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="box-item-small mrgl-15">
                                                                                <h3>Amadeus Negotiated Space</h3>
                                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                                    <tr>
                                                                                        <td style="padding: 20px">
                                                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam luctus semper arcu, sed aliquet tortor pellentesque ac....</p>
                                                                                            <table border="0" cellpadding="0" cellspacing="0">
                                                                                                <tbody>
                                                                                                <tr>
                                                                                                    <td class="btn btn-primary">
                                                                                                        <a href="#" style="font-size: 14px;">Read more</a>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>

                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 30px; text-align: center">
                                                                <a href="#">View product & services directory</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h2 class="title">Product of the month</h2>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 30px;">
                                                                <div class="box-month">
                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tr>
                                                                            <td>
                                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" background="images/banner.jpg">
                                                                                    <tr>
                                                                                        <td height="130px">
                                                                                        </td>
                                                                                    </tr>

                                                                                </table>
                                                                                <h2 class="banner-small-title">Product title here</h2>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="padding: 20px;">
                                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam luctus semper arcu, sed aliquet tortor pellentesque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam luctus semper arcu, sed aliquet tortor pellentesque ac....
                                                                                    ....
                                                                                </p>
                                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td class="btn btn-primary">
                                                                                            <a href="#" style="font-size: 14px;">Read more</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><h2 class="title">Latest events</h2></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0 30px;">
                                                                <div class="box-item">
                                                                    <table border="0" cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                            <td width="122px">
                                                                                <img src="images/img-thumbnail.jpg" alt="">
                                                                            </td>
                                                                            <td style="padding-left: 30px;">
                                                                                <h3>Title goes here</h3>
                                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam luctus semper arcu, sed aliquet tortor pellentesque ac....</p>
                                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td class="btn btn-primary">
                                                                                            <a href="#">Read more</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0 30px;">
                                                                <div class="box-item">
                                                                    <table border="0" cellpadding="0" cellspacing="0">
                                                                        <tr>
                                                                            <td width="122px">
                                                                                <img src="images/img-thumbnail.jpg" alt="">
                                                                            </td>
                                                                            <td style="padding-left: 30px;">
                                                                                <h3>Title goes here</h3>
                                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam luctus semper arcu, sed aliquet tortor pellentesque ac....</p>
                                                                                <table border="0" cellpadding="0" cellspacing="0">
                                                                                    <tbody>
                                                                                    <tr>
                                                                                        <td class="btn btn-primary">
                                                                                            <a href="#">Read more</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 30px; text-align: center">
                                                                <a href="#" style="font-size: 16px;">View all blog article</a>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                        <tfoot>
                                                        <tr style="background: #47525D;">
                                                            <td class="link" style="padding: 20px 45px;" align="center">
                                                                <a style="text-decoration: none; color: #FFFFFF;" href="http://www.amadeus.com">Home</a>&nbsp;&nbsp;&nbsp;
                                                                <a style="text-decoration: none; color: #FFFFFF;" href="http://www.amadeus.com/why-amadeus/">Why Amadeus</a>&nbsp;&nbsp;&nbsp;
                                                                <a style="text-decoration: none; color: #FFFFFF;" href="http://www.amadeus.com/product-services-directory/">Product & Services Directory</a>
                                                                <br /><br />
                                                                <a style="text-decoration: none; color: #FFFFFF;" href="http://www.amadeus.com/support/knowledgebase/">Common Questions</a>&nbsp;&nbsp;&nbsp;
                                                                <a style="text-decoration: none; color: #FFFFFF;" href="http://www.amadeus.com/blog/">Blog</a>&nbsp;&nbsp;&nbsp;
                                                                <a style="text-decoration: none; color: #FFFFFF;" href="http://www.amadeus.com/contact/">Contact Us</a>
                                                            </td>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- END MAIN CONTENT AREA -->
                            </table>

<<<<<<< .mine
                            <!-- END CENTERED WHITE CONTAINER -->
                        </div>
                    </td>
                </tr>
            </table>
=======
                    <!-- END MAIN CONTENT AREA -->
                </table>

                <!-- START FOOTER -->
                <div class="footer">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="content-block">
                                <span class="apple-link">Tip4tips Company Inc</span>
                                <br> Don't like these emails? <a href="#">Unsubscribe</a>.
                            </td>
                        </tr>
                        <tr>
                            <td class="content-block powered-by">
                                Powered by <a href="">Tip4tips</a>.
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- END FOOTER -->

                <!-- END CENTERED WHITE CONTAINER -->
            </div>
>>>>>>> .r98
        </td>
        <td style="padding:0px;margin:0px;">&nbsp;</td>
    </tr>
    <tr><td colspan="3" style="padding:0px;margin:0px;font-size:20px;height:20px;" height="20">&nbsp;</td></tr>
</table>

</body>
</html>