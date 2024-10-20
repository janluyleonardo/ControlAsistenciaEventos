<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <style>
      @import "https://repocun.s3.us-east-2.amazonaws.com/style.css";

    .body {
      background-color: #f0f0f0 !important;
      color: #231e45 !important;
      font-size: 20px;
      font-family: 'Montserrat', sans-serif;
      margin: 0.5cm 1cm 0.5cm 1cm;
    }
    .container{
      background-color: #ffffff !important;
      margin: 0.5cm 0.5cm 0.5cm 0.5cm !important;
    }
    .img-header{
      min-width: 100% !important;
      min-height: 315px !important;
    }
    .img-wave{
      background-color: #ffffff !important;
      min-width: 100% !important;
    }
    .ptitulo{
      background-color: #ffffff !important;
      min-width: 100% !important;
      text-align: center;
      line-height: 1.2;
      font-size: 12pt;
      margin: 0cm 0cm 0cm 0cm !important;
      padding: 8pt 0pt 8pt 0pt;
    }
    .contenedorImg{
      background-color: #19d3c5;
      min-width: 100% !important;
      min-height: 220px !important;
      margin: 0cm 0cm 0cm 0cm !important;
    }
    .left{
      font-size: 12pt;
      color:#ffffff;
      float: left;
      max-width: 65% !important;
      text-align: center;
      margin: 2% 2% 2% 2%;
    }
    .right{
      float: right;
      max-width: 30% !important;
      max-height: 200px !important;
    }
    .img-graduating{
      max-width: 100% !important;
      max-height: 100% !important;
    }
    .Container-btn2 {
      max-width: 100%;
      min-height: 200px;
      padding: 5px;
      color: #191919;
      margin-bottom: 20px;
    }
    .iz2 {
      width: 50%;
      text-align: center;
      float: left;
    }
    .de2 {
      width: 50%;
      text-align: center;
      float: right;
    }
    #resaltado{
      color: #19d3c5;
    }
    .btn{
      background-color: #19D3C5;
      color: #ffffff;
      font-weight: bold;
      font-size: 20px;
      margin-top: 30px;
      border: none;
      border-radius: 50px;
      padding: 10px 20px 10px 20px;
    }
    .imgFoo{
      background-color: #ffffff !important;
      min-width: 100% !important;
    }
    .container-foo {
      min-width: 100%;
      min-height: 40%;
      background-color: #17253F;
      color: #ffffff;
      text-align: center;
    }
    .foomedia {
      display: flex;
      flex-wrap: nowrap;
      width: 50%;
      margin: auto;
    }
    .foomedia > div {
      width: 20%;
      margin: auto;
      text-align: center;
    }

    .button i {
      background: rgba(197, 197, 197, 0);
      border: 2px solid #fff;
      color: #eaeaea;
      text-align: center;
      line-height: 40px;
      font-size: 18px;
      width: 40px;
      height: 40px;
      display: block;
      margin: 10px auto 10px 10px;
      border-radius: 50%;
      -o-border-radius: 50%;
      -ms-border-radius: 50%;
      -moz-border-radius: 50%;
      -webkit-border-radius: 50%;
    }
    .button.tiktok:hover i,
    .tiktok .slide {
      background: #222323;
      color: white;
    }
    .button.facebook:hover i,
    .facebook .slide {
      background: #006aff;
      color: white;
    }

    .button.twitter:hover i,
    .twitter .slide {
      background: #00cdff;
      color: white;
    }

    .button.linkedin:hover i,
    .linkedin .slide {
      background: #007bb6;
      color: white;
    }

    .button.youtube:hover i,
    .youtube .slide {
      background: #FF0000;
      color: white;
    }

    .button.instagram:hover i,
    .instagram .slide {
      background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
      color: white;
    }

    .button.linkedin {
      margin-right: 0;
    }
    </style>
</head>

