<?php
class AppAsset
{
	private static $css = [
		'css/bootstrap.min.css',
		'css/font-awesome.css',
		'css/lava.css',
		'css/owl-carousel.css',
		'css/swipper.min.css',
	];
	private static $cssLogin = [
		'vendor/bootstrap/css/bootstrap.min.css',
		'vendor/bootstrap-icons/bootstrap-icons.css',
		'vendor/boxicons/css/boxicons.min.css',
		'vendor/quill/quill.snow.css',
		'vendor/quill/quill.bubble.css',
		'vendor/remixicon/remixicon.css',
		'css/style.css',
	];
	private static $cssLanding = [
		'css/styles.css',
		'css/custom.css',
	];
	private static $js = [
		'js/jquery-2.1.0.min.js',
		'js/jquery-migrate.js',
		'js/bootstrap.min.js',
		'js/fastclick.js',
		'js/nprogress/nprogress.js',
		'js/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
		'vendors/iCheck/icheck.min.js',
		'vendors/Chart.js/dist/Chart.min.js',
		'vendors/switchery/dist/switchery.min.js',
		'build/js/custom.js',
		'js/tags/jquery.tagsinput.js',
		'js/jquery_ui/jquery-ui.min.js',
		'js/sweetalert2.min.js',
		'js/accounting.min.js',
		'js/select2.min.js'
	];
	private static $jsLogin = [
		'js/jquery-2.1.0.min.js',
		'js/jquery-migrate.js',
		'vendor/bootstrap/js/bootstrap.bundle.min.js',
		'vendor/quill/quill.min.js',
		'vendor/tinymce/tinymce.min.js',
		'vendor/php-email-form/validate.js',
		'js/main.js',
		'js/accounting.min.js',
		'vendor/apexcharts/apexcharts.min.js'
	];
	private static $jsLanding = [
		'js/jquery.js',
		'js/yii.js',
		'js/jquery-migrate.js',
		'js/bootstrap.bundle.min.js',
		'js/anime.min.js',
		'js/lazyload.min.js',
	];

	public static function registerCss($params = ''){
		$cssPrint = "";
		switch ($params) {
			case 'landing':
				foreach (self::$cssLanding as $asset) {
					$cssPrint .= "<link type=\"text/css\" href='" . Constant::frontAssetUrl() . "/". $asset ."' rel='stylesheet'> ";
				}
				break;
			
			default:
				foreach (self::$css as $asset) {
					$cssPrint .= "<link type=\"text/css\" href='" . Constant::frontAssetUrl() . "/". $asset ."' rel='stylesheet'> ";
				}
				break;
		}

		return $cssPrint;
	}

	public static function registerJs($params = ''){
		$jsPrint = "";
		switch ($params) {
			case 'landing':
				foreach (self::$jsLanding as $asset) {
					$jsPrint .= "<script type='text/javascript' src='" . Constant::assetsUrl() . "/" . $asset . "'></script>";
				}

				break;
			
			default:
				foreach (self::$js as $asset) {
					if (in_array(Yii::app()->controller->action->Id, ['login','index','homeCrew','qrResult'
					]) && in_array($asset, ['js/jquery-2.1.0.min.js']) || 
					(!in_array(Yii::app()->controller->action->Id, ['login']) && in_array($asset, ['js/tags/jquery.tagsinput.js'])))
						continue;

					$jsPrint .= "<script type='text/javascript' src='" . Constant::assetsUrl() . "/" . $asset . "'></script>";
				}

				break;
		}
	
		return $jsPrint;
	}

	public static function registerCssLogin($params = ''){
		$cssPrint = "";
		switch ($params) {
			case 'landing':
				foreach (self::$cssLanding as $asset) {
					$cssPrint .= "<link type=\"text/css\" href='" . Constant::frontAssetUrl() . "/assets/". $asset ."' rel='stylesheet'> ";
				}
				break;
			
			default:
				foreach (self::$cssLogin as $asset) {
					$cssPrint .= "<link type=\"text/css\" href='" . Constant::frontAssetUrl() . "/assets/". $asset ."' rel='stylesheet'> ";
				}
				break;
		}

		return $cssPrint;
	}

	public static function registerJsLogin($params = ''){
		$jsPrint = "";
		switch ($params) {
			case 'landing':
				foreach (self::$jsLanding as $asset) {
					$jsPrint .= "<script type='text/javascript' src='" . Constant::frontAssetUrl() . "/" . $asset . "'></script>";
				}

				break;
			
			default:
				foreach (self::$jsLogin as $asset) {
					if (in_array(Yii::app()->controller->route, ['site/loginAdmin','product/index','product/create']) && $asset == 'js/jquery-2.1.0.min.js')
						continue;
					$jsPrint .= "<script type='text/javascript' src='" . Constant::frontAssetUrl() . "/assets/" . $asset . "'></script>";
				}

				break;
		}
	
		return $jsPrint;
	}
}
?>
