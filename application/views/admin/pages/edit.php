
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

              <form id="mws-validate" class="mws-form" method="post" enctype="multipart/form-data" action="<?= base_url() ?>admin/pages/save/<?= ($this->uri->segment(4)) ? $this->uri->segment(4) : '' ?>">
              <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
              <div class="mws-panel grid_8 mws-collapsible">
                  <div class="mws-panel-header">
                      <span><i class="icon-pencil"></i> Page Information</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <? if ($this->uri->segment(4)) { ?>
                          <?= form_hidden('id', $this->uri->segment(4)); ?>
                        <? } ?>
                          <div class="mws-form-inline">

                              <div class="mws-form-row">
                                  <label class="mws-form-label">Slug</label>
                                  <div class="mws-form-item small">
                                      <? $item->slug = (isset($item->slug)) ? $item->slug : ''; ?>
                                      <?= form_input('slug', $item->slug, 'class="required" title="Slug" rel="tooltip" data-placement="right"'); ?>
                                    </div>
                              </div>

                              <div class="mws-form-row">
                                  <label class="mws-form-label">H1</label>
                                  <div class="mws-form-item small">
                                      <? $item->h1 = (isset($item->h1)) ? $item->h1 : ''; ?>
                                      <?= form_input('h1', $item->h1, 'class="required" title="h1" rel="tooltip" data-placement="right"'); ?>
                                    </div>
                              </div>

                              <div class="mws-form-row">
                                  <label class="mws-form-label">Link Text</label>
                                  <div class="mws-form-item small">
                                      <? $item->link_text = (isset($item->link_text)) ? $item->link_text : ''; ?>
                                      <?= form_input('link_text', $item->link_text, 'class="required" title="link_text" rel="tooltip" data-placement="right"'); ?>
                                    </div>
                              </div>

                              <div class="mws-form-row">
                                  <label class="mws-form-label">Rank</label>
                                  <div class="mws-form-item small">
                                      <? $item->rank = (isset($item->rank)) ? $item->rank : ''; ?>
                                      <?= form_input('rank', $item->rank, 'class="required" title="rank" rel="tooltip" data-placement="right"'); ?>
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

              <div class="mws-panel grid_8 mws-collapsible">
                  <div class="mws-panel-header">
                      <span><i class="icon-pencil-2"></i> Content</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                          <div class="mws-form-row">
                              <label class="mws-form-label"></label>
                                <div class="mws-form-item">
                                  <? $item->content = (isset($item->content)) ? $item->content : ''; ?>

                                  <script src="<?= base_url() ?>ckeditor/ckeditor.js"></script>
                                  <textarea class="ckeditor" name="content"><?= html_entity_decode($item->content) ?></textarea>
                                    <script>

                                      // This call can be placed at any point after the
                                      // <textarea>, or inside a <head><script> in a
                                      // window.onload event handler.

                                      // Replace the <textarea id="editor"> with an CKEditor
                                      // instance, using default configurations.

                                      CKEDITOR.replace( 'content' );

                                    </script>

                                  <?//= $ckeditor->editor('content', html_entity_decode(set_value('content', $item->content))); ?>
                                  <!-- <textarea id="cleditor" name="content" class="required"><?= $item->content ?></textarea> -->
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