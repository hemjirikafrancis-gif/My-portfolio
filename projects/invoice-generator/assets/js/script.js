/**
 * InvoicePro — script.js
 */

/* ── Modal helpers ─────────────────────────────── */
function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
    document.body.style.overflow = '';
}
document.addEventListener('click', e => {
    if (e.target.classList.contains('modal')) {
        e.target.classList.add('hidden');
        document.body.style.overflow = '';
    }
});
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal:not(.hidden)').forEach(m => {
            m.classList.add('hidden');
            document.body.style.overflow = '';
        });
    }
});

/* ── Client edit modal ─────────────────────────── */
function openEditModal(id, name, email, phone, address) {
    document.getElementById('edit-id').value      = id;
    document.getElementById('edit-name').value    = name;
    document.getElementById('edit-email').value   = email;
    document.getElementById('edit-phone').value   = phone;
    document.getElementById('edit-address').value = address;
    openModal('modal-edit');
}

/* ── Invoice line items ────────────────────────── */
(function () {
    const tbody      = document.getElementById('items-body');
    const addBtn     = document.getElementById('add-item-btn');
    const taxInput   = document.getElementById('tax-rate');
    const discInput  = document.getElementById('discount-input');

    if (!tbody || !addBtn) return;

    const CURRENCY = (typeof window.CURRENCY !== 'undefined') ? window.CURRENCY : '$';

    function esc(s) {
        return String(s)
            .replace(/&/g,'&amp;').replace(/</g,'&lt;')
            .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    function money(n) {
        const num = parseFloat(n || 0);
        return CURRENCY + num.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function addRow(desc = '', qty = 1, price = 0) {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><input type="text" name="description[]" value="${esc(desc)}"
                       class="form-control" placeholder="Describe service or product" required></td>
            <td><input type="number" name="quantity[]" value="${qty}"
                       min="0.01" step="any" class="qty form-control" style="text-align:right"></td>
            <td><input type="number" name="unit_price[]" value="${parseFloat(price).toFixed(2)}"
                       min="0" step="any" class="price form-control" style="text-align:right"></td>
            <td><input type="text" class="row-amount form-control" value="${money(qty * price)}"
                       readonly style="text-align:right;background:#f8fafc"></td>
            <td><button type="button" class="item-remove btn btn-xs btn-danger" title="Remove">&times;</button></td>`;

        tr.querySelector('.item-remove').addEventListener('click', () => {
            tr.remove();
            recalc();
        });
        ['qty', 'price'].forEach(cls => {
            tr.querySelector('.' + cls).addEventListener('input', () => updateRow(tr));
        });

        tbody.appendChild(tr);
        recalc();
    }

    function updateRow(tr) {
        const qty   = parseFloat(tr.querySelector('.qty').value)   || 0;
        const price = parseFloat(tr.querySelector('.price').value) || 0;
        tr.querySelector('.row-amount').value = money(qty * price);
        recalc();
    }

    function recalc() {
        let subtotal = 0;
        tbody.querySelectorAll('tr').forEach(tr => {
            const qty   = parseFloat(tr.querySelector('.qty')?.value)   || 0;
            const price = parseFloat(tr.querySelector('.price')?.value) || 0;
            subtotal += qty * price;
        });

        const taxRate  = parseFloat(taxInput?.value  || 0) || 0;
        const discount = parseFloat(discInput?.value || 0) || 0;
        const taxAmt   = subtotal * (taxRate / 100);
        const total    = subtotal + taxAmt - discount;

        setText('disp-subtotal', money(subtotal));
        setText('disp-tax',      money(taxAmt));
        setText('disp-tax-rate', taxRate);
        setText('disp-total',    money(Math.max(0, total)));
        setText('disp-discount', money(discount));
    }

    function setText(id, val) {
        const el = document.getElementById(id);
        if (el) el.textContent = val;
    }

    addBtn.addEventListener('click', () => addRow());
    taxInput?.addEventListener('input', recalc);
    discInput?.addEventListener('input', recalc);

    if (window.EXISTING_ITEMS && window.EXISTING_ITEMS.length) {
        window.EXISTING_ITEMS.forEach(i => addRow(i.description, i.quantity, i.unit_price));
    } else {
        addRow();
        addRow();
    }
})();

/* ── Sidebar toggle ────────────────────────────── */
const menuBtn = document.getElementById('menuBtn');
const sidebar = document.getElementById('sidebar');
if (menuBtn && sidebar) {
    menuBtn.addEventListener('click', () => {
        sidebar.classList.toggle('sidebar-open');
    });
}

/* ── Auto-dismiss alerts after 5s ─────────────── */
document.querySelectorAll('.alert').forEach(el => {
    setTimeout(() => { el.style.transition = 'opacity .4s'; el.style.opacity = '0'; }, 5000);
    setTimeout(() => el.remove(), 5400);
});
