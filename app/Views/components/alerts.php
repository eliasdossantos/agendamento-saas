<style>
.alert-close {
    background: none;
    border: none;
    padding: 0;
    margin-left: 12px;
    font-size: 16px;
    line-height: 1;
    color: inherit;
    opacity: 0.6;
    cursor: pointer;
}

.alert-close:hover {
    opacity: 1;
}

.alert-close:focus {
    outline: none;
    opacity: 1;
}
</style>
<?php
// Exibe flash messages. Suporta: success, error, warning, info
$alertTypes = ['success', 'error', 'warning', 'info'];

$bootstrapClass = [
    'success' => 'success',
    'error'   => 'danger',
    'warning' => 'warning',
    'info'    => 'info',
];

foreach ($alertTypes as $alertType):
    $alertMsg = \Core\Session::getFlash($alertType);
    if (!$alertMsg) continue;

    $cssClass = $bootstrapClass[$alertType] ?? $alertType;
?>
<div class="alert alert-<?= $cssClass ?> alert-dismissible fade show d-flex justify-content-between align-items-center"
    role="alert" aria-live="polite">
    <div class="alert-body mb-0"><?= e($alertMsg) ?></div>
    <button type="button" class="alert-close"
        onclick="var el=this.parentElement;el.style.transition='opacity .3s ease';el.style.opacity='0';setTimeout(function(){el.remove()},300)"
        aria-label="Fechar">&#x2715;</button>
</div>
<?php endforeach; ?>