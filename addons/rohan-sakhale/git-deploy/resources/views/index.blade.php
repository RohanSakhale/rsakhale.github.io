@extends('statamic::layout')

@section('content')
    <h1>Deploy Changes</h1>
    <p>Click the button below to push all changes to Git.</p>

    <button class="btn-primary" id="deploy-btn">Deploy</button>

    <p id="deploy-message" class="success" style="display: none;"></p>
    <p id="deploy-error" class="error" style="display: none;"></p>

    <script>
        document.getElementById("deploy-btn").addEventListener("click", function () {
            fetch('/cp/git-deploy/push', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    document.getElementById("deploy-message").textContent = data.message;
                    document.getElementById("deploy-message").style.display = "block";
                    document.getElementById("deploy-error").style.display = "none";
                } else {
                    document.getElementById("deploy-error").textContent = data.error;
                    document.getElementById("deploy-error").style.display = "block";
                    document.getElementById("deploy-message").style.display = "none";
                }
            })
            .catch(error => {
                document.getElementById("deploy-error").textContent = "Something went wrong!";
                document.getElementById("deploy-error").style.display = "block";
                document.getElementById("deploy-message").style.display = "none";
            });
        });
    </script>
@endsection
