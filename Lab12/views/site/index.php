<?php
// Page title
$this->title = 'Medical System';
?>
<div class="site-index text-center" style="margin-top: 100px;">
    <div class="jumbotron bg-transparent">
        <!-- Welcome message -->
        <h1 class="display-4 text-white">Welcome!</h1>

        <hr class="my-4" style="border-color: #444;">

        <!-- Instructions -->
        <p>Go to the administration section to manage data.</p>

        <p>
            <!-- Button to patient list -->
            <a class="btn btn-success btn-lg" href="<?= \yii\helpers\Url::to(['patient/index']) ?>" role="button">
                Patient List
            </a>
        </p>
    </div>
</div>