@extends('layout')

@section('content')

    <div class="page-content">
        <div class="admin-edit-wrapper">

            {{-- Page Header --}}
            <div class="edit-page-header">
                <div class="header-left">
                    <div class="header-icon">
                        <i class="ti ti-user-edit"></i>
                    </div>

                    <div>
                        <h3>Edit Admin</h3>
                        <p>Manage and update administrator details</p>
                    </div>
                </div>

                <a href="{{ route('admins.index') }}" class="back-btn">
                    <i class="ti ti-arrow-left"></i>
                    <span>Back to Admins</span>
                </a>
            </div>

            {{-- Breadcrumb --}}
            <div class="breadcrumb-area">
                <a href="{{ route('admins.index') }}">Admin Management</a>
                <i class="ti ti-chevron-right"></i>
                <span>Edit Admin</span>
            </div>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="custom-alert error-alert">
                    <i class="ti ti-alert-circle"></i>
                    <div>
                        <strong>Please check the following errors</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Success Message --}}
            @if (session('success'))
                <div class="custom-alert success-alert">
                    <i class="ti ti-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Main Edit Card --}}
            <div class="edit-card">

                <div class="card-heading">
                    <div>
                        <h5>Administrator Information</h5>
                        <p>Update the details below and save your changes.</p>
                    </div>

                    <span class="admin-badge">
                        <i class="ti ti-shield-check"></i>
                        Administrator
                    </span>
                </div>

                <div class="card-divider"></div>

                <form action="{{ route('admins.update', $admin->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="form-section-title">
                        <i class="ti ti-user-circle"></i>
                        Personal Details
                    </div>

                    <div class="form-grid">

                        {{-- Admin Name --}}
                        <div class="form-group">
                            <label for="name">
                                Admin Name <span class="required">*</span>
                            </label>

                            <div class="input-wrapper">
                                <i class="ti ti-user input-icon"></i>

                                <input type="text" id="name" name="name" class="custom-input" placeholder="Enter admin name"
                                    value="{{ old('name', $admin->name) }}" maxlength="255" required>
                            </div>

                            @error('name')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label for="email">
                                Email Address <span class="required">*</span>
                            </label>

                            <div class="input-wrapper">
                                <i class="ti ti-mail input-icon"></i>

                                <input type="text" id="email" name="email" class="custom-input"
                                    placeholder="Enter email address" value="{{ old('email', $admin->email) }}"
                                    maxlength="255">
                            </div>

                            @error('email')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="password">New Password</label>

                            <div class="input-wrapper">
                                <i class="ti ti-lock input-icon"></i>

                                <input type="password" id="password" name="password" class="custom-input"
                                    placeholder="Enter new password" autocomplete="new-password">
                            </div>

                            <small class="field-hint">
                                Leave blank to keep the existing password unchanged.
                                Minimum 8 characters.
                            </small>

                            @error('password')
                                <small class="field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>

                            <div class="input-wrapper">
                                <i class="ti ti-lock-check input-icon"></i>

                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="custom-input" placeholder="Confirm new password" autocomplete="new-password">
                            </div>
                        </div>


                    </div>



                    {{-- Footer Buttons --}}
                    <div class="form-footer">

                        <a href="{{ route('admins.index') }}" class="cancel-btn">
                            <i class="ti ti-x"></i>
                            Cancel
                        </a>

                        <button type="submit" class="save-btn">
                            <i class="ti ti-device-floppy"></i>
                            Save Changes
                        </button>

                    </div>

                </form>
            </div>

            <div class="page-footer-note">
                <i class="ti ti-shield-check"></i>
                Admin account management
            </div>

        </div>
    </div>

    <style>
        /* Main Content */
        .page-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-width: 0;
            padding: 25px;
            box-sizing: border-box;
            min-height: 100vh;
            background: #f5f7fb;
            overflow-x: hidden;
        }

        .admin-edit-wrapper {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            color: #263247;
        }

        /* Header */
        .edit-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-icon {
            width: 58px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            background: linear-gradient(135deg, #e5edff, #dbeafe);
            color: #3157b7;
            font-size: 28px;
            flex-shrink: 0;
        }

        .header-left h3 {
            margin: 0 0 6px;
            font-size: 25px;
            font-weight: 750;
            color: #17243a;
            letter-spacing: -0.5px;
        }

        .header-left p {
            margin: 0;
            font-size: 14px;
            color: #7b8799;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 17px;
            background: #fff;
            border: 1px solid #dfe5ee;
            border-radius: 10px;
            color: #344054;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .back-btn:hover {
            background: #eef3ff;
            color: #3157b7;
            border-color: #c7d5ff;
            transform: translateY(-1px);
        }

        /* Breadcrumb */
        .breadcrumb-area {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 22px;
            font-size: 13px;
            color: #8a94a6;
        }

        .breadcrumb-area a {
            color: #4567c7;
            text-decoration: none;
            font-weight: 600;
        }

        .breadcrumb-area a:hover {
            text-decoration: underline;
        }

        /* Main Card */
        .edit-card {
            background: #fff;
            border: 1px solid #e9edf4;
            border-radius: 17px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(30, 45, 75, 0.045);
        }

        .card-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
            padding: 25px 28px;
        }

        .card-heading h5 {
            margin: 0 0 7px;
            color: #202d43;
            font-size: 18px;
            font-weight: 700;
        }

        .card-heading p {
            margin: 0;
            color: #8791a2;
            font-size: 13px;
        }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #eaf8ef;
            color: #21834b;
            border: 1px solid #ccebd7;
            border-radius: 30px;
            padding: 8px 13px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .admin-badge i {
            font-size: 16px;
        }

        .card-divider {
            height: 1px;
            background: #edf0f5;
        }

        /* Form */
        .edit-card form {
            padding: 28px;
        }

        .form-section-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 23px;
            color: #263b62;
            font-size: 15px;
            font-weight: 700;
        }

        .form-section-title i {
            font-size: 21px;
            color: #4567c7;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 25px 24px;
        }

        .form-group {
            min-width: 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 9px;
            color: #39465a;
            font-size: 13px;
            font-weight: 650;
        }

        .required {
            color: #e5484d;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            z-index: 1;
            font-size: 19px;
            color: #8a96aa;
            pointer-events: none;
        }

        .custom-input {
            width: 100%;
            height: 48px;
            box-sizing: border-box;
            padding: 0 42px 0 43px;
            border: 1px solid #dfe5ee;
            border-radius: 10px;
            outline: none;
            background: #fff;
            color: #263247;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .custom-input::placeholder {
            color: #a2abba;
        }

        .custom-input:focus {
            border-color: #5878d5;
            box-shadow: 0 0 0 4px rgba(69, 103, 199, 0.10);
        }

        .readonly-input {
            background: #f5f7fa;
            color: #748096;
            cursor: not-allowed;
        }

        .role-lock {
            position: absolute;
            right: 14px;
            color: #9ba5b5;
            font-size: 17px;
            pointer-events: none;
        }

        .field-hint {
            display: block;
            margin-top: 7px;
            color: #8b95a6;
            font-size: 11px;
            line-height: 1.5;
        }

        .field-error {
            display: block;
            margin-top: 7px;
            color: #d92d38;
            font-size: 12px;
        }

        /* Information Notice */
        .info-note {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            margin-top: 28px;
            padding: 15px 17px;
            border: 1px solid #dce7ff;
            border-radius: 10px;
            background: #f4f7ff;
            color: #50648f;
            font-size: 12px;
            line-height: 1.7;
        }

        .info-note i {
            flex-shrink: 0;
            color: #4567c7;
            font-size: 19px;
        }

        /* Buttons */
        .form-footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid #edf0f5;
        }

        .cancel-btn,
        .save-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 44px;
            padding: 11px 19px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 650;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .cancel-btn {
            background: #fff;
            border: 1px solid #dfe5ee;
            color: #536176;
        }

        .cancel-btn:hover {
            background: #f5f7fa;
            color: #263247;
            border-color: #c8d0dc;
        }

        .save-btn {
            background: #3157b7;
            border: 1px solid #3157b7;
            color: #fff;
        }

        .save-btn:hover {
            background: #244697;
            border-color: #244697;
            box-shadow: 0 5px 14px rgba(49, 87, 183, 0.20);
            transform: translateY(-1px);
        }

        .cancel-btn i,
        .save-btn i {
            font-size: 17px;
        }

        /* Alerts */
        .custom-alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 15px 18px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-size: 13px;
        }

        .custom-alert>i {
            font-size: 21px;
            flex-shrink: 0;
        }

        .error-alert {
            background: #fff2f1;
            border: 1px solid #ffd3d0;
            color: #b42318;
        }

        .success-alert {
            background: #ecfdf3;
            border: 1px solid #c8f0d5;
            color: #187747;
        }

        .error-alert ul {
            margin: 8px 0 0;
            padding-left: 18px;
        }

        .error-alert li {
            margin-bottom: 4px;
        }

        .page-footer-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            margin-top: 22px;
            color: #929bad;
            font-size: 12px;
        }

        .page-footer-note i {
            font-size: 16px;
            color: #5d79c8;
        }

        /* Tablet */
        @media (max-width: 991px) {
            .page-content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }
        }

        /* Mobile */
        @media (max-width: 576px) {
            .page-content {
                padding: 13px;
            }

            .edit-page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .header-left h3 {
                font-size: 21px;
            }

            .header-icon {
                width: 48px;
                height: 48px;
                font-size: 23px;
            }

            .back-btn {
                width: 100%;
                box-sizing: border-box;
            }

            .card-heading {
                padding: 20px;
            }

            .edit-card form {
                padding: 20px;
            }

            .form-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 21px;
            }

            .form-footer {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .cancel-btn,
            .save-btn {
                width: 100%;
                box-sizing: border-box;
            }
        }
    </style>

@endsection