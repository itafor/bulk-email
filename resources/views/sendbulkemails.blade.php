<!DOCTYPE html>
<html>

<head>
    <title>Send Multiple Emails</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Send Emails</h2>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('emails.send') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="subject" class="form-label">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>

            <div class="mb-3">
                <label for="body" class="form-label">Body:</label>
                <textarea class="form-control" id="body" name="body" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label for="emails" class="form-label">Emails (comma-separated):</label>
                <textarea class="form-control" id="emails" name="emails" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Attach Image (optional):</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Send Emails</button>
        </form>
    </div>
</body>

</html>