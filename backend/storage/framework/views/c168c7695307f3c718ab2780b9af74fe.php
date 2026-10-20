<?php $__env->startSection('content'); ?>

<style>

/* =====================================================
   MEMBERSHIP PAGE - FULL RESPONSIVE CSS
   Sidebar overlap + horizontal overflow fix
===================================================== */

/* Global box sizing */
*,
*::before,
*::after {
    box-sizing: border-box;
}

/* Prevent page-level horizontal overflow */
html,
body {
    width: 100%;
    max-width: 100%;
    margin: 0;
    overflow-x: hidden;
}

/* =====================================================
   MAIN MEMBERSHIP PAGE
===================================================== */

.membership-page {
    --sidebar-width: 250px;

    /*
      Desktop:
      Reserve space for the fixed sidebar.
    */
    width: calc(100% - var(--sidebar-width));
    max-width: calc(100% - var(--sidebar-width));
    min-width: 0;

    margin-left: var(--sidebar-width);

    background: #f7f3f4;
    color: #542432;
    font-size: 13px;
    min-height: 100vh;

    overflow-x: clip;
    overflow-wrap: anywhere;
}

/* Keep every child within available width */
.membership-page,
.membership-page *,
.membership-page *::before,
.membership-page *::after {
    box-sizing: border-box;
    min-width: 0;
}

/* Media elements */
.membership-page img,
.membership-page video,
.membership-page iframe {
    max-width: 100%;
}

/* =====================================================
   PAGE HEADER
===================================================== */

.membership-header {
    background: #fff;
    border-bottom: 1px solid #eee4e7;

    width: 100%;
    max-width: 100%;
    min-width: 0;

    padding: 20px 24px;

    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
}

.membership-header > * {
    min-width: 0;
    max-width: 100%;
}

.membership-title {
    font-size: 22px;
    font-weight: 800;
    color: #51202f;
    margin: 0 0 5px;
    overflow-wrap: anywhere;
}

.membership-subtitle {
    font-size: 12px;
    color: #968990;
    margin: 0;
    line-height: 1.6;
}

/* Header search form */
.membership-header form {
    min-width: 0;
    max-width: 100%;
}

.membership-search {
    width: 250px;
    max-width: 100%;
    min-width: 0;
}

/* =====================================================
   MAIN CONTENT
===================================================== */

.membership-main {
    width: 100%;
    max-width: 100%;
    min-width: 0;
    padding: 24px;
    margin: 0;
}

.membership-main > section {
    width: 100%;
    max-width: 100%;
    min-width: 0;
}

.membership-main > *,
.membership-main section > * {
    max-width: 100%;
    min-width: 0;
}

/* =====================================================
   COMMON CARD
===================================================== */

.membership-card {
    background: #fff;
    border: 1px solid #eee4e7;
    border-radius: 14px;

    min-width: 0;
    max-width: 100%;
}

/* =====================================================
   SUMMARY STATISTICS
===================================================== */

.membership-stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));

    gap: 15px;
    margin-bottom: 25px;

    width: 100%;
    max-width: 100%;
    min-width: 0;
}

.membership-stats > * {
    min-width: 0;
    max-width: 100%;
}

.membership-stat {
    padding: 15px;
    min-height: 112px;
    overflow: hidden;
}

.membership-stat-icon {
    width: 34px;
    height: 34px;
    flex-shrink: 0;

    border-radius: 11px;
    background: #f7e9ed;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #81364b;
    font-size: 16px;
    margin-bottom: 10px;
}

.membership-stat-label {
    font-size: 11px;
    color: #8c8087;
    margin: 0;
    overflow-wrap: anywhere;
}

.membership-stat-value {
    font-size: 23px;
    line-height: 1.3;
    font-weight: 800;
    color: #542032;
    margin: 4px 0 0;
    overflow-wrap: anywhere;
}

/* =====================================================
   SECTION HEADINGS
===================================================== */

