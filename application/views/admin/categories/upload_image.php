
            <!-- Inner Container Start -->
            <!-- <div class="container"> -->

                <?//= $this->load->view('admin/common/statistics.php'); ?>

                <!-- Panels Start -->
                <?//= $this->load->view('admin/common/panels.php'); ?>


              <? if ($_POST) { ?>
              <div class="mws-panel grid_8">
                <div style="clear: both;" class="mws-form-message error">
                  <?= $this->upload->display_errors('<p>', '</p>'); ?>
                </div>
              </div>
              <? } ?>

              <form id="mws-validate" class="mws-form" method="post" enctype="multipart/form-data" action="<?= base_url() ?>admin/categories/do_upload/<?= ($this->uri->segment(4)) ? $this->uri->segment(4) : '' ?>">
              <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
              <div class="mws-panel grid_8 mws-collapsible">
                  <div class="mws-panel-header">
                      <span><i class="icon-pencil"></i> <?= $item->title ?> - Image Upload (Press Control + F5 to refresh cache if old appears)</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <? if ($this->uri->segment(4)) { ?>
                          <?= form_hidden('id', $this->uri->segment(4)); ?>
                        <? } ?>
                          <div class="mws-form-inline">

                              <div class="mws-form-row">
                                  <label class="mws-form-label">Image Upload</label>
                                  <div class="mws-form-item small">
                                      <input type="file" name="userfile" class="required" />
                                        <label for="userfile" class="error" generated="true" style="display:none"></label>
                                    </div>
                                </div>

                              <div class="mws-form-row">
                                  <label class="mws-form-label">Current Image (Large)</label>
                                  <div class="mws-form-item small">
                                      <? if (isset($id) && file_exists('uploads/categories/category-'. $id .'.jpg')) { ?>
                                      <img src="<?= base_url() ?>uploads/categories/category-<?= $id ?>.jpg" alt="Category Image">
                                      <? } else { ?>
                                      No image
                                      <? } ?>
                                  </div>
                                </div>

                              <div class="mws-form-row">
                                  <label class="mws-form-label">Current Image (Small)</label>
                                  <div class="mws-form-item small">
                                    <? if (isset($id) && file_exists('uploads/categories/category-'. $id .'-thumb.jpg')) { ?>
                                      <img src="<?= base_url() ?>uploads/categories/category-<?= $this->uri->segment(4) ?>-thumb.jpg" alt="Category Image">
                                    <? } else { ?>
                                    No image
                                    <? } ?>
                                  </div>
                                </div>

                             <div class="mws-button-row">
                                <input type="submit" value="Submit" class="btn btn-danger" />
                              </div>

                            </div>
                    </div>
                </div>

                        </form>
                <!-- Panels End -->
            </div>
            <!-- Inner Container End -->