<?php $role = session()->get('user_role'); ?>
<aside class="sidebar">
    <nav class="sidebar-nav">

        <a href="<?= base_url('admin/dashboard') ?>" class="nav-item <?= uri_string() == 'admin/dashboard' ? 'active' : '' ?>">
            <span class="nav-icon">🏠</span>
            <span>Dashboard</span>
        </a>


<?php if (in_array($role, ['Admin', 'Manager', 'Cashier'])): ?>
     <a href="<?= base_url('admin/pos') ?>" 
   class="nav-item <?= strpos(uri_string(), 'admin/pos') !== false ? 'active' : '' ?>">
    <span class="nav-icon">🧾</span>
    <span>POS</span>
    </a>
    <a href="<?= base_url('admin/orders') ?>" class="nav-item <?= strpos(uri_string(), 'admin/orders') !== false ? 'active' : '' ?>">
    <span class="nav-icon">📦</span>
    <span>Orders</span>
</a>
<?php endif; ?>
   

<?php if (in_array($role, ['Admin', 'Manager'])): ?>
    <!-- Menu, Inventory, Vendors, Reports, Settings -->
      <div class="nav-dropdown">
    <button type="button" class="nav-item nav-toggle" id="menuToggle">
        <span class="nav-icon">🍽️</span>
        <span>Menu</span>
    </button>

    <div class="submenu" id="menuSubmenu">
        <a href="<?= base_url('admin/menu/categories') ?>" 
           class="nav-item sub <?= strpos(uri_string(), 'admin/menu/categories') !== false ? 'active' : '' ?>">
            <span class="nav-icon">📂</span>
            <span>Categories</span>
        </a>

        <a href="<?= base_url('admin/menu/items') ?>" 
           class="nav-item sub <?= strpos(uri_string(), 'admin/menu/items') !== false ? 'active' : '' ?>">
            <span class="nav-icon">🍔</span>
            <span>Items</span>
        </a>
    </div>
</div>
<div class="nav-dropdown">
    <button type="button" class="nav-item nav-toggle" id="inventoryToggle">
        <span class="nav-icon">🥬</span>
        <span>Inventory</span>
    </button>

    <div class="submenu" id="inventorySubmenu">
        <a href="<?= base_url('admin/ingredients') ?>" 
           class="nav-item sub <?= strpos(uri_string(), 'admin/ingredients') !== false ? 'active' : '' ?>">
            <span class="nav-icon">🧂</span>
            <span>Ingredients</span>
        </a>

        <a href="<?= base_url('admin/stock-movements') ?>"
   class="nav-item sub <?= strpos(uri_string(), 'admin/stock-movements') !== false ? 'active' : '' ?>">
    <span class="nav-icon">🔁</span>
    <span>Stock</span>
</a>
        </a>
    </div>
</div>

        <a href="<?= base_url('admin/vendors') ?>" 
   class="nav-item <?= strpos(uri_string(), 'admin/vendors') !== false ? 'active' : '' ?>">
    <span class="nav-icon">🚚</span>
    <span>Vendors</span>
</a>
    <a href="<?= base_url('admin/reports') ?>" class="nav-item <?= strpos(uri_string(), 'admin/reports') !== false ? 'active' : '' ?>">
    <span class="nav-icon">📊</span>
    <span>Reports</span>
</a>
    
<?php endif; ?>

<?php if ($role === 'Admin'): ?>
    <!-- Users & Roles -->
      <a href="<?= base_url('admin/users') ?>" class="nav-item <?= strpos(uri_string(), 'admin/users') !== false ? 'active' : '' ?>">
            <span class="nav-icon">👥</span>
            <span>Users & Roles</span>
        </a>
        <a href="<?= base_url('admin/settings') ?>" class="nav-item <?= strpos(uri_string(), 'admin/settings') !== false ? 'active' : '' ?>">
    <span class="nav-icon">⚙️</span>
    <span>Settings</span>
</a>

<?php endif; ?>
    </nav>
</aside>
<script src="<?= base_url('assets/js/sidebar.js') ?>"></script>