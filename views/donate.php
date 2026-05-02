<div class="page" id="page-donate">
    <div class="form-wrap">
        <div class="form-card">
            <div class="form-head">
                <div class="form-head-icon">&#129656;</div>
                <div>
                    <h2>Donor Registration</h2>
                    <p>Fill in your details to join the RedPulse network</p>
                </div>
            </div>

            <form id="donor-form" onsubmit="submitDonor(); return false;">
                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" id="f-name" placeholder="e.g. Md. Rahim Uddin" required />
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Blood Group *</label>
                        <select id="f-blood" required>
                            <option value="">-- Select --</option>
                            <?php foreach (getBloodGroups() as $group): ?>
                                <option value="<?php echo $group; ?>"><?php echo $group; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phone Number *</label>
                        <input type="tel" id="f-phone" placeholder="01XXXXXXXXX" maxlength="11" required />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Available Days *</label>
                        <select id="f-days" required>
                            <option value="">-- Select --</option>
                            <option>Everyday</option>
                            <option>Weekdays (Sat-Thu)</option>
                            <option>Weekends Only</option>
                            <option>Flexible / On Call</option>
                            <option>Once a Month</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Zilla (District) *</label>
                        <select id="f-zilla" required>
                            <option value="">-- Select --</option>
                            <?php foreach (getDistricts() as $district): ?>
                                <option value="<?php echo $district; ?>"><?php echo $district; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-red">&#129656; Register as Donor</button>
            </form>
        </div>
    </div>
</div>