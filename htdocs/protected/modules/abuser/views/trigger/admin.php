<?php
/* @var $this TriggerController */
/* @var $model AbuserTrigger */

$this->breadcrumbs=array(
	'Abuser Triggers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create AbuserTrigger', 'url'=>array('create')),
	array('label'=>'Export Abuser Triggers Backup','url'=>array('export')),
	array('label'=>'Import Abuser Triggers Backup','url'=>array('upload')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('abuser-trigger-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Abuser Triggers</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
<?php echo CHtml::link('Help!',$this->createUrl('/'.Yii::app()->controller->module->id.'/default/help'/*,array('section'=>Yii::app()->controller->id)*/));?>

</p>


<?php $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']); ?>
<?php Yii::app()->clientScript->registerScript('initPageSize',<<<EOD
    $('body').on('change','.change-pagesize', function() {
		$.fn.yiiGridView.update('abuser-trigger-grid',{ data:{ pageSize: $(this).val() }})
    });
EOD
,CClientScript::POS_READY); ?>
<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
  'id'=>'abuser-trigger-grid',
  'fixedHeader' => true,
  'headerOffset' => 40,
  'responsiveTable' => true,
  'type' => 'striped bordered',
  'dataProvider'=>$model->search(),
  'template'=>'{summary}{pager}<br/>{items}{pager}',
  'enableHistory'=>false,
  'filter'=>$model,
	'columns'=>array(
		'id',
		'facility',
		'severity',
		'program',
		'msg',
		'pattern',
		'grouping',
		'capture',
		'description',
		'occurrence',
		'priority',
		'active',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
      'header'=>CHtml::dropDownList(
                'pageSize',
                $pageSize,
                array(0=>'All',5=>5,10=>10,20=>20,50=>50,100=>100),
                array('class'=>'change-pagesize','style'=>'width:80px;')
            ),
		),
	),
)); ?>
