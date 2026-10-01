<section class="table-section">
    <div class="page-heading">
        <div>
            <p class="eyebrow">CUSTOMER DIRECTORY</p>

            <h1>Customer Accounts</h1>

            <p class="subtitle">
                A directory of customer contact information retrieved from the POS system database.
            </p>
        </div>

        <a href="<?= site_url('customers/new') ?>" class="add-button">
            Add New Customer
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="success-message">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <p class="record-count">
        <?= count($customers) ?> customer records found
    </p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Full Name</th>
                <th>Email Address</th>
                <th>Phone Number</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php if (! empty($customers)): ?>
                <?php foreach ($customers as $index => $customer): ?>
                    <tr>
                        <td class="number"><?= $index + 1 ?></td>
                        <td><?= esc($customer['full_name']) ?></td>
                        <td><?= esc($customer['email']) ?></td>
                        <td><?= esc($customer['phone']) ?></td>
                        <td>
                            <a
                                href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>"
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
                        No customer records are available.
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