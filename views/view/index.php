<?php 
$this->title = 'Controller Context';
?>

<h1><?= $this->context->pageTitle ?></h1>

<p>Hello call. <?php $this->context->hello(); ?></p>

<p>Test2 <?php $this->context->hello(); ?></p>
