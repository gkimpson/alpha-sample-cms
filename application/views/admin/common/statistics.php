                <!-- Statistics Button Container -->
                <div class="mws-stat-container clearfix">

                    <!-- Statistic Item -->
                    <? if (isset($this->statistics->box1)) { ?>
                    <a class="mws-stat" href="<?= base_url() ?>assets/cms/#">
                        <!-- Statistic Icon (edit to change icon) -->
                        <span class="mws-stat-icon <? if (isset($this->statistics->box1->icon)) echo $this->statistics->box1->icon ?>"></span>

                        <!-- Statistic Content -->
                        <span class="mws-stat-content">
                            <span class="mws-stat-title"><? if (isset($this->statistics->box1->title)) echo $this->statistics->box1->title ?></span>
                            <span class="mws-stat-value"><? if (isset($this->statistics->box1->value)) echo $this->statistics->box1->value ?></span>
                        </span>
                    </a>
                    <? } ?>

                    <? /*
                    <a class="mws-stat" href="<?= base_url() ?>assets/cms/#">
                        <!-- Statistic Icon (edit to change icon) -->
                        <span class="mws-stat-icon icol32-sport"></span>

                        <!-- Statistic Content -->
                        <span class="mws-stat-content">
                            <span class="mws-stat-title"><? if (isset($this->statistics->box2->title)) echo $this->statistics->box2->title ?></span>
                            <span class="mws-stat-value"><? if (isset($this->statistics->box2->value)) echo $this->statistics->box2->value ?></span>
                        </span>
                    </a>
                    */ ?>

                    <? /*
                    <a class="mws-stat" href="<?= base_url() ?>assets/cms/#">
                        <!-- Statistic Icon (edit to change icon) -->
                        <span class="mws-stat-icon icol32-walk"></span>

                        <!-- Statistic Content -->
                        <span class="mws-stat-content">
                            <span class="mws-stat-title"><? if (isset($this->statistics->box3->title)) echo $this->statistics->box3->title ?></span>
                            <span class="mws-stat-value"><? if (isset($this->statistics->box3->value)) echo $this->statistics->box3->value ?></span>
                        </span>
                    </a>
                    */ ?>

                    <? /*
                    <a class="mws-stat" href="<?= base_url() ?>assets/cms/#">
                        <!-- Statistic Icon (edit to change icon) -->
                        <span class="mws-stat-icon icol32-bug"></span>

                        <!-- Statistic Content -->
                        <span class="mws-stat-content">
                            <span class="mws-stat-title"><? if (isset($this->statistics->box4->title)) echo $this->statistics->box4->title ?></span>
                            <span class="mws-stat-value"><? if (isset($this->statistics->box4->value)) echo $this->statistics->box4->value ?></span>
                        </span>
                    </a>
                    */ ?>

                    <? /*
                    <a class="mws-stat" href="<?= base_url() ?>assets/cms/#">
                        <!-- Statistic Icon (edit to change icon) -->
                        <span class="mws-stat-icon icol32-car"></span>

                        <!-- Statistic Content -->
                        <span class="mws-stat-content">
                            <span class="mws-stat-title"><? if (isset($this->statistics->box5->title)) echo $this->statistics->box5->title ?></span>
                            <span class="mws-stat-value"><? if (isset($this->statistics->box5->value)) echo $this->statistics->box5->value ?></span>
                        </span>
                    </a>
                    */ ?>
                </div>