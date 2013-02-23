            <!-- Footer -->
            <div id="mws-footer">
                Copyright <?= $this->site->website_name ?> <?= date('Y') ?>. All Rights Reserved.
            </div>

        </div>
        <!-- Main Container End -->
    </div>

    <!-- JavaScript Plugins -->
    <!-- <script type="text/javascript" src="<?= base_url() ?>assets/cms/js/libs/jquery-1.8.2.min.js"></script> -->
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/js/libs/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/js/libs/jquery.placeholder.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/custom-plugins/fileinput.js"></script>

    <!-- jQuery-UI Dependent Scripts -->
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/jui/js/jquery-ui-1.9.0.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/jui/jquery-ui.custom.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/jui/js/jquery.ui.touch-punch.js"></script>

    <!-- Plugin Scripts -->
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/plugins/datatables/jquery.dataTables.min.js"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/js/libs/excanvas.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="<?= base_url() ?>assets/cms/plugins/colorpicker/colorpicker-min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/plugins/validate/jquery.validate-min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/custom-plugins/wizard/wizard.min.js"></script>

    <!-- Core Script -->
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <? /* <script type="text/javascript" src="<?= base_url() ?>assets/cms/js/core/themer.js"></script> */ ?>

    <!-- Demo Scripts (remove if not needed) -->
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/js/demo/demo.dashboard.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/js/demo/demo.widget.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/js/demo/demo.formelements.js"></script>

    <? if ($this->uri->segment(3) == 'edit' || $this->uri->segment(3) == 'save') { ?>
    <!-- jQuery-UI Dependent Scripts -->
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/jui/js/globalize/globalize.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/jui/js/globalize/cultures/globalize.culture.en-US.js"></script>

    <!-- Plugin Scripts -->
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/custom-plugins/picklist/picklist.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/plugins/colorpicker/colorpicker-min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/plugins/validate/jquery.validate-min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/plugins/ibutton/jquery.ibutton.min.js"></script>
<!--     <script type="text/javascript" src="<?= base_url() ?>assets/cms/plugins/cleditor/jquery.cleditor.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/cms/plugins/cleditor/jquery.cleditor.table.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/cms/plugins/cleditor/jquery.cleditor.xhtml.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/cms/plugins/cleditor/jquery.cleditor.icon.min.js"></script> -->
    <script type="text/javascript" src="<?= base_url() ?>assets/cms/plugins/ibutton/jquery.ibutton.min.js"></script>
    <? } ?>

</body>
</html>