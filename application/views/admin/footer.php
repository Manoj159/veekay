
                    <div class="app-wrapper-footer">
                        <div class="app-footer">
                            <div class="app-footer__inner">
                                <div class="app-footer-left" style="margin-left: 40%">
                                    
                                    <p>&copy; <?= ucwords($footer); ?></p>

                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
               <!--  <script src="https://maps.google.com/maps/api/js?sensor=true"></script> -->
        </div>
    </div>


   <script type="text/javascript" src="<?= base_url(); ?>/assets/admin/scripts/main.js"></script> 


   <script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script> 


   <script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script> 

   <script type="text/javascript">
       $(document).ready(function() {
        $('#example').DataTable();
    } );
   </script>

    <script type="text/javascript">
        function showAjaxModal(url)
        {
            $('#Modalexample').show();
            
            $.ajax({
                url: url,
                success: function(response)
                {
                    $('#Modalexample .modal-body').html(response);
                }
            });
        }

        function remove_modal()
        {
            $('#Modalexample').hide();
        }
    </script>

    <style type="text/css">
        .fade:not(.show){
            opacity: 1;
        }
        #Modalexample{
            position: absolute;
            top: 0;
            z-index: 99999;
        }
        #Modalexample .modal-body{
            z-index: 9999;
        }
        #Modalexample .card, .modal-dialog{
            box-shadow: none;
        }
    </style>

    <div class="modal fade bd-example-modal-lg" role="dialog" id="Modalexample"  aria-hidden="true" style="padding-top: 10%">
        <div class="modal-dialog">
          <div class="modal-content">
           <div class="modal-body"></div>
           <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="remove_modal();" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

</body>
</html>