<body class="body">
    <div class="container">
      <img class="img-header" src="https://repo.cunapp.dev/cdn/correos-grados/header.png" alt="header-correo-cun">

      <p class="ptitulo">
        <strong>¡Lo lograste, Cunista!</strong> Estamos muy orgullosos por tu graduación, ese es el<br>
        resultado a tu esfuerzo y dedicación, es momento de celebrar con tus seres<br>
        queridos esta nueva etapa llena de éxitos <strong>¡Pero antes!</strong> te pedimos algo especial…
      </p>

      <div class="contenedorImg">
        <img class="img-wave" src="https://repo.cunapp.dev/cdn/correos-grados/wave.png" alt="wave-correo-cun">
        <div class="left">
          <p>
            <strong>¡No te vayas sin contarnos tu experiencia!</strong><br>
            Por eso te invitamos a respondernos algunas preguntas<br>
            que nos permitirán trabajar para alcanzar la <strong>¡Satisfacción total!</strong>
          </p>
        </div>
        <div class="right">
          <img class="img-graduating" src="https://repo.cunapp.dev/cdn/correos-grados/graduating.png" alt="graduating-correo-cun">
        </div>
      </div>

      <div class="Container-btn2">
        <div class="iz2">
          <p>Gracias por <strong id="resaltado">ayudarnos <br> a mejorar</strong></p>
          <a href="https://forms.zohopublic.com/corporaciontelecampus/form/EncuestaGradosCeremonia/formperma/CMbT4KmJzSHKQAW9CFMT2f_E6UYRF_0a0vukCi5LF-M">
            <button class="btn">Soy una encuesta</button>
          </a>
        </div>
        <div class="de2">
          <p>Si tienes alguna novedad <br> con el <strong id="resaltado">diploma</strong>
            y <strong id="resaltado">acta</strong> que <br> recibiste
          </p>
          <a href="https://servicioscun.zohodesk.com/portal/es/newticket?departmentId=474709000000006907&layoutId=474709000000074011">
            <button class="btn">Deja tu observacion aquí</button>
          </a>
        </div>
      </div>
      <footer>
        <div class="container-foo">
          <img class="imgFoo" src="https://repo.cunapp.dev/cdn/correos-grados/footer.png" alt="imagen de footer">
          <div class="footext">
              ¿Dudas?<br>
              ¡Visitanos en!<br>
              <a href="https://cun.edu.co/">CUN.EDU.CO</a>
          </div>
          <div class="foomedia">
            <div class="tiktok button">
              <a href="https://www.tiktok.com/@yosoycun">
                <i class="bi bi-facebook">
                  <img alt="Tiktok" height="35" purpose="wdgt_1689353154541" src="https://stratus.campaign-image.com/images/639603000897115896_2_1695316027066_639603000897481947.png" style="border: 0px; margin: 0px; outline: none; text-decoration: none; width: 100%; height: 100%;" vspace="10" width="35">
                </i>
              </a>
            </div>
            <div class="facebook button">
              <a href="https://www.facebook.com/YoSoyCUN1">
                <i class="bi bi-facebook">
                  <img alt="Facebook" height="35" src="https://stratus.campaign-image.com/images/639603000897115896_3_1695316027108_zcsclwgtfb2.png" style="border: 0px; margin: 0px; outline: none; text-decoration: none; width: 100%; height: 100%;" vspace="10" width="35">
                </i>
              </a>
            </div>
            <div class="twitter button">
              <a href="https://twitter.com/YoSoyCUN">
                <i class="bi bi-twitter">
                  <img alt="Twitter" height="35" src="https://stratus.campaign-image.com/images/639603000897115896_4_1695316027145_zcsclwgttwt2.png" style="border: 0px; margin: 0px; outline: none; text-decoration: none; width: 100%; height: 100%;" vspace="10" width="35">
                </i>
              </a>
            </div>
            <div class="linkedin button">
              <a href="https://www.linkedin.com/uas/login?session_redirect=https%3A%2F%2Fwww.linkedin.com%2Fschool%2Fcorporacion-unificada-nacional-de-educacion-superior-cun%2Fmycompany%2F">
                <i class="bi bi-linkedin">
                  <img alt="LinkedIn" height="35" src="https://stratus.campaign-image.com/images/639603000897115896_5_1695316027189_zcsclwgtlin2.png" style="border: 0px; margin: 0px; outline: none; text-decoration: none; width: 100%; height: 100%;" vspace="10" width="35">
                </i>
              </a>
            </div>
            <div class="youtube button">
              <a href="https://www.youtube.com/@CUNWeb">
                <i class="bi bi-youtube">
                  <img alt="Youtube" height="35" src="https://stratus.campaign-image.com/images/639603000897115896_6_1695316027230_zcsclwgtyt2.png" style="border: 0px; margin: 0px; outline: none; text-decoration: none; width: 100%; height: 100%;" vspace="10" width="35">
                </i>
              </a>
            </div>
            <div class="instagram button">
              <a href="https://www.instagram.com/yosoycun/">
                <i class="bi bi-instagram">
                  <img alt="Instagram" height="35" src="https://stratus.campaign-image.com/images/639603000897115896_7_1695316027269_zcsclwgtinsta2.png" style="border: 0px; margin: 0px; outline: none; text-decoration: none; width: 100%; height: 100%;" vspace="10" width="35">
                </i>
              </a>
            </div>
          </div>
        </div>
      </footer>
    </div>
</body>

</html>
