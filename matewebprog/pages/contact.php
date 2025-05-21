<h2>Kapcsolat</h2>
<p>Kérlek töltsd ki az alábbi űrlapot!</p>

<form action="form_handler.php" method="POST" id="contactForm" novalidate>
    <div class="mb-3">
        <label for="name" class="form-label">Név *</label>
        <input type="text" class="form-control" id="name" name="name" required>
        <div class="invalid-feedback">A név megadása kötelező.</div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email cím *</label>
        <input type="email" class="form-control" id="email" name="email" required>
        <div class="invalid-feedback">Adj meg egy érvényes email címet.</div>
    </div>
    <div class="mb-3">
        <label for="subject" class="form-label">Tárgy</label>
        <input type="text" class="form-control" id="subject" name="subject">
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Üzenet *</label>
        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        <div class="invalid-feedback">Az üzenet nem lehet üres.</div>
    </div>
    <button type="submit" class="btn btn-primary">Küldés</button>
</form>

<script>
    (() => {
        const form = document.getElementById('contactForm');
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    })();
</script>