.membership-section-title {
    font-size: 16px;
    font-weight: 800;
    color: #572332;
    margin: 0;
    overflow-wrap: anywhere;
}

/* =====================================================
   MEMBERSHIP PLAN GRID
===================================================== */

.membership-plans {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));

    gap: 16px;
    margin: 14px 0 25px;

    width: 100%;
    max-width: 100%;
    min-width: 0;
}

.membership-plans > * {
    min-width: 0;
    max-width: 100%;
}

.membership-plan {
    padding: 16px;
    min-height: 180px;

    display: flex;
    flex-direction: column;
    justify-content: space-between;

    overflow-wrap: anywhere;
    background: #fff;
}

.membership-plan-top {
    display: flex;
    align-items: center;
    gap: 12px;

    min-width: 0;
    max-width: 100%;
}

.membership-plan-top > * {
    min-width: 0;
}

.membership-plan-icon {
    width: 40px;
    height: 40px;
    flex-shrink: 0;

    border-radius: 11px;
    background: #f7e9ed;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #81364b;
    font-size: 17px;
}

.membership-plan-name {
    font-size: 14px;
    font-weight: 800;
    color: #572332;
    margin: 0 0 5px;
    overflow-wrap: anywhere;
}

.membership-plan-price {
    font-size: 17px;
    font-weight: 800;
    color: #702c43;
    margin: 0;
    overflow-wrap: anywhere;
}

.membership-plan-desc {
    font-size: 11px;
    color: #8b7e85;
    line-height: 1.7;

    margin: 15px 0;

    overflow-wrap: anywhere;
    word-break: normal;
}

/* =====================================================
   BUTTONS - ORIGINAL COLORS PRESERVED
===================================================== */

.membership-btn {
    display: inline-block;

    max-width: 100%;
    min-width: 0;

    border: 0;
    border-radius: 8px;

    background: #f6e7eb;
    color: #80354a;

    font-size: 11px;
    font-weight: 700;

    padding: 8px 12px;
    text-decoration: none;
    text-align: center;

    cursor: pointer;
    white-space: normal;

    transition:
        background-color 0.2s ease,
        color 0.2s ease;
}

.membership-btn-primary {
    background: #561325;
    color: #fff;
}

.membership-btn-primary:hover {
    background: #70263d;
    color: #fff;
}

.membership-btn:not(.membership-btn-primary):hover {
    background: #ead1d9;
    color: #572332;
}

.membership-plan .membership-btn {
    display: block;
    width: 100%;
}

/* =====================================================
   TRANSACTION TABLE CARD
===================================================== */

.membership-table-card {
    width: 100%;
    max-width: 100%;
    min-width: 0;

    padding: 18px;
    background: #fff;
}

.membership-table-card > * {
    min-width: 0;
    max-width: 100%;
}

/* Horizontal scroll belongs only to the table wrapper */
.membership-table-wrap {
    display: block;

    width: 100%;
    max-width: 100%;
    min-width: 0;

    overflow-x: auto;
    overflow-y: hidden;

    -webkit-overflow-scrolling: touch;

    border: 1px solid #eee4e7;
    border-radius: 11px;

    margin-top: 15px;
}

/* Table can be wider than wrapper */
.membership-table {
    width: 100%;
    min-width: 850px;

    border-collapse: separate;
    border-spacing: 0;
    margin: 0;
}

.membership-table thead th {
    background: #f8f2f4;
    color: #603344;

    font-size: 10px;
    font-weight: 800;

    padding: 12px 10px;
    text-align: left;
    white-space: nowrap;
}

.membership-table tbody td {
    padding: 14px 10px;

    font-size: 11px;
    color: #665b61;

    border-bottom: 1px solid #eee4e7;
    vertical-align: middle;
}

.membership-table tbody tr:last-child td {
    border-bottom: 0;
}

