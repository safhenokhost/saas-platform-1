<h1>COMPLETE PROFILE</h1>

<form id="completeProfileForm">
    @csrf

    <input type="text" name="name" placeholder="نام کامل" required>
    <button type="submit">ذخیره</button>
</form>

<script>
document.getElementById('completeProfileForm').addEventListener('submit', function (e) {
    e.preventDefault();

    fetch('/complete-profile', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            name: this.name.value
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'ok') {
            location.reload();
        }
    });
});
</script>
