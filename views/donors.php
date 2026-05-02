<div class="page" id="page-donors">
    <div class="panel-wrap">
        <div class="panel-header">
            <div>
                <h2>&#129656; Donor Directory <span class="count-badge" id="donor-count">0</span></h2>
                <p style="color:var(--muted);font-size:.88rem;margin-top:4px;">Search by blood group or district to find a donor near you</p>
            </div>
            <div class="search-bar">
                <div class="form-group">
                    <label style="margin-bottom: 8px; display: block;">Blood Group:</label>
                    <select id="filter-blood" onchange="renderDonors()" style="width: 150px;">
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
                    <input type="text" id="filter-zilla" placeholder="Filter by Zilla..." oninput="renderDonors()" style="width: 150px;" />
                </div>
                <button class="btn-sm ghost" onclick="clearFilters()" style="margin-top: 20px;">Clear Filters</button>
            </div>
        </div>

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
                    </tr>
                </thead>
                <tbody id="donors-tbody"></tbody>
            </table>
        </div>

        <div class="empty-state" id="donors-empty" style="display:none;">
            <span class="empty-icon">&#128269;</span>
            <p>No donors found. Try a different filter or <a href="#" onclick="showPage('donate')" style="color:var(--red)">register yourself</a>!</p>
        </div>
    </div>
</div>