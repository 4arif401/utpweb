<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — UTPWeb</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --navy: #0d1b3e;
            --gold: #c9a227;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0d1b3e 0%, #1a2f5a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 20px 60px rgba(0,0,0,.35);
            overflow: hidden;
            width: 420px;
            max-width: 95vw;
        }
        .login-header {
            background: var(--navy);
            color: #fff;
            padding: 2rem;
            text-align: center;
        }
        .login-header .brand {
            font-size: 1.8rem;
            font-weight: 700;
        }
        .login-header .brand span { color: var(--gold); }
        .login-header p { color: rgba(255,255,255,.6); font-size: .85rem; margin: .25rem 0 0; }
        .login-body { padding: 2rem; }
        .form-label { font-weight: 500; font-size: .88rem; color: var(--navy); }
        .form-control { border-radius: 8px; border-color: #dde; padding: .6rem .9rem; }
        .form-control:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,162,39,.15); }
        .btn-login {
            background: var(--navy);
            color: #fff;
            border: none;
            border-radius: 8px;
            width: 100%;
            padding: .7rem;
            font-weight: 600;
            font-size: .95rem;
            transition: background .2s;
        }
        .btn-login:hover { background: var(--gold); color: #fff; }
        .back-link { text-align: center; margin-top: 1rem; font-size: .82rem; }
        .back-link a { color: var(--gold); text-decoration: none; }
        .invalid-feedback { font-size: .8rem; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <div class="brand"><span>UTP</span>Web</div>
            <p><i class="fa fa-lock me-1"></i> Admin Portal</p>
        </div>
        <div class="login-body">
            @if($errors->any())
                <div class="alert alert-danger py-2 mb-3" style="font-size:.84rem;">
                    <i class="fa fa-exclamation-circle me-1"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email') }}" required autofocus
                           placeholder="admin@utpweb.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required
                           placeholder="••••••••">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember" style="font-size:.85rem;">Remember me</label>
                </div>
                <button type="submit" class="btn-login">
                    <i class="fa fa-sign-in-alt me-1"></i> Login
                </button>
            </form>

            <div class="back-link">
                <a href="{{ route('academics.index') }}"><i class="fa fa-arrow-left me-1"></i>Back to Scholars Directory</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