.membership-txn {
    font-weight: 800;
    color: #713348;
    overflow-wrap: anywhere;
}

/* =====================================================
   PAYMENT STATUS
===================================================== */

.membership-status {
    display: inline-block;

    padding: 5px 9px;
    border-radius: 20px;

    font-size: 10px;
    font-weight: 700;

    background: #e8f6f0;
    color: #268367;

    white-space: nowrap;
}

.membership-status.pending {
    background: #fff4df;
    color: #a56b12;
}

.membership-status.other {
    background: #f3e9ec;
    color: #79364b;
}

/* =====================================================
   PAGINATION
===================================================== */

.membership-pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;

    gap: 12px;
    padding-top: 16px;
    flex-wrap: wrap;

    min-width: 0;
    max-width: 100%;
}

.membership-pagination .pagination {
    margin: 0;
    flex-wrap: wrap;
    gap: 3px;
}

.membership-pagination > * {
    min-width: 0;
    max-width: 100%;
}

/* =====================================================
   FORM CONTROLS
===================================================== */

.membership-page .form-control,
.membership-page .form-select {
    width: 100%;
    max-width: 100%;
    min-width: 0;
}

.membership-page .form-control:focus,
.membership-page .form-select:focus {
    border-color: #bd8799;
    box-shadow: 0 0 0 0.15rem rgba(86, 19, 37, 0.10);
}

/* =====================================================
   GENERAL OVERFLOW PROTECTION
===================================================== */

.membership-page h1,
.membership-page h2,
.membership-page h3,
.membership-page h4,
.membership-page p,
.membership-page a,
.membership-page button {
    overflow-wrap: anywhere;
}

.membership-page .row {
    max-width: 100%;
}

.membership-page [class*="col-"] {
    min-width: 0;
    max-width: 100%;
}

/* =====================================================
   MEDIUM SCREENS
===================================================== */

