<?php declare(strict_types=1);

use wfm\View;

// @var $this View

?>
<?php $this->getPart('parts/header'); ?>

<?php echo $this->content; ?>

<?php $this->getPart('parts/footer'); ?>
