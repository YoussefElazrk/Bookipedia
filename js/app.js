(() => {
  const byId = (id) => document.getElementById(id);

  // --- CART BADGE UI ---
  function updateBadge(count) {
    const el = byId("bpCartBadge");
    if (!el) return;
    el.textContent = String(count);
    if (count > 0) {
      el.classList.remove("is-hidden");
    } else {
      el.classList.add("is-hidden");
    }
  }

  // --- AJAX CART ACTIONS ---
  // Exposed globally for use in PHP loops (index, all-books, best-sellers)
  window.addToCart = function(bookId, quantity = 1) {
    const formData = new FormData();
    formData.append('book_id', bookId);
    formData.append('quantity', quantity);

    fetch('cart_logic.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            updateBadge(data.cart_count);
        } else {
            // Redirect to login if user session is not active
            window.location.href = 'login.php';
        }
    })
    .catch(err => console.error("Cart Error:", err));
  };

  // Used in cart.php for + / - buttons
  window.updateQty = function(bookId, delta) {
    const formData = new FormData();
    formData.append('action', 'update');
    formData.append('book_id', bookId);
    formData.append('delta', delta);

    fetch('cart_logic.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Refresh to show new totals and quantities
        }
    })
    .catch(err => console.error("Update Error:", err));
  };

  // --- UI ENHANCEMENTS ---
  function applyTheme() {
    const theme = document.body.dataset.bpTheme;
    if (theme === "login") {
      document.body.classList.add("about-page");
    }
  }

  function applyActiveNav() {
    const p = document.body.dataset.bpNav || "";
    document.querySelectorAll(".bp-nav-link").forEach((a) => {
      const key = a.getAttribute("data-bp-nav");
      const on = key === p;
      a.classList.toggle("is-active", on);
      const line = a.querySelector("[data-bp-nav-line]");
      if (line) line.classList.toggle("d-none", !on);
    });
  }

  
  // --- BOOK DETAIL PAGE LOGIC ---
  function initBookDetail() {
    const host = document.getElementById("bpBookRoot");
    if (!host) return;

    const id = new URLSearchParams(location.search).get("id");
    if (!id) return;

    let qty = 1;

    // Tab switching (Description vs Details)
    const setupTabs = () => {
      const tabBtns = host.querySelectorAll("[data-bp-tab]");
      const descDiv = document.getElementById("tab-content-description");
      const detailsDiv = document.getElementById("tab-content-details");

      tabBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
          tabBtns.forEach(b => b.classList.remove("is-active"));
          btn.classList.add("is-active");
          const tabType = btn.getAttribute("data-bp-tab");
          if (tabType === "description") {
            descDiv.style.display = "block";
            detailsDiv.style.display = "none";
          } else {
            descDiv.style.display = "none";
            detailsDiv.style.display = "block";
          }
        });
      });
    };

    // Quantity selector logic
    const setupQty = () => {
      const decBtn = host.querySelector("[data-bp-dec]");
      const incBtn = host.querySelector("[data-bp-inc]");
      const qtyLbl = document.getElementById("bpQtyLbl");

      if (decBtn && incBtn && qtyLbl) {
        decBtn.onclick = () => {
          qty = Math.max(1, qty - 1);
          qtyLbl.textContent = qty;
        };
        incBtn.onclick = () => {
          qty = Math.min(99, qty + 1);
          qtyLbl.textContent = qty;
        };
      }
    };

    const setupActions = () => {
      const addBtn = document.getElementById("bpDetailAdd");
      if (addBtn) {
        addBtn.onclick = () => window.addToCart(id, qty);
      }
    };

    setupQty();
    setupTabs();
    setupActions();
  }

  // --- BOOT PROCESS ---
  function boot() {
    applyTheme();
    applyActiveNav();
    initBookDetail();
  }

  document.addEventListener("DOMContentLoaded", boot);
})();