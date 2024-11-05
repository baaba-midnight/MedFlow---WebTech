<?php 
$headerTitle = $headerTitle ?? 'Dashboard';
$showSearchBox = $showSearchBox ?? true;
?>

<div class="dashboard-header">
    <h4 class="mb-0"><?php echo $headerTitle; ?></h4>
    <?php if ($showSearchBox): ?>
        <div class="search-box">
            <input type="text" class="form-control" placeholder="Search...">
        </div>
    <?php endif; ?>
</div>