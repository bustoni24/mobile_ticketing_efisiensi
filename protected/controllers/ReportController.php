<?php
class ReportController extends Controller
{
	public $layout='//layouts/column_mobile';

	public function init() {
		if (isset(Yii::app()->user->id, Yii::app()->user->role)){

		} else {
			$this->redirect(Constant::baseLogin());
		}

        function doPrintResult($result = [])
        {
            echo json_encode($result);
            Yii::app()->end();
        }
	}

    public function actionReportDashboard()
    {
        return $this->render('reportDashboard');
    }

    public function actionReportDeposit()
    {
        $model = new Report('searchReportDeposit');
		if (isset($_GET['startdate']) && !empty($_GET['startdate'])) {
			$model->startdate = $_GET['startdate'];
		} else {
			$model->startdate = date('Y-m-d');
		}

        if (isset($_GET['enddate']) && !empty($_GET['enddate'])) {
			$model->enddate = $_GET['enddate'];
		} else {
			$model->enddate = date('Y-m-d');
		}

        return $this->render('reportDeposit', [
            'model' => $model
        ]);
    }

    public function actionReportBooking()
    {
        $model = new Report('searchDataBooking');
		if (isset($_GET['startdate']) && !empty($_GET['startdate'])) {
			$model->startdate = $_GET['startdate'];
		} else {
			$model->startdate = date('Y-m-d');
		}

        if (isset($_GET['enddate']) && !empty($_GET['enddate'])) {
			$model->enddate = $_GET['enddate'];
		} else {
			$model->enddate = date('Y-m-d');
		}

        return $this->render('reportBooking', [
            'model' => $model
        ]);
    }

    public function actionReportBookingUser()
    {
        $model = new Report('searchDataBookingUser');
		if (isset($_GET['startdate']) && !empty($_GET['startdate'])) {
			$model->startdate = $_GET['startdate'];
		} else {
			$model->startdate = date('Y-m-d');
		}

        if (isset($_GET['enddate']) && !empty($_GET['enddate'])) {
			$model->enddate = $_GET['enddate'];
		} else {
			$model->enddate = date('Y-m-d');
		}
		$model->type_date = isset($_GET['type_date']) ? $_GET['type_date'] : Constant::TYPE_DATE_CREATE;
		$totalPenjualan = $model->searchDataBookingUser(true, ['get_total'=>1]);

		if (isset($_GET['excel']) && $_GET['excel']) {
			$model->is_export = true;
			BookingHelper::getInstance()->exportBookingDataUser($model);
		}

        return $this->render('reportBookingUser', [
            'model' => $model,
			'total_penjualan' => $totalPenjualan
        ]);
    }
}