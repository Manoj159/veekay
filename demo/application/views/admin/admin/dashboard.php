
<div class="row">

   <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-midnight-bloom">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Booking</div>
                    <div class="widget-subheading"></div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span><?= $this->db->where('payment_status',1)->count_all_results('booking'); ?></span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-arielle-smile">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total City</div>
                    <div class="widget-subheading"> </div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span><?= $this->db->where('status',1)->count_all_results('city'); ?></span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-grow-early">
            <a href="javascript:void(0)" class="widget-content-wrapper  text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Car</div>
                    <div class="widget-subheading"> </div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span><?= $this->db->where('status',1)->count_all_results('car'); ?></span></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-arielle-smile">
            <a href="javascript:void(0)" class="widget-content-wrapper  text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Users</div>
                    <div class="widget-subheading"> </div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>
                        <?= $this->db->get("user")->num_rows(); ?>
                    </span></div>
                </div>
            </a>
        </div>
    </div>
    
    <?php
        $start_date = $end_date = $type = "";
        if(isset($_GET["start_date"])){
            extract($_GET);
        }
    ?>
    <form class="row col-12" method="get">
        <div class="form-group col-3">
            <label>Start Date</label>
            <input type="date" value="<?= $start_date; ?>" name="start_date" class="form-control"/>
        </div>
        <div class="form-group col-3">
            <label>End Date</label>
            <input type="date" value="<?= $end_date; ?>" name="end_date" class="form-control"/>
        </div>
        <div class="form-group col-2">
            <label><br/></label>
            <button type="submit" class="btn btn-primary btn-block mt-0">Get Insights</button>
        </div>
    </form>
   
   <?php
        if(isset($_GET["start_date"])){
    ?>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-grow-early">
            <a href="javascript:void(0)" class="widget-content-wrapper  text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Arrivals</div>
                    <div class="widget-subheading"> </div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white">
                        <span><?= $this->db->where(["end >="=>$start_date, "end <="=>$end_date, 'status'=>1, 'payment_status'=>1])->count_all_results('booking'); ?></span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-midnight-bloom">
            <a href="javascript:void(0)" class="widget-content-wrapper  text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Departures</div>
                    <div class="widget-subheading"> </div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white">
                        <span><?= $this->db->where(["start >="=>$start_date, "start <="=>$end_date, 'status'=>1, 'payment_status'=>1])->count_all_results('booking'); ?></span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card mb-3 widget-content bg-arielle-smile">
            <a href="javascript:void(0)" class="widget-content-wrapper  text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Total Reveue</div>
                    <div class="widget-subheading"> </div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white">
                        <?php
                            $where = ["start >="=>$start_date, "end <="=>$end_date, 'status'=>1, 'payment_status'=>1];
                            $this->db->select("SUM(final_car_price) as fprice, SUM(gst) as tgst, SUM(home_delivery_charges) as hdc, SUM(total_payable) as tp");
                            $sum = $this->db->get_where("booking", $where)->row();
                        ?>
                        <!--<span>INR <?= $sum->fprice+$sum->tgst+$sum->hdc; ?></span>-->
                        <span>INR <?= $sum->tp; ?></span>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php
        }
    ?>
   
</div>

</div>