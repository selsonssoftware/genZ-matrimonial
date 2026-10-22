
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card mx-auto shadow-sm" style="max-width: 500px;">
            <div class="card-body p-4">
                <h4 class="mb-3">Email Test</h4>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('mail-test.send') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Recipient Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="Enter email address"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Send Test Email
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
