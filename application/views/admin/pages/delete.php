


            <!-- Inner Container Start -->
            <div class="container">

                <?//= $this->load->view('admin/common/statistics.php'); ?>

                <!-- Panels Start -->
                <?//= $this->load->view('admin/common/panels.php'); ?>

              <form id="mws-validate" class="mws-form" method="post" action="<?= base_url() ?>admin/pages/do_delete/<?= ($this->uri->segment(4)) ? $this->uri->segment(4) : '' ?>">
              <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
              <div class="mws-panel grid_8 mws-collapsible">
                  <div class="mws-panel-header">
                      <span><i class="icon-pencil"></i> Delete this Page: <?= $item->page_title ?></span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <? if ($this->uri->segment(4)) { ?>
                          <?= form_hidden('id', $this->uri->segment(4)); ?>
                        <? } ?>
                          <div class="mws-form-inline">

                              <div class="mws-form-row">
                                  <label class="mws-form-label">Page Title</label>
                                  <div class="mws-form-item small readonly">
                                      <? $item->page_title = (isset($item->page_title)) ? $item->page_title : ''; ?>
                                      <?= form_input('page_title', $item->page_title, 'readonly="readonly" class="required" page_title="Page Title" rel="tooltip" data-placement="right"'); ?>
                                    </div>
                              </div>

                              <div class="mws-form-row">
                                  <label class="mws-form-label"></label>
                                  <button onclick="history.go(-1)" type="button" class="btn btn btn-small"><< Go Back</button>
                                  <button type="submit" class="btn btn-danger btn-small">Delete Item</button>
                              </div>

                            </div>

                    </div>
                </div>
                </form>
                <!-- Panels End -->
            </div>
            <!-- Inner Container End -->
