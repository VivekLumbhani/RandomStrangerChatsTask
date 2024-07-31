<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
        'id' => 'user-form',
        'enableAjaxValidation' => true,
        'action' => ['static-user/insert-static-user'], 
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'country_code')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->input('email') ?>
    <?= $form->field($model, 'gender')->dropDownList(['M' => 'Male', 'F' => 'Female'], ['value' => 'M']) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success', 'id' => 'submit-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
$('#user-form').on('beforeSubmit', function(e) {
    var form = $(this);

    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        success: function(response) {
            response = JSON.parse(response);
            if (response.success) {
                $('#submit-button').prop('disabled', true);
                alert('User created successfully!');
            } else {
                
                $('#submit-button').prop('disabled', true);
                alert('User created successfully!');
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX error:', error);
            alert('Error occurred: ' + error);
        }
    });
    return false;
});
JS;
$this->registerJs($script);
?>
