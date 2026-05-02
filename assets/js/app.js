class RedPulse {
    constructor() {
        this.donors = [];
        this.adminPassword = 'redpulse123';
        this.init();
    }

    init() {
        this.loadDonors();
        this.initializeSampleData();
        this.updateStats();
        this.bindEvents();
    }

    loadDonors() {
        this.donors = JSON.parse(localStorage.getItem('rp_donors') || '[]');
    }

    initializeSampleData() {
        // Always load sample data if no donors exist
        if (this.donors.length === 0) {
            const sampleDonors = [
                {
                    id: Date.now() + 1,
                    name: "Dr. Md. Abu Bakar",
                    blood: "O+",
                    phone: "01710123456",
                    days: "Everyday",
                    zilla: "Dhaka",
                    date: new Date(Date.now() - 86400000 * 15).toLocaleDateString('en-GB')
                },
                {
                    id: Date.now() + 2,
                    name: "Sultana Rahman",
                    blood: "A+",
                    phone: "01812345678",
                    days: "Weekdays (Sat-Thu)",
                    zilla: "Chittagong",
                    date: new Date(Date.now() - 86400000 * 12).toLocaleDateString('en-GB')
                },
                {
                    id: Date.now() + 3,
                    name: "Engr. Khaled Hasan",
                    blood: "B+",
                    phone: "01987654321",
                    days: "Flexible / On Call",
                    zilla: "Rajshahi",
                    date: new Date(Date.now() - 86400000 * 10).toLocaleDateString('en-GB')
                },
                {
                    id: Date.now() + 4,
                    name: "Jannatul Ferdous",
                    blood: "AB+",
                    phone: "01511223344",
                    days: "Weekends Only",
                    zilla: "Sylhet",
                    date: new Date(Date.now() - 86400000 * 8).toLocaleDateString('en-GB')
                },
                {
                    id: Date.now() + 5,
                    name: "Sakib Ahmed",
                    blood: "O-",
                    phone: "01699887766",
                    days: "Everyday",
                    zilla: "Khulna",
                    date: new Date(Date.now() - 86400000 * 6).toLocaleDateString('en-GB')
                },
                {
                    id: Date.now() + 6,
                    name: "Farzana Chowdhury",
                    blood: "A-",
                    phone: "01355443322",
                    days: "Once a Month",
                    zilla: "Barisal",
                    date: new Date(Date.now() - 86400000 * 4).toLocaleDateString('en-GB')
                },
                {
                    id: Date.now() + 7,
                    name: "Mr. Rashedul Islam",
                    blood: "B-",
                    phone: "01412345678",
                    days: "Weekdays (Sat-Thu)",
                    zilla: "Cumilla",
                    date: new Date(Date.now() - 86400000 * 2).toLocaleDateString('en-GB')
                }
            ];

            this.donors = sampleDonors;
            this.saveDonors();
            console.log('Sample data loaded:', sampleDonors);
        }
    }

    saveDonors() {
        localStorage.setItem('rp_donors', JSON.stringify(this.donors));
    }

    showPage(pageId) {
        document.querySelectorAll('.page').forEach(page => {
            page.classList.remove('visible');
        });

        document.querySelectorAll('.nav-links button').forEach(btn => {
            btn.classList.remove('active');
        });

        document.getElementById(`page-${pageId}`).classList.add('visible');
        document.getElementById(`nav-${pageId}`).classList.add('active');

        if (pageId === 'donors') {
            setTimeout(() => this.renderDonors(), 100);
        }
        if (pageId === 'admin') this.renderAdminDonors();
        if (pageId === 'home') this.updateStats();

        window.scrollTo(0, 0);
    }

    updateStats() {
        document.getElementById('stat-total').textContent = this.donors.length;
    }

    submitDonor() {
        const name = document.getElementById('f-name').value.trim();
        const blood = document.getElementById('f-blood').value;
        const phone = document.getElementById('f-phone').value.trim();
        const days = document.getElementById('f-days').value;
        const zilla = document.getElementById('f-zilla').value;

        if (!name || !blood || !phone || !days || !zilla) {
            this.showToast('Please fill in all fields!', '#C8102E');
            return;
        }

        if (!/^01[3-9]\d{8}$/.test(phone)) {
            this.showToast('Enter a valid BD phone number (01XXXXXXXXX)', '#C8102E');
            return;
        }

        const donor = {
            id: Date.now(),
            name,
            blood,
            phone,
            days,
            zilla,
            date: new Date().toLocaleDateString('en-GB')
        };

        this.donors.unshift(donor);
        this.saveDonors();
        this.clearForm();
        this.showToast('Thank you! You are now registered as a donor.');
    }

    clearForm() {
        document.getElementById('f-name').value = '';
        document.getElementById('f-phone').value = '';
        document.getElementById('f-blood').selectedIndex = 0;
        document.getElementById('f-days').selectedIndex = 0;
        document.getElementById('f-zilla').selectedIndex = 0;
    }

    renderDonors() {
        console.log('All donors:', this.donors); // Debug

        const bloodFilter = document.getElementById('filter-blood').value;
        const zillaFilter = document.getElementById('filter-zilla').value.trim().toLowerCase();

        console.log('Filters:', { bloodFilter, zillaFilter }); // Debug

        let filteredDonors = this.donors;

        if (bloodFilter) {
            filteredDonors = filteredDonors.filter(d => d.blood === bloodFilter);
        }

        if (zillaFilter) {
            filteredDonors = filteredDonors.filter(d =>
                d.zilla.toLowerCase().includes(zillaFilter)
            );
        }

        console.log('Filtered:', filteredDonors); // Debug

        document.getElementById('donor-count').textContent = filteredDonors.length;

        const tbody = document.getElementById('donors-tbody');
        const emptyState = document.getElementById('donors-empty');

        if (filteredDonors.length === 0) {
            tbody.innerHTML = '';
            emptyState.style.display = 'block';
            return;
        }

        emptyState.style.display = 'none';
        tbody.innerHTML = filteredDonors.map((donor, index) => `
            <tr>
                <td>${index + 1}</td>
                <td><div class="donor-name">${this.escape(donor.name)}</div></td>
                <td><span class="blood-tag">${donor.blood}</span></td>
                <td>
                    <a href="tel:${this.escape(donor.phone)}" class="donor-phone">
                        ${this.escape(donor.phone)}
                    </a>
                </td>
                <td>${this.escape(donor.days)}</td>
                <td>${this.escape(donor.zilla)}</td>
            </tr>
        `).join('');
    }

    clearFilters() {
        const bloodSelect = document.getElementById('filter-blood');
        const zillaInput = document.getElementById('filter-zilla');

        if (bloodSelect) bloodSelect.selectedIndex = 0;
        if (zillaInput) zillaInput.value = '';

        this.renderDonors();
    }

    checkAdmin() {
        const password = document.getElementById('admin-pass').value;

        if (password === this.adminPassword) {
            document.getElementById('admin-lock').style.display = 'none';
            document.getElementById('admin-panel').style.display = 'block';
            this.renderAdminDonors();
        } else {
            this.showToast('Wrong password!', '#C8102E');
        }
    }

    adminLogout() {
        document.getElementById('admin-lock').style.display = 'block';
        document.getElementById('admin-panel').style.display = 'none';
        document.getElementById('admin-pass').value = '';
    }

    renderAdminDonors() {
        const bloodFilter = document.getElementById('admin-filter-blood').value;
        const zillaFilter = document.getElementById('admin-filter-zilla').value.trim().toLowerCase();

        let filteredDonors = this.donors;

        if (bloodFilter) {
            filteredDonors = filteredDonors.filter(d => d.blood === bloodFilter);
        }

        if (zillaFilter) {
            filteredDonors = filteredDonors.filter(d =>
                d.zilla.toLowerCase().includes(zillaFilter)
            );
        }

        document.getElementById('admin-count').textContent = this.donors.length;

        this.renderAdminStats();

        const tbody = document.getElementById('admin-tbody');
        const emptyState = document.getElementById('admin-empty');

        if (filteredDonors.length === 0) {
            tbody.innerHTML = '';
            emptyState.style.display = 'block';
            return;
        }

        emptyState.style.display = 'none';
        tbody.innerHTML = filteredDonors.map((donor, index) => `
            <tr>
                <td>${index + 1}</td>
                <td><div class="donor-name">${this.escape(donor.name)}</div></td>
                <td><span class="blood-tag">${donor.blood}</span></td>
                <td>${this.escape(donor.phone)}</td>
                <td>${this.escape(donor.days)}</td>
                <td>${this.escape(donor.zilla)}</td>
                <td style="color:var(--muted);font-size:.85rem;">${donor.date || '-'}</td>
                <td>
                    <button class="del-btn" onclick="app.deleteDonor(${donor.id})">
                        🗑️ Delete
                    </button>
                </td>
            </tr>
        `).join('');
    }

    renderAdminStats() {
        const grouped = {};
        this.donors.forEach(d => {
            grouped[d.blood] = (grouped[d.blood] || 0) + 1;
        });

        const topGroup = Object.entries(grouped)
            .sort((a, b) => b[1] - a[1])
            .slice(0, 1);

        const districts = [...new Set(this.donors.map(d => d.zilla))];

        const stats = [
            { icon: '&#128101;', label: 'Total Donors', value: this.donors.length },
            {
                icon: '&#129656;',
                label: 'Most Common Group',
                value: topGroup[0] ? `${topGroup[0][0]} (${topGroup[0][1]})` : 'N/A'
            },
            { icon: '&#128205;', label: 'Districts', value: districts.length },
            {
                icon: '&#128197;',
                label: 'Latest Entry',
                value: this.donors[0] ? this.donors[0].date : 'None'
            }
        ];

        document.getElementById('admin-stats').innerHTML = stats.map(stat => `
            <div class="card" style="padding:20px 22px;">
                <div class="card-icon" style="font-size:1.6rem;margin-bottom:8px;">${stat.icon}</div>
                <div style="font-family:Playfair Display,serif;font-size:1.5rem;font-weight:900;color:var(--red);">
                    ${stat.value}
                </div>
                <div style="font-size:.82rem;color:var(--muted);font-weight:500;margin-top:2px;">
                    ${stat.label}
                </div>
            </div>
        `).join('');
    }

    deleteDonor(id) {
        if (!confirm('Remove this donor?')) return;

        this.donors = this.donors.filter(d => d.id !== id);
        this.saveDonors();
        this.renderAdminDonors();
        this.showToast('Donor removed.');
    }

    clearAllDonors() {
        if (!confirm('Delete ALL donors? This cannot be undone.')) return;

        this.donors = [];
        this.saveDonors();
        this.renderAdminDonors();
        this.showToast('All donors cleared.', '#C8102E');
    }

    showToast(message, color = '#1A7A4A') {
        const toast = document.getElementById('toast');
        toast.textContent = message;
        toast.style.background = color;
        toast.classList.add('show');

        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
    }

    escape(str) {
        return String(str).replace(/[&<>"']/g, c => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        })[c]);
    }

    bindEvents() {
        document.querySelectorAll('.nav-links button').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const pageId = e.target.id.replace('nav-', '');
                this.showPage(pageId);
            });
        });

        document.querySelector('.logo').addEventListener('click', () => {
            this.showPage('home');
        });

        document.querySelectorAll('.btn[href="#"]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
            });
        });
    }
}

const app = new RedPulse();

window.showPage = (pageId) => app.showPage(pageId);
window.submitDonor = () => app.submitDonor();
window.renderDonors = () => app.renderDonors();
window.clearFilters = () => app.clearFilters();
window.checkAdmin = () => app.checkAdmin();
window.adminLogout = () => app.adminLogout();
window.renderAdminDonors = () => app.renderAdminDonors();
window.deleteDonor = (id) => app.deleteDonor(id);
window.clearAllDonors = () => app.clearAllDonors();
window.resetSampleData = () => {
    localStorage.removeItem('rp_donors');
    localStorage.removeItem('sample_data_loaded');
    location.reload();
};