@media (max-width: 1100px) and (min-width: 769px) {
    .membership-page {
        --sidebar-width: 250px;

        width: calc(100% - var(--sidebar-width));
        max-width: calc(100% - var(--sidebar-width));
        margin-left: var(--sidebar-width);
    }

    .membership-stats {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .membership-plans {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .membership-main {
        padding: 20px;
    }
}

/* =====================================================
   TABLET
===================================================== */

@media (max-width: 768px) {
    /*
      Use this mobile rule only when the sidebar
      is hidden or collapsed by the main layout.
    */
    .membership-page {
        width: 100%;
        max-width: 100%;
        margin-left: 0;
    }

    .membership-header {
        padding: 18px;
        align-items: flex-start;
    }

    .membership-main {
        padding: 18px;
    }

    .membership-header > *,
    .membership-header form {
        max-width: 100%;
    }

    .membership-table-card {
        padding: 14px;
    }

    .membership-stats {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .membership-plans {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

/* =====================================================
   MOBILE
===================================================== */

@media (max-width: 600px) {
    .membership-header {
        padding: 16px;

        align-items: stretch;
        flex-direction: column;
        gap: 14px;
    }

    .membership-title {
        font-size: 19px;
    }

    .membership-subtitle {
        font-size: 12px;
    }

    .membership-main {
        padding: 12px;
    }

    .membership-stats,
    .membership-plans {
        grid-template-columns: minmax(0, 1fr);
        gap: 12px;
    }

    .membership-stat {
        min-height: 100px;
    }

    .membership-stat-value {
        font-size: 21px;
    }

    .membership-plan {
        min-height: 160px;
    }

    .membership-table-card {
        padding: 12px;
        border-radius: 12px;
    }

    .membership-header form {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;

        width: 100%;
        min-width: 0;
    }

    .membership-header form input {
        flex: 1 1 150px;
        width: 100%;
        min-width: 0;
    }

    .membership-search {
        width: 100%;
        max-width: 100%;
    }

    .membership-pagination {
        align-items: flex-start;
        flex-direction: column;
    }
}

/* =====================================================
   VERY SMALL MOBILE
===================================================== */

@media (max-width: 360px) {
    .membership-main {
        padding: 8px;
    }

    .membership-header {
        padding: 12px;
    }

    .membership-stat,
    .membership-plan {
        padding: 12px;
    }

    .membership-table-card {
        padding: 8px;
    }

    .membership-plan-price {
        font-size: 15px;
    }

    .membership-btn {
        padding: 8px 9px;
    }
}

</style>

<div class="membership-page">

    
    <header class="membership-header">
        <div>
            <h1 class="membership-title">
                Membership &amp; Payments
            </h1>

            <p class="membership-subtitle">
                Manage plans, transactions, renewals and member subscriptions.
            </p>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-3">

            <form method="GET"
                  action="<?php echo e(route('admin.membership')); ?>"
                  class="d-flex gap-2">

                <input
                    type="search"
                    name="search"
                    value="<?php echo e(request('search')); ?>"
                    class="form-control form-control-sm membership-search"
                    placeholder="Search member / transaction ID"
                    aria-label="Search membership transactions">

                <button type="submit"
                        class="membership-btn membership-btn-primary">
                    Search
                </button>

                <?php if(request()->filled('search')): ?>
                    <a href="<?php echo e(route('admin.membership')); ?>"
                       class="membership-btn">
                        Clear
                    </a>
                <?php endif; ?>
            </form>

            <div class="d-flex align-items-center gap-2">
                <div style="
                    width:36px;
                    height:36px;
                    border-radius:50%;
                    background:#f6e9ed;
                    color:#682e41;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    font-weight:800;">
                    A
                </div>

                <div>
                    <div class="fw-bold text-dark">Admin</div>
                    <small class="text-muted">Administrator</small>
                </div>
            </div>
        </div>
    </header>

    <main class="membership-main">

        
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show"
                 role="alert">
                <?php echo e(session('success')); ?>


                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close"></button>
            </div>
        <?php endif; ?>

        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <strong>Please check the form:</strong>

                <ul class="mb-0 mt-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        
        <section class="membership-stats">

            <div class="membership-card membership-stat">
                <div class="membership-stat-icon">♧</div>

                <p class="membership-stat-label">
                    Active Premium Profiles
                </p>

                <h2 class="membership-stat-value">
                    <?php echo e(number_format($activePremiumProfiles)); ?>

                </h2>
            </div>

            <div class="membership-card membership-stat">
                <div class="membership-stat-icon">₹</div>

                <p class="membership-stat-label">
                    Collected This Month
                </p>

                <h2 class="membership-stat-value">
                    ₹<?php echo e(number_format((float)$monthlyRevenue, 2)); ?>

                </h2>
            </div>

            <div class="membership-card membership-stat">
                <div class="membership-stat-icon">◷</div>

                <p class="membership-stat-label">
                    Pending Payments
                </p>

                <h2 class="membership-stat-value">
                    <?php echo e(number_format($pendingApprovals)); ?>

                </h2>
            </div>

            <div class="membership-card membership-stat">
                <div class="membership-stat-icon">↶</div>

                <p class="membership-stat-label">
                    Refund Requests
                </p>

                <h2 class="membership-stat-value"
                    style="font-size:18px">
                    <?php echo e($refundRequests === null ? 'Not configured' : number_format($refundRequests)); ?>

                </h2>
            </div>

        </section>

        
        <section>

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <h2 class="membership-section-title">
                    Membership Plans
                </h2>

                <button
                    type="button"
                    class="membership-btn membership-btn-primary"
                    id="addPlanButton"
                    data-bs-toggle="modal"
                    data-bs-target="#planModal">
                    ＋ Add Custom Package
                </button>

            </div>

            <div class="membership-plans">

                <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <article class="membership-card membership-plan">

                        <div>
                            <div class="membership-plan-top">

                                <div class="membership-plan-icon">
                                    ♡
                                </div>

                                <div>
                                    <h3 class="membership-plan-name">
                                        <?php echo e($plan->plan_name); ?>

                                    </h3>

                                    <p class="membership-plan-price">
                                        ₹<?php echo e(number_format((float)($plan->amount ?? 0), 2)); ?>


                                        <span class="text-muted fw-normal"
                                              style="font-size:11px">
                                            / <?php echo e($plan->validity_days ?? 0); ?> days
                                        </span>
                                    </p>
                                </div>

                            </div>

                            <div class="membership-plan-desc">
                                <?php echo nl2br(e($plan->features ?: 'No features added yet.')); ?>

                            </div>
                        </div>

                        <button
                            type="button"
                            class="membership-btn w-100 edit-plan-button"
                            data-id="<?php echo e($plan->id); ?>"
                            data-name="<?php echo e($plan->plan_name); ?>"
                            data-amount="<?php echo e($plan->amount ?? 0); ?>"
                            data-days="<?php echo e($plan->validity_days ?? 30); ?>"
                            data-features="<?php echo e($plan->features ?? ''); ?>"
                            data-bs-toggle="modal"
                            data-bs-target="#planModal">

                            Edit Plan

                        </button>

                    </article>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                    <div class="membership-card p-4 text-muted">
                        No membership plans found. Click
                        “Add Custom Package” to create the first plan.
                    </div>

                <?php endif; ?>

            </div>
        </section>

        
        <section class="membership-card membership-table-card">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <div>
                    <h2 class="membership-section-title mb-1">
                        Recent Transactions
                    </h2>

                    <p class="text-muted mb-0" style="font-size:11px">
                        Membership subscription records from the database.
                    </p>
                </div>

                <a
                    href="<?php echo e(route('admin.membership.export', request()->query())); ?>"
                    class="membership-btn">
                    ⇩ Export Statement
                </a>

            </div>

            <div class="membership-table-wrap">

                <table class="membership-table">

                    <thead>
                        <tr>
                            <th>TXN / INVOICE ID</th>
                            <th>MEMBER DETAILS</th>
                            <th>PLAN</th>
                            <th>PAYMENT MODE</th>
                            <th>DATE</th>
                            <th>AMOUNT</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <?php
                                $statusText = $transaction->payment_status
                                    ?: ($transaction->status ?? 'Unknown');

                                $statusLower = strtolower((string)$statusText);

                                $statusClass = in_array(
                                    $statusLower,
                                    ['pending', 'processing', 'initiated']
                                )
                                    ? 'pending'
                                    : (
                                        in_array(
                                            $statusLower,
                                            ['paid', 'success', 'completed', 'successful']
                                        )
                                            ? ''
                                            : 'other'
                                    );
                            ?>

                            <tr>

                                <td class="membership-txn">
                                    <?php echo e($transaction->transaction_id ?: ('SUB-' . $transaction->id)); ?>

                                </td>

                                <td>
                                    <div class="fw-bold text-dark">
                                        <?php echo e($transaction->member_name ?: 'Unknown member'); ?>

                                    </div>

                                    <small class="text-muted">
                                        <?php echo e($transaction->profile_id ?: ('User #' . ($transaction->user_id ?? 'N/A'))); ?>

                                    </small>
                                </td>

                                <td>
                                    <?php echo e($transaction->plan_name ?: 'Plan not found'); ?>

                                </td>

                                <td>
                                    Not recorded
                                </td>

                                <td>
                                    <?php if($transaction->created_at): ?>
                                        <?php echo e(\Carbon\Carbon::parse($transaction->created_at)->format('d M Y, h:i A')); ?>

                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>

                                <td class="fw-bold text-dark">
                                    ₹<?php echo e(number_format((float)($transaction->amount ?? 0), 2)); ?>

                                </td>

                                <td>
                                    <span class="membership-status <?php echo e($statusClass); ?>">
                                        <?php echo e(ucfirst((string)$statusText)); ?>

                                    </span>
                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <tr>
                                <td colspan="7"
                                    class="text-center py-4 text-muted">
                                    No transactions found.
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

            
            <div class="membership-pagination">

                <small class="text-muted">
                    Showing
                    <?php echo e($transactions->firstItem() ?? 0); ?>–<?php echo e($transactions->lastItem() ?? 0); ?>

                    of <?php echo e($transactions->total()); ?> transactions
                </small>

                <?php echo e($transactions->withQueryString()->links()); ?>


            </div>

        </section>

    </main>
</div>


<div
    class="modal fade"
    id="planModal"
    tabindex="-1"
    aria-labelledby="planModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">

            <form
                id="planForm"
                method="POST"
                action="<?php echo e(route('admin.membership.plans.store')); ?>">

                <?php echo csrf_field(); ?>

                <input
                    type="hidden"
                    name="_method"
                    id="planMethod"
                    value="POST">

                <div class="modal-header border-0 px-4 pt-4">

                    <h5
                        class="modal-title fw-bold"
                        id="planModalLabel"
                        style="color:#561325">

                        Add Membership Plan

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>

                </div>

                <div class="modal-body px-4">

                    <div class="mb-3">

                        <label
                            for="planName"
                            class="form-label fw-semibold">

                            Plan name

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="planName"
                            name="plan_name"
                            maxlength="100"
                            required>

                    </div>

                    <div class="row g-3">

                        <div class="col-sm-6">

                            <label
                                for="planAmount"
                                class="form-label fw-semibold">

                                Price (₹)

                            </label>

                            <input
                                type="number"
                                class="form-control"
                                id="planAmount"
                                name="amount"
                                min="0"
                                step="0.01"
                                required>

                        </div>

                        <div class="col-sm-6">

                            <label
                                for="planDays"
                                class="form-label fw-semibold">

                                Validity (days)

                            </label>

                            <input
                                type="number"
                                class="form-control"
                                id="planDays"
                                name="validity_days"
                                min="1"
                                max="36500"
                                required>

                        </div>

                    </div>

                    <div class="mt-3">

                        <label
                            for="planFeatures"
                            class="form-label fw-semibold">

                            Plan features / highlights

                        </label>

                        <textarea
                            class="form-control"
                            id="planFeatures"
                            name="features"
                            rows="4"
                            placeholder="Enter plan features"></textarea>

                    </div>

                </div>

                <div class="modal-footer border-0 px-4 pb-4">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="btn text-white"
                        style="background:#561325">

                        Save Plan

                    </button>

                </div>

            </form>

        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('planForm');
    const modal = document.getElementById('planModal');
    const method = document.getElementById('planMethod');
    const title = document.getElementById('planModalLabel');

    const storeUrl = "<?php echo e(route('admin.membership.plans.store')); ?>";
    const updateBaseUrl = "<?php echo e(url('/admin/membership/plans')); ?>";

    // Add new plan
    document.getElementById('addPlanButton').addEventListener('click', function () {

        form.reset();

        form.action = storeUrl;
        method.value = 'POST';

        title.textContent = 'Add Membership Plan';
    });

    // Edit existing plan
    document.querySelectorAll('.edit-plan-button').forEach(function (button) {

        button.addEventListener('click', function () {

            form.action = updateBaseUrl + '/' + this.dataset.id;
            method.value = 'PUT';

            document.getElementById('planName').value =
                this.dataset.name || '';

            document.getElementById('planAmount').value =
                this.dataset.amount || '0';

            document.getElementById('planDays').value =
                this.dataset.days || '30';

            document.getElementById('planFeatures').value =
                this.dataset.features || '';

            title.textContent = 'Edit Membership Plan';

        });

    });

});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\genZ-matrimonial\backend\resources\views\admin\membership.blade.php ENDPATH**/ ?>