
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Store Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
        My Store Admin
    </a>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm">
        Dashboard
    </a>
</nav>

<div class="container py-5">
    <div class="card border-0 shadow-sm mx-auto" style="max-width:650px;">
        <div class="card-body p-4">

            <h2 class="mb-2">Store Settings</h2>
            <p class="text-muted mb-4">
                Manage your store WhatsApp contact number.
            </p>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label fw-bold">
                        WhatsApp Number
                    </label>

                    <input
                        type="text"
                        name="whatsapp_number"
                        class="form-control form-control-lg"
                        value="{{ old('whatsapp_number', $settings->whatsapp_number) }}"
                        placeholder="212600000000"
                        required
                    >

                    <small class="text-muted">
                        Use international format without + or spaces.
                        Example: 212600000000
                    </small>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    Save Settings
                </button>
            </form>

        </div>
    </div>
</div>

</body>
</html>