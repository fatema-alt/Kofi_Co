<?= view('layouts/header') ?>
<?= view('layouts/sidebar') ?>

<main class="main-content">
    <div class="page-header">
        <div>
            <span class="eyebrow">Inventory</span>
            <h1>Vendors</h1>
        </div>

        <a href="<?= base_url('admin/vendors/create') ?>" class="btn-add">+ Add Vendor</a>
    </div>

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($vendors as $vendor): ?>
                    <tr>
                        <td><?= esc($vendor['name']) ?></td>
                        <td><?= esc($vendor['contact_person']) ?></td>
                        <td><?= esc($vendor['phone']) ?></td>
                        <td>
                            <span class="<?= $vendor['status'] ? 'status-active' : 'status-inactive' ?>">
                                <?= $vendor['status'] ? 'Active' : 'Inactive' ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/vendors/edit/'.$vendor['id']) ?>" class="btn-edit">Edit</a>
                            <a href="<?= base_url('admin/vendors/delete/'.$vendor['id']) ?>"
                               onclick="return confirm('Delete this vendor?')"
                               class="btn-delete">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>