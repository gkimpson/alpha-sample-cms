

                <?= $this->load->view('admin/common/statistics.php'); ?>

                <!-- Panels Start -->
                <?//= $this->load->view('admin/common/panels.php'); ?>


                <div class="mws-panel grid_8 mws-collapsible">
                    <div class="mws-panel-header">
                        <span><i class="icon-table"></i> <?= ucfirst($this->module) ?> - <a href="<?= base_url() ?>admin/<?= ($this->module) ?>/add">Add New Page</a></span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <? if (count($items)) { ?>
                        <table class="mws-table mws-datatable">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Added</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach ($items as $item) { ?>
                                <tr>
                                    <td><?= $item->page_title ?></td>
                                    <td><?= date('d/m/Y', mysql_to_unix($item->created_at)) ?></td>
                                    <td>
                                        <span class="btn-group">
                                            <!-- <a href="<?= base_url() ?>/" class="btn btn-small"><i class="icon-search"></i></a> -->
                                            <a href="<?= base_url() ?>admin/pages/edit/<?= $item->id ?>" class="btn btn-small"><i class="icon-pencil"></i></a>
                                            <a href="<?= base_url() ?>admin/pages/delete/<?= $item->id ?>" class="btn btn-small"><i class="icon-trash" productid="<?= $item->id ?>"></i></a>
                                            <? /* <a href="<?= base_url() ?>admin/pages/upload_image/<?= $item->id ?>" class="btn btn-small"><i class="icon-camera" productid="<?= $item->id ?>"></i></a> */ ?>
                                        </span>
                                    </td>
                                </tr>
                                <? } ?>
                            </tbody>
                        </table>
                        <? } ?>
                    </div>
                </div>

                <!-- Panels End -->
            </div>
            <!-- Inner Container End -->
