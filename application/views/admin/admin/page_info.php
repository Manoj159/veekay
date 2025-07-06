<div class="app-main__outer">
    
    <div class="app-main__inner">
    
        <div class="app-page-title">
    
            <div class="page-title-wrapper">
    
                <div class="page-title-heading">
                      
                    <?= $page_title; ?>
    
                </div>
        
                 <div class="page-title-actions">
                    
                    <button type="button"  class="btn-shadow mr-3 btn btn-outline-success" style="box-shadow: none;">

                        <?= $this->db->get_where('settings', array('type'=>'system_title'))->row()->description; ?>

                    </button>
                    
                    <button type="button"  class="btn-shadow mr-3 btn btn-dark">
                            
                           <?= date("d-M-Y"); ?>&nbsp; &nbsp;<?= date("D")."day"; ?>
                            
                    </button>
                        
                </div>   

            </div>
    
        </div>         