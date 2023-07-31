<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= CHtml::encode($this->pageTitle); ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="<?= Constant::getImageUrl().'/logo.png'; ?>" rel="icon"> -->
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <?= AppAsset::registerCssLogin(); ?>
  <style>
    :root {
        --color-primary: #F58220;
        --bg-primary: #6C6D70;
        --bg-white: #fff;
        --bg-secondary: #F2F2F2;
        --bg-header-table: #FDD9B7;
        --color-secondary: #FEF0E2;
        --border-table: #848484;
        --color-link: #007bff;
        --black: #000;
        --bg-danger: #FECA0A;
        --bg-red: #d9534f;
        --btn-danger: #c9302c;
        --btn-danger-border: #ac2925;
        --color-success: #07c16c;
        --bg-light-grey: #efefef;
        }
    html {
  box-sizing: border-box;
}
.container {
    max-width: 500px;
}
*,
*:before,
*:after {
  box-sizing: inherit;
}

/** Only Copy Below **/
body {
  background: var(--bg-primary);
  font-family: "Open Sans", sans-serif;
  margin: 0;
  padding: 0;
}

.abm-login-screen {
  color: white;
  display: inline-block;
  width: 100%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.abm-agile-login-wrap {
  padding: 0 1em;
}

/* Change autocomplete styles in WebKit ------------------------------- */
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus input:-webkit-autofill,
textarea:-webkit-autofill,
textarea:-webkit-autofill:hover textarea:-webkit-autofill:focus,
select:-webkit-autofill,
select:-webkit-autofill:hover,
select:-webkit-autofill:focus {
  border: 1px solid #ff6f00;
  -webkit-text-fill-color: #ffc107;
  -webkit-box-shadow: 0 0 0px 1000px transparent inset;
  transition: background-color 5000s ease-in-out 0s;
}

/* Override tyling input buttons for iPad and iPhone
------------------------------- */
input,
button,
textarea {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}

/* Logo ------------------------------- */
.abm-agile-logo-wrap {
  width: 100%;
}
.abm-agile-logo-wrap .abm-agile-logo {
  display: block;
  margin: 0 auto 4em;
  width: 100%;
  max-width: 220px;
}

/* Form starting stylings ------------------------------- */
.abm-login-form {
  display: block;
  margin: 0 auto;
  max-width: 300px;
}
.abm-login-form .abm-input-group {
  position: relative;
  margin: 2em 0;
  /* LABEL ======================================= */
  /* active state */
}
.abm-login-form .abm-input-group input {
  background: transparent;
  font-size: 18px;
  padding: 10px 10px 10px 5px;
  display: block;
  width: 100%;
  border: none;
  border-bottom: 1px solid white;
  color: white;
  border-radius: 0;
}
.abm-login-form .abm-input-group input:focus {
  outline: none;
  border-bottom: 0 solid transparent;
  color: white;
}
.abm-login-form .abm-input-group label {
  color: white;
  font-size: 18px;
  font-weight: normal;
  position: absolute;
  pointer-events: none;
  left: 5px;
  top: 10px;
  transition: 0.2s ease all;
  -moz-transition: 0.2s ease all;
  -webkit-transition: 0.2s ease all;
}
.abm-login-form .abm-input-group input:focus ~ label,
.abm-login-form .abm-input-group input:valid ~ label {
  top: -22px;
  font-size: 14px;
  color: white;
}

/* BOTTOM BARS ================================= */
.abm-input-bar {
  position: relative;
  display: block;
  width: 300px;
}
.abm-input-bar:before, .abm-input-bar:after {
  content: "";
  height: 2px;
  width: 0;
  bottom: 1px;
  position: absolute;
  background: var(--color-primary);
  transition: 0.2s ease all;
  -moz-transition: 0.2s ease all;
  -webkit-transition: 0.2s ease all;
}
.abm-input-bar:before {
  left: 50%;
}
.abm-input-bar:after {
  right: 50%;
}

/* active state */
input:focus ~ .abm-input-bar:before,
input:focus ~ .abm-input-bar:after {
  width: 50%;
}

/* HIGHLIGHTER ================================== */
.abm-highlight {
  position: absolute;
  height: 60%;
  width: 100px;
  top: 25%;
  left: 0;
  pointer-events: none;
  opacity: 0.5;
}

/* active state */
input:focus ~ .abm-highlight {
  -webkit-animation: inputHighlighter 0.3s ease;
  -moz-animation: inputHighlighter 0.3s ease;
  animation: inputHighlighter 0.3s ease;
}

/* ANIMATIONS ================ */
@-webkit-keyframes inputHighlighter {
  from {
    background: var(--color-primary);
  }
  to {
    width: 0;
    background: transparent;
  }
}
@-moz-keyframes inputHighlighter {
  from {
    background: var(--color-primary);
  }
  to {
    width: 0;
    background: transparent;
  }
}
@keyframes inputHighlighter {
  from {
    background: var(--color-primary);
  }
  to {
    width: 0;
    background: transparent;
  }
}
.abm-checkbox-group {
  position: relative;
  bottom: 1em;
}
.abm-checkbox-group label {
  position: relative;
  bottom: 8px;
}
.abm-checkbox-group .abm-checkbox {
  position: relative;
  width: 20px;
  height: 20px;
  margin-right: 0.75rem;
  cursor: pointer;
  appearance: none;
  outline: 0;
  border: none;
  z-index: 1;
}
.abm-checkbox-group .abm-checkbox:after {
  content: "";
  background: var(--bg-primary);
  position: absolute;
  left: 0;
  top: 0;
  z-index: 2;
  width: 100%;
  height: 100%;
}
.abm-checkbox-group .abm-checkbox:before {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  z-index: 5;
  width: 100%;
  height: 100%;
  border: 3px solid white;
  transition: all 0.3s ease-in-out;
}
.abm-checkbox-group .abm-checkbox:checked:before {
  height: 50%;
  transform: rotate(-45deg);
  border: 3px solid var(--color-primary);
  border-top-style: none;
  border-right-style: none;
}

.abm-login-button {
  background: var(--color-primary);
  border: 1px solid var(--color-primary);
  border-radius: 3px;
  color: white;
  font-size: 1.5em;
  padding: 0.5em;
  width: 100%;
  position: relative;
  transition: all 0.2s ease-in-out;
  box-shadow: none;
}
.abm-login-button:hover {
  transform: scale(1.05);
}

/* SPINNER ================================== */
.abm-loader {
  color: #ffffff;
  font-size: 20px;
  text-indent: -9999em;
  overflow: hidden;
  width: 1em;
  height: 1em;
  border-radius: 50%;
  margin: 20px auto;
  position: absolute;
  top: -4px;
  right: 23px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation: load6 1.7s infinite ease, round 1.7s infinite ease;
  animation: load6 1.7s infinite ease, round 1.7s infinite ease;
}

@-webkit-keyframes load6 {
  0% {
    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
  }
  5%, 95% {
    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
  }
  10%, 59% {
    box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
  }
  20% {
    box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
  }
  38% {
    box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
  }
  100% {
    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
  }
}
@keyframes load6 {
  0% {
    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
  }
  5%, 95% {
    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
  }
  10%, 59% {
    box-shadow: 0 -0.83em 0 -0.4em, -0.087em -0.825em 0 -0.42em, -0.173em -0.812em 0 -0.44em, -0.256em -0.789em 0 -0.46em, -0.297em -0.775em 0 -0.477em;
  }
  20% {
    box-shadow: 0 -0.83em 0 -0.4em, -0.338em -0.758em 0 -0.42em, -0.555em -0.617em 0 -0.44em, -0.671em -0.488em 0 -0.46em, -0.749em -0.34em 0 -0.477em;
  }
  38% {
    box-shadow: 0 -0.83em 0 -0.4em, -0.377em -0.74em 0 -0.42em, -0.645em -0.522em 0 -0.44em, -0.775em -0.297em 0 -0.46em, -0.82em -0.09em 0 -0.477em;
  }
  100% {
    box-shadow: 0 -0.83em 0 -0.4em, 0 -0.83em 0 -0.42em, 0 -0.83em 0 -0.44em, 0 -0.83em 0 -0.46em, 0 -0.83em 0 -0.477em;
  }
}
@-webkit-keyframes round {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes round {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
  </style>
  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">
      <?= $content; ?>
    </div>
  </main><!-- End #main -->

  <?= AppAsset::registerJs(); ?>

  <script>
    $( '.abm-login-button' ).click(function() {
  $(this).append( '<div class="abm-loader"></div>' );
});
  </script>
</body>

</html>