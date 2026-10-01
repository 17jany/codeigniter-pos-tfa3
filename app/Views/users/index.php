<section class="table-section">
    <div class="page-heading">
        <div>
            <p class="eyebrow">STAFF DIRECTORY</p>

            <h1>User Accounts</h1>

            <p class="subtitle">
                A list of staff accounts stored in the POS system database.
            </p>
        </div>

        <a href="<?= site_url('users/new') ?>" class="add-button">
            Add New User
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="success-message">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <p class="record-count">
        <?= count($users) ?> staff accounts found
    </p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Avatar</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php if (! empty($users)): ?>
                <?php foreach ($users as $index => $user): ?>
                    <?php
                    $avatarPath = ! empty($user['avatar'])
                        ? 'uploads/avatars/' . $user['avatar']
                        : 'uploads/avatars/placeholder.svg';
                    ?>

                    <tr>
                        <td class="number">
                            <?= $index + 1 ?>
                        </td>

                        <td>
                            <img
                                src="<?= base_url($avatarPath) ?>"
                                alt="Avatar of <?= esc($user['full_name']) ?>"
                                class="avatar-image"
                            >
                        </td>

                        <td>
                            <?= esc($user['username']) ?>
                        </td>

                        <td>
                            <?= esc($user['full_name']) ?>
                        </td>

                        <td>
                            <a
                                href="<?= site_url('users/' . $user['id'] . '/edit') ?>"
                                class="edit-button"
                            >
                                Edit
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td class="empty-message" colspan="5">
                        No staff accounts are available.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<style>
    .page-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 20px;
    }

    .avatar-image {
        display: block;
        width: 55px;
        height: 55px;
        border: 2px solid #dddddd;
        border-radius: 50%;
        object-fit: cover;
    }

    .add-button,
    .edit-button {
        display: inline-block;
        border-radius: 6px;
        background: #151515;
        color: #ffffff;
        text-decoration: none;
    }

    .add-button {
        padding: 12px 18px;
        white-space: nowrap;
    }

    .edit-button {
        padding: 8px 14px;
        font-size: 14px;
    }

    .success-message {
        margin-bottom: 20px;
        padding: 14px 18px;
        border-left: 4px solid #15803d;
        background: #f0fdf4;
        color: #166534;
    }

    @media (max-width: 700px) {
        .page-heading {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>