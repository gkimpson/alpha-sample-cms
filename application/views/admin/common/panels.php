

                <div class="mws-panel grid_5 mws-collapsible">
                    <div class="mws-panel-header">
                        <span><i class="icon-graph"></i> Charts</span>
                    </div>
                    <div class="mws-panel-body">
                        <div id="mws-dashboard-chart" style="height: 222px;"></div>
                    </div>
                </div>

                <div class="mws-panel grid_3 mws-collapsible">
                    <div class="mws-panel-header">
                        <span><i class="icon-book"></i> Website Summary</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <ul class="mws-summary clearfix">
                            <li>
                                <span class="key"><i class="icon-support"></i> Support Tickets</span>
                                <span class="val">
                                    <span class="text-nowrap">332</span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-certificate"></i> Commision</span>
                                <span class="val">
                                    <span class="text-nowrap">71% <i class="up icon-arrow-up"></i></span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-shopping-cart"></i> This Week Sales</span>
                                <span class="val">
                                    <span class="text-nowrap">144 <i class="down icon-arrow-down"></i></span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-install"></i> Cash Deposit</span>
                                <span class="val">
                                    <span class="text-nowrap">$6,421</span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-key"></i> Last Sign In</span>
                                <span class="val">
                                    <span class="text-nowrap">September 21, 2012</span>
                                </span>
                            </li>
                            <li>
                                <span class="key"><i class="icon-windows"></i> Operating System</span>
                                <span class="val">
                                    <span class="text-nowrap">Debian Linux</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!--
                <div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                        <span><i class="icon-magic"></i> Registration Wizard</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <form id="mws-wizard-form" class="mws-form" action="dashboard.html">

                            <fieldset id="step-1" class="mws-form-inline">
                                <legend class="wizard-label"><i class="icol-accept"></i> Member Profile</legend>
                                <div id class="mws-form-row">
                                    <label class="mws-form-label">Fullname <span class="required">*</span></label>
                                    <div class="mws-form-item large">
                                        <input type="text" name="fullname" class="required" />
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Email <span class="required">*</span></label>
                                    <div class="mws-form-item large">
                                        <input type="text" name="email" class="required email" />
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Address <span class="required">*</span></label>
                                    <div class="mws-form-item large">
                                        <textarea name="address" rows="100%" cols="100%" class="required"></textarea>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Gender <span class="required">*</span></label>
                                    <div class="mws-form-item">
                                        <ul class="mws-form-list">
                                            <li><input type="radio" id="male" name="gender" class="required"/> <label for="male">Male</label></li>
                                            <li><input type="radio" id="female" name="gender" /> <label for="female">Female</label></li>
                                        </ul>
                                        <label class="error plain" generated="true" for="gender" style="display:none"></label>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset id="step-2" class="mws-form-inline">
                                <legend class="wizard-label"><i class="icol-delivery"></i> Membership Type</legend>
                                <div id class="mws-form-row">
                                    <label class="mws-form-label">Membership Plan <span class="required">*</span></label>
                                    <div class="mws-form-item large">
                                        <select class="required">
                                            <option>Free</option>
                                            <option>Standard</option>
                                            <option>Premium</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Subscription Period <span class="required">*</span></label>
                                    <div class="mws-form-item large">
                                        <select class="required">
                                            <option>One Month</option>
                                            <option>Six Months</option>
                                            <option>Twelve Months</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Payment Method <span class="required">*</span></label>
                                    <div class="mws-form-item">
                                        <ul class="mws-form-list">
                                            <li><input type="radio" id="cc" name="pm" class="required" /> <label for="cc">Credit Card</label></li>
                                            <li><input type="radio" id="pp" name="pm" /> <label for="pp">PayPal</label></li>
                                        </ul>
                                        <label class="error plain" generated="true" for="pm" style="display:none"></label>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset id="step-3" class="mws-form-inline">
                                <legend class="wizard-label"><i class="icol-user"></i> Confirmation</legend>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Message <span class="required">*</span></label>
                                    <div class="mws-form-item large">
                                        <textarea name="address" rows="100%" cols="100%" class="required"></textarea>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Subscribe Newsletter <span class="required">*</span></label>
                                    <div class="mws-form-item">
                                        <ul class="mws-form-list inline">
                                            <li><input type="radio" id="sn_yes" name="sn" class="required" /> <label for="sn_yes">Yes</label></li>
                                            <li><input type="radio" id="sn_no" name="sn" /> <label for="sn_no">No</label></li>
                                        </ul>
                                        <label class="error plain" generated="true" for="sn" style="display:none"></label>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">I agree to the TOS <span class="required">*</span></label>
                                    <div class="mws-form-item">
                                        <ul class="mws-form-list inline">
                                            <li><input type="checkbox" id="tos_y" name="tos" class="required" /> <label for="tos_y">Yes</label></li>
                                        </ul>
                                        <label class="error plain" generated="true" for="tos" style="display:none"></label>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                -->