<?php
$avatarPath = ! empty($user['avatar'])
    ? 'uploads/avatars/' . $user['avatar']
    : 'uploads/avatars/placeholder.svg';
?>

<section class="user-form-section">
    <div class="form-card">
        <p class="page-label">USER MANAGEMENT</p>
        <h1>Edit User</h1>

        <p class="page-description">
            Update the user’s information and optionally upload a new avatar.
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

        <div class="current-avatar">
            <img
                src="<?= base_url($avatarPath) ?>"
                alt="Current avatar of <?= esc($user['full_name']) ?>"
            >
            <span>Current profile picture</span>
        </div>

        <form
            action="<?= site_url('users/' . $user['id'] . '/update') ?>"
            method="post"
            enctype="multipart/form-data"
        >
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="username">Username *</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="<?= old('username', $user['username']) ?>"
                    maxlength="50"
                >
            </div>

            <div class="form-group">
                <label for="full_name">Full Name *</label>
                <input
                    type="text"
                    id="full_name"
                    name="full_name"
                    value="<?= old('full_name', $user['full_name']) ?>"
                    maxlength="100"
                >
            </div>

            <div class="form-group">
                <label for="avatar">Profile Picture</label>
                <input
                    type="file"
                    id="avatar"
                    name="avatar"
                    accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                >
                <small>
                    Optional. Upload a JPG or PNG image no larger than 2 MB.
                </small>
            </div>

            <div class="form-actions">
                <button type="submit" class="submit-button">
                    Update User
                </button>

                <a href="<?= site_url('users') ?>" class="cancel-button">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</section>

<style>
    .user-form-section {
        max-width: 800px;
        margin: 45px auto;
        padding: 0 20px;
    }

    .form-card {
        padding: 34px;
        border-radius: 12px;
        background: #ffffff;
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
        margin-bottom: 24px;
        color: #555555;
    }

    .validation-errors {
        margin-bottom: 24px;
        padding: 16px 20px;
        border-left: 4px solid #b42318;
        background: #fef3f2;
        color: #7a271a;
    }

    .current-avatar {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 26px;
    }

    .current-avatar img {
        width: 90px;
        height: 90px;
        border: 2px solid #dddddd;
        border-radius: 50%;
        object-fit: cover;
    }

    .current-avatar span,
    .form-group small {
        color: #666666;
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

    .form-group small {
        display: block;
        margin-top: 7px;
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