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
			$model->startdate = null;
		}

        if (isset($_GET['enddate']) && !empty($_GET['enddate'])) {
			$model->enddate = $_GET['enddate'];
		} else {
			$model->enddate = null;
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
}