<div class="page" id="page-admin">
    <div id="admin-lock">
        <div class="lock-screen">
            <div class="lock-card">
                <div class="lock-icon">&#128274;</div>
                <h2>Admin Access</h2>
                <p>Enter the admin password to manage all donors</p>
                <input type="password" id="admin-pass" placeholder="Password" onkeydown="if(event.key==='Enter')checkAdmin()" />
                <button class="btn-red" onclick="checkAdmin()">Unlock Panel</button>
                <p class="lock-hint">Default password: <strong>redpulse123</strong></p>
            </div>
        </div>
    </div>

    <div id="admin-panel" style="display:none;">
        <div class="panel-wrap">
            <div class="panel-header">
                <div>
                    <h2>Admin Panel <span class="count-badge" id="admin-count">0</span></h2>
                    <p style="color:var(--muted);font-size:.88rem;margin-top:4px;">Manage all registered donors</p>
                </div>
                <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
                    <div class="search-bar">
                        <div class="form-group">
                            <label style="margin-bottom: 8px; display: block;">Blood Group:</label>
                            <select id="admin-filter-blood" onchange="renderAdminDonors()" style="width: 150px;">
                                <option value="">All Blood Groups</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="margin-bottom: 8px; display: block;">District:</label>
                            <input type="text" id="admin-filter-zilla" placeholder="Filter by Zilla..." oninput="renderAdminDonors()" style="width: 150px;" />
                        </div>
                    </div>
                    <button class="btn-sm ghost" onclick="clearAllDonors()" style="border-color:#F0D5D5;color:var(--red);">
                        Clear All
                    </button>
                    <button class="btn-sm ghost" onclick="adminLogout()">Logout</button>
                </div>
            </div>

            <div class="cards-grid" id="admin-stats" style="margin-bottom:28px;"></div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Blood Group</th>
                            <th>Phone</th>
                            <th>Available Days</th>
                            <th>Zilla</th>
                            <th>Registered</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="admin-tbody"></tbody>
                </table>
            </div>

            <div class="empty-state" id="admin-empty" style="display:none;">
                <span class="empty-icon">&#128101;</span>
                <p>No donors registered yet.</p>
            </div>
        </div>
    </div>
</div>