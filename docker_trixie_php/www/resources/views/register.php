<h1>Create an account</h1>

<?php $form = \App\Core\Form\Form::begin('', 'post'); ?>

<div class="row">
  <div
    class="col mb-3"><?php echo $form->field($model, 'firstname'); ?>
  </div>
  <div
    class="col mb-3"><?php echo $form->field($model, 'lastname'); ?>
  </div>
</div>
<?php echo $form->field($model, 'email')->emailField(); ?>
<?php echo $form->field($model, 'password')->passwordField(); ?>
<?php echo $form->field($model, 'confirmPassword'); ?>
<button type="submit" class="btn btn-primary">Submit</button>
<a href="/login">Already have an account?</a>
<?php \App\Core\Form\Form::end() ?>