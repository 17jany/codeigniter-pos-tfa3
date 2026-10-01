<section class="customer-form-section">
    <div class="form-card">
        <p class="page-label">CUSTOMER MANAGEMENT</p>
        <h1>Add New Customer</h1>
        <p class="page-description">
            Enter the customer's information below. Fields marked with an asterisk (*) are required.
        </p>

        <?php $errors = session()->getFlashdata('errors'); ?>

        <?php if (! empty($errors)): ?>
            <div class="validation-errors">
                <strong>Please correct the following errors:</strong>

                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('customers/create') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="full_name">Full Name *</label>
                <input
                    type="text"
                    id="full_name"
                    name="full_name"
                    value="<?= old('full_name') ?>"
                    maxlength="100"
                >
            </div>

            <div class="form-group">
                <label for="email">Email Address *</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= old('email') ?>"
                    maxlength="100"
                >
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="<?= old('phone') ?>"
                    maxlength="20"
                >
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-button">
                    Save Customer
                </button>

                <a href="<?= site_url('customers') ?>" class="cancel-button">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</section>

<style>
    .customer-form-section {
        max-width: 800px;
        margin: 45px auto;
        padding: 0 20px;
    }

    .form-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 34px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    }

    .page-label {
        margin: 0 0 8px;
        font-size: 14px;
        letter-spacing: 2px;
    }

    .form-card h1 {
        margin: 0 0 10px;
        font-size: 36px;
    }

    .page-description {
        margin-bottom: 28px;
        color: #555555;
    }

    .validation-errors {
        margin-bottom: 24px;
        padding: 16px 20px;
        border-left: 4px solid #b42318;
        background: #fef3f2;
        color: #7a271a;
    }

    .validation-errors ul {
        margin-bottom: 0;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 7px;
        font-weight: 600;
    }

    .form-group input {
        box-sizing: border-box;
        width: 100%;
        padding: 12px;
        border: 1px solid #cccccc;
        border-radius: 6px;
        font-size: 16px;
    }

    .form-group input:focus {
        border-color: #111111;
        outline: none;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 28px;
    }

    .submit-button,
    .cancel-button {
        padding: 12px 20px;
        border-radius: 6px;
        font-size: 15px;
        text-decoration: none;
        cursor: pointer;
    }

    .submit-button {
        border: none;
        background: #151515;
        color: #ffffff;
    }

    .cancel-button {
        border: 1px solid #bbbbbb;
        background: #ffffff;
        color: #151515;
    }
</style>