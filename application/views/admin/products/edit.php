

            <!-- Inner Container Start -->
            <!-- <div class="container"> -->

                <?//= $this->load->view('admin/common/statistics.php'); ?>

                <!-- Panels Start -->
                <?//= $this->load->view('admin/common/panels.php'); ?>


              <div class="mws-panel grid_8">

              <? if (validation_errors()) { ?>
              <div style="clear: both;" class="mws-form-message error">
                  <?php echo validation_errors(); ?>
              </div>

              <? } ?>
              </div>

              <form id="mws-validate" class="mws-form" method="post" enctype="multipart/form-data" action="<?= base_url() ?>admin/products/save/<?= ($this->uri->segment(4)) ? $this->uri->segment(4) : '' ?>">
              <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
              <div class="mws-panel grid_8 mws-collapsible">
                  <div class="mws-panel-header">
                      <span><i class="icon-pencil"></i> Product Information</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <? if ($this->uri->segment(4)) { ?>
                          <?= form_hidden('id', $this->uri->segment(4)); ?>
                        <? } ?>
                          <div class="mws-form-inline">

                              <div class="mws-form-row">
                                  <label class="mws-form-label">Title</label>
                                  <div class="mws-form-item small">
                                      <? $item->title = (isset($item->title)) ? $item->title : ''; ?>
                                      <?= form_input('title', $item->title, 'class="required" title="Product Title" rel="tooltip" data-placement="right"'); ?>
                                    </div>
                              </div>

                              <div class="mws-form-row">
                                  <label class="mws-form-label">Category</label>
                                  <div class="mws-form-item small">
                                      <? $item->category_id = (isset($item->category_id)) ? $item->category_id : ''; ?>
                                      <?= form_dropdown('category_id', $options['categories'], $item->category_id); ?>
                                      <?//= form_input('title', $item->title, 'class="required" title="Product Title" rel="tooltip" data-placement="right"'); ?>
                                  </div>
                              </div>

                              <div class="mws-form-row">
                                  <label class="mws-form-label">Is featured Product?</label>
                                  <div class="mws-form-item small">
                                      <? $item->is_featured = (isset($item->is_featured)) ? $item->is_featured : ''; ?>
                                      <?= form_dropdown('is_featured', array(0 => 'No', 1 => 'Yes'), $item->is_featured); ?>
                                      <?//= form_input('title', $item->title, 'class="required" title="Product Title" rel="tooltip" data-placement="right"'); ?>
                                  </div>
                              </div>

                            </div>

                    </div>
                </div>

              <div class="mws-panel grid_8 mws-collapsible">
                  <div class="mws-panel-header">
                      <span><i class="icon-pencil"></i> SEO</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <? if ($this->uri->segment(4)) { ?>
                          <?= form_hidden('id', $this->uri->segment(4)); ?>
                        <? } ?>
                          <div class="mws-form-inline">

                              <div class="mws-form-row">
                                  <label class="mws-form-label">Page Title</label>
                                  <div class="mws-form-item small">
                                      <? $item->page_title = (isset($item->page_title)) ? $item->page_title : ''; ?>
                                      <?= form_input('page_title', $item->page_title, 'title="Page Title" rel="tooltip" data-placement="right"'); ?>
                                    </div>
                              </div>

                              <div class="mws-form-row">
                                  <label class="mws-form-label">Meta Description</label>
                                  <div class="mws-form-item small">
                                      <? $item->meta_description = (isset($item->meta_description)) ? $item->meta_description : ''; ?>
                                      <?= form_textarea('meta_description', $item->meta_description, 'title="Meta Description" rel="tooltip" data-placement="right"'); ?>
                                    </div>
                              </div>

                              <div class="mws-form-row">
                                  <label class="mws-form-label">Meta Keywords</label>
                                  <div class="mws-form-item small">
                                      <? $item->meta_keywords = (isset($item->meta_keywords)) ? $item->meta_keywords : ''; ?>
                                      <?= form_textarea('meta_keywords', $item->meta_keywords, 'title="Meta Keywords" rel="tooltip" data-placement="right"'); ?>
                                    </div>
                              </div>
                            </div>
                    </div>
                </div>

              <div class="mws-panel grid_8">
                  <div class="mws-panel-header">
                      <span><i class="icon-pencil-2"></i> Description</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                          <div class="mws-form-row">
                              <label class="mws-form-label"></label>
                                <div class="mws-form-item">
                                  <? $item->description = (isset($item->description)) ? $item->description : ''; ?>

                                  <script src="<?= base_url() ?>ckeditor/ckeditor.js"></script>
                                  <textarea class="ckeditor" name="description"><?= html_entity_decode($item->description) ?></textarea>
                                    <script>

                                      // This call can be placed at any point after the
                                      // <textarea>, or inside a <head><script> in a
                                      // window.onload event handler.

                                      // Replace the <textarea id="editor"> with an CKEditor
                                      // instance, using default configurations.

                                      CKEDITOR.replace( 'description' );

                                    </script>
<?php
                                  // require_once '/ckeditor/ckeditor.php';
                                  // $ckeditor = new CKEditor();
                                  // $ckeditor->basePath = '../../../ckeditor/';
                                  // $ckeditor->config['width'] = '850';
                                  // $ckeditor->config['height'] = '300';
                                  // echo $ckeditor->editor('description', html_entity_decode($item->description));
?>
                                  <?//= $ckeditor->editor('description', html_entity_decode(set_value('description', $item->description))); ?>
                                  <!-- <textarea id="cleditor" name="description" class="required"><?= $item->description ?></textarea> -->
                                </div>
                            </div>
                            <div class="mws-button-row">
                              <input type="submit" value="Submit" class="btn btn-danger" />
                            </div>
                    </div>
                </div>

                        </form>
                <!-- Panels End -->
            </div>
            <!-- Inner Container End -->

<!-- Prevents [CKEDITOR.editor] The instance "description" already exists error -->
<script type="text/javascript">
      // var instance = CKEDITOR.instances['description'];
      // if (instance) {
      //   instance.destroy(true);
      // }
  </script>