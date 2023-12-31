<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	'Update',
);\n";
?>
?>

<div class="card mb-3">
	<div class="card-body">

		<h1>Ubah Data <?php echo $this->modelClass." <?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

		<?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>

	</div>
</div>