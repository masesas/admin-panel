<div class="text-center">
    <?php
    if ($wd->status === 'approved') {
        $text = 'View Approval';
    } elseif ($wd->status === 'pending') {
        $text = $userSession->tipe_user === 'admin' ? 'Approve' : 'Request Approval';
    } elseif ($wd->status === 'rejected') {
        $text = $userSession->tipe_user === 'admin' ? 'View Rejected' : 'Resubmit Approval';
    } else {
        $text = 'Info';
    }
    ?>
    <a class='btn btn-primary' data-toggle="tooltip" title="Print" href="{{ '#' }}">
        <i class="bi bi-printer"></i> {{ $text }}
    </a>
</div>
