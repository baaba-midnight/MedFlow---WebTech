<?php 
$headerTitle = $headerTitle ?? 'Dashboard';
$showSearchBox = $showSearchBox ?? true;
$buttonContent = $buttonContent ?? '';
?>

<div class="dashboard-header">
    <h4 class="mb-0"><?php echo $headerTitle; ?></h4>
    <div class="ms-auto d-flex align-items-center gap-3">
        <?php if ($showSearchBox): ?>
            <div class="input-group" style="width: 300px">
                <input type="text" class="form-control" placeholder="Search...">
                <button class="btn btn-dark" type="button" style="justify-content: space-between;">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        <?php endif; ?>

        <?php if ($buttonContent != ''): ?>
            <button class="btn btn-dark">
                <i class="fas fa-plus"></i><?php echo $buttonContent; ?></a>
            </button>
        <?php endif; ?>
    </div>
</div>