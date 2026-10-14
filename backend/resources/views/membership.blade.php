@extends('layout')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership & Payments</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f7f3f3;
            font-family: 'Inter', sans-serif;
            color: #542432;
            font-size: 12px;
        }

        .dashboard {
            width: 100%;
            min-height: 100vh;
            background: #f7f3f3;
        }

        /* Header */
        .top-header {
            min-height: 74px;
            background: #fff;
            padding: 17px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .page-title {
            font-size: 21px;
            font-weight: 800;
            margin: 0 0 4px;
            color: #51202f;
        }

        .page-subtitle {
            font-size: 11px;
            color: #968990;
            margin: 0;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .search-btn,
        .notification-btn {
            height: 34px;
            border: 1px solid #eee5e8;
            background: #f8f5f5;
            border-radius: 9px;
            color: #76656d;
            padding: 0 16px;
            font-size: 11px;
        }

        .notification-btn {
            width: 34px;
            padding: 0;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .admin-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f6e9ed;
            color: #682e41;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
        }

        .admin-name {
            font-size: 11px;
            font-weight: 700;
            color: #35242b;
        }

        .admin-role {
            font-size: 9px;
            color: #978a90;
            margin-top: 3px;
        }

        /* Main content */
        .main-content {
            padding: 26px 22px 34px;
        }

        /* Statistics */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 17px;
        }

        .stat-card {
            height: 93px;
            padding: 13px 14px;
            background: #fff;
            border: 1px solid #eee4e7;
            border-radius: 13px;
            position: relative;
        }

        .stat-icon {
            width: 34px;
            height: 34px;
            border-radius: 11px;
            background: #f7e9ed;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .icon-green {
            color: #379b83;
        }

        .icon-blue {
            color: #6487cb;
        }

        .icon-orange {
            color: #c98a23;
        }

        .icon-red {
            color: #8d334c;
        }

        .stat-label {
            color: #8c8087;
            font-size: 11px;
            margin: 0;
        }

        .stat-value {
            color: #542032;
            font-size: 23px;
            line-height: 1.1;
            font-weight: 800;
            margin: 3px 0 0;
        }

        .stat-change {
            position: absolute;
            top: 77px;
            left: 14px;
            font-size: 9px;
            color: #349b7e;
        }

        /* Section titles */
        .section-title {
            font-size: 16px;
            font-weight: 800;
            color: #572332;
            margin: 0 0 10px;
        }

        /* Membership plans */
        .plans-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .plan-card {
            background: #fff;
            border: 1px solid #eadfe3;
            border-radius: 13px;
            min-height: 109px;
            padding: 12px 13px 8px;
        }

        .plan-top {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .plan-icon {
            width: 39px;
            height: 39px;
            flex-shrink: 0;
            border-radius: 11px;
            background: #f7e9ed;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #81364b;
            font-size: 15px;
        }

        .plan-name {
            font-size: 14px;
            font-weight: 800;
            color: #572332;
            margin-bottom: 5px;
        }

        .plan-price {
            font-size: 15px;
            font-weight: 800;
            color: #702c43;
        }

        .plan-description {
            font-size: 9px;
            color: #8b7e85;
            margin: 13px 0 3px;
        }

        .edit-plan-btn {
            display: inline-block;
            min-width: 94px;
            padding: 4px 12px;
            border: none;
            border-radius: 7px;
            background: #f6e7eb;
            color: #80354a;
            font-size: 10px;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }

        .edit-plan-btn:hover {
            background: #ead1d9;
            color: #572332;
        }

        /* Transactions */
        .transactions-card {
            background: #fff;
            border: 1px solid #eadfe3;
            border-radius: 13px;
            padding: 16px;
            min-height: 339px;
        }

        .transactions-title {
            font-size: 15px;
            font-weight: 800;
            margin: 0 0 7px;
            color: #572332;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #eee4e7;
            border-radius: 11px;
        }

        .transactions-table {
            width: 100%;
            min-width: 650px;
            border-collapse: separate;
            border-spacing: 0;
            margin: 0;
        }

        .transactions-table thead th {
            background: #f8f2f4;
            color: #603344;
            font-size: 10px;
            font-weight: 800;
            padding: 11px 8px;
            text-align: left;
            white-space: nowrap;
            border: none;
        }

        .transactions-table tbody td {
            padding: 21px 8px;
            font-size: 10px;
            color: #665b61;
            border-bottom: 1px solid #eee4e7;
            white-space: nowrap;
        }

        .transactions-table tbody tr:last-child td {
            border-bottom: none;
        }

        .transaction-id {
            color: #713348 !important;
            font-weight: 800;
        }

        .status {
            font-size: 10px;
            font-weight: 500;
        }

        .status-success {
            color: #399b82;
        }

        .status-pending {
            color: #c88b32;
        }

        .status-refund {
            color: #c18a39;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .top-header {
                padding: 15px;
                align-items: flex-start;
            }

            .page-title {
                font-size: 17px;
            }

            .header-actions {
                gap: 7px;
            }

            .search-btn {
                padding: 0 8px;
            }

            .admin-role {
                display: none;
            }

            .main-content {
                padding: 18px 15px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px;
            }

            .plans-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .transactions-card {
                padding: 12px;
            }
        }

        @media (max-width: 420px) {
            .top-header {
                flex-wrap: wrap;
            }

            .header-actions {
                width: 100%;
                justify-content: flex-end;
            }

            .stat-value {
                font-size: 20px;
            }

            .stat-card {
                padding: 12px;
            }
        }
    </style>
</head>

<body>

<div class="dashboard">

    <!-- Header -->
    <header class="top-header">

        <div>
            <h1 class="page-title">Membership &amp; Payments</h1>
            <p class="page-subtitle">
                Manage plans, transactions, renewals and vendor commission.
            </p>
        </div>

        <div class="header-actions">

            <button type="button" class="search-btn"
                    onclick="document.getElementById('transactionSearch').focus()">
                &#9906; Search
            </button>

            <button type="button" class="notification-btn"
                    aria-label="Notifications">
                ♧
            </button>

            <div class="admin-profile">
                <div class="admin-avatar">AJ</div>

                <div>
                    <div class="admin-name">Admin</div>
                    <div class="admin-role">Super Admin</div>
                </div>
            </div>

        </div>
    </header>


    <!-- Main content -->
    <main class="main-content">

        <!-- Statistics cards -->
        <section class="stats-grid">

            <div class="stat-card">
                <div class="stat-icon icon-green">✦</div>
                <p class="stat-label">Active subscriptions</p>
                <h2 class="stat-value">3,482</h2>
                <span class="stat-change">+6.9%</span>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-blue">✦</div>
                <p class="stat-label">Collected this month</p>
                <h2 class="stat-value">₹4.82L</h2>
                <span class="stat-change">+15.2%</span>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-orange">✦</div>
                <p class="stat-label">Pending payments</p>
                <h2 class="stat-value">62</h2>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-orange">✦</div>
                <p class="stat-label">Refund requests</p>
                <h2 class="stat-value">8</h2>
                <span class="stat-change"
                      style="color:#c18a39;">Needs review</span>
            </div>

        </section>


        <!-- Membership plans -->
        <section class="membership-section">

            <h2 class="section-title">Membership Plans</h2>

            <div class="plans-grid">

                <!-- Basic plan -->
                <div class="plan-card">

                    <div class="plan-top">
                        <div class="plan-icon">✦</div>

                        <div>
                            <div class="plan-name">Basic</div>
                            <div class="plan-price">Free</div>
                        </div>
                    </div>

                    <p class="plan-description">
                        Profile creation · limited interests
                    </p>

                    <button type="button"
                            class="edit-plan-btn"
                            onclick="editPlan('Basic')">
                        Edit plan
                    </button>

                </div>


                <!-- Silver plan -->
                <div class="plan-card">

                    <div class="plan-top">
                        <div class="plan-icon">✦</div>

                        <div>
                            <div class="plan-name">Silver</div>
                            <div class="plan-price">₹999 / 3 mo</div>
                        </div>
                    </div>

                    <p class="plan-description">
                        More interests · profile boost
                    </p>

                    <button type="button"
                            class="edit-plan-btn"
                            onclick="editPlan('Silver')">
                        Edit plan
                    </button>

                </div>


                <!-- Gold plan -->
                <div class="plan-card">

                    <div class="plan-top">
                        <div class="plan-icon">✦</div>

                        <div>
                            <div class="plan-name">Gold</div>
                            <div class="plan-price">₹2,499 / 6 mo</div>
                        </div>
                    </div>

                    <p class="plan-description">
                        Premium discovery · priority support
                    </p>

                    <button type="button"
                            class="edit-plan-btn"
                            onclick="editPlan('Gold')">
                        Edit plan
                    </button>

                </div>

            </div>

        </section>


        <!-- Recent transactions -->
        <section class="transactions-card">

            <h2 class="transactions-title">Recent Transactions</h2>

            <div class="table-wrapper">

                <table class="transactions-table">

                    <thead>
                        <tr>
                            <th>TXN ID</th>
                            <th>USER ID</th>
                            <th>PLAN</th>
                            <th>DATE</th>
                            <th>AMOUNT</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>

                    <tbody id="transactionRows">

                        <tr>
                            <td class="transaction-id">TX-90182</td>
                            <td>TM-10481</td>
                            <td>Gold · 6 months</td>
                            <td>13 Oct 2026</td>
                            <td>₹2,499</td>
                            <td>
                                <span class="status status-success">
                                    Success
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td class="transaction-id">TX-90181</td>
                            <td>TM-10332</td>
                            <td>Silver · 3 months</td>
                            <td>13 Oct 2026</td>
                            <td>₹999</td>
                            <td>
                                <span class="status status-success">
                                    Success
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td class="transaction-id">TX-90180</td>
                            <td>TM-10298</td>
                            <td>Gold · 6 months</td>
                            <td>12 Oct 2026</td>
                            <td>₹2,499</td>
                            <td>
                                <span class="status status-pending">
                                    Pending
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td class="transaction-id">TX-90179</td>
                            <td>TM-10117</td>
                            <td>Silver · 3 months</td>
                            <td>12 Oct 2026</td>
                            <td>₹999</td>
                            <td>
                                <span class="status status-refund">
                                    Refund review
                                </span>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </section>

    </main>

</div>


<script>
    // Search transactions by any displayed text
    const searchButton = document.querySelector('.search-btn');

    searchButton.addEventListener('click', function () {
        const existingSearch = document.getElementById('transactionSearch');

        if (existingSearch) {
            existingSearch.focus();
            return;
        }

        const input = document.createElement('input');

        input.type = 'search';
        input.id = 'transactionSearch';
        input.placeholder = 'Search transactions...';
        input.className = 'form-control form-control-sm mt-2 mb-2';

        document.querySelector('.transactions-card')
            .insertBefore(
                input,
                document.querySelector('.table-wrapper')
            );

        input.focus();

        input.addEventListener('input', function () {
            const searchValue = this.value.toLowerCase();

            document.querySelectorAll('#transactionRows tr')
                .forEach(function (row) {
                    row.style.display = row.innerText
                        .toLowerCase()
                        .includes(searchValue) ? '' : 'none';
                });
        });
    });

    // Demo action: replace with your Laravel edit route or modal
    function editPlan(planName) {
        alert('Edit ' + planName + ' plan');
    }
</script>

</body>
</html>

@endsection