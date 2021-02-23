<div class="dasheboard">        <div class="row-fluid">        <div class="span12">            <div class="box">                <header>                    <div class="icons"><i class="fa fa-truck" style="font-size: 20px; color: #0066cc;"></i></div>                    <h5 style="font-size: 18px; font-weight: bold;">Last 10 Orders</h5>                </header>                <div id="collapse4" class="body">                    <table id="dataTable_CMS" class="table table-bordered table-condensed table-hover table-striped">                        <thead>                            <tr>                                <!--<th>SI</th>-->                                <th>Invoice No</th>                                <th>Customer Name</th>                                <th>Product  </th>                                <th>Delivery date </th>                                <th>Collection Date</th>                                <th>Total amount</th>                            </tr>                        </thead>                        <tbody><?php foreach ($invoice as $item) { ?><?php // foreach ($transactions as $trans) { ?>                                                         <?php                            $file_path = str_replace('\\', '/', realpath(APPPATH . '../')) . '/assets/uploads/invoice';                            $file_name = 'Invoice' . $item->invoice_no . '.pdf';                            $full_path = $file_path . '/' . $file_name;                            ?>                                                                                      <tr><!--                                    <td><?php // echo $ind + 1; ?></td>-->                                    <!--<td><?php // echo $trans->invoice_no;?></td>-->                              <td><a href="<?php echo site_url("/assets/uploads/invoice/$file_name") ?>" target="_blank"><?php echo $item->invoice_no; ?></a></td>                                <td><?php echo $item->customer_name;?></td>                                    <td><?php echo $item->product_titles; ?></td>                                    <td><?php echo $item->delivery_date; ?></td>                                    <td><?php echo $item->collection_date ?></td>                                    <td>$<?php echo $item->total_amount ?></td>                                </tr>                            <?php } ?>                            <?php // } ?><?php if (empty($order)) { ?>                                <tr>                                    <td colspan="3">No record found.</td>                                </tr><?php } ?>                        </tbody>                    </table>                </div>            </div>        </div>    </div>    <!--<div class="row-fluid">-->    <div class="row-fluid">               <div class="span12">            <div class="box">                <header>                    <div class="icons"><i class="fa fa-usd" style="font-size: 20px; color: #0066cc;"></i></div>                    <h5 style="font-size: 18px; font-weight: bold;">Last 10 Transactions</h5>                </header>                <div id="collapse4" class="body">                    <table id="dataTable_CMS" class="table table-bordered table-condensed table-hover table-striped">                        <thead>                            <tr>                                <!--<th>SI</th>-->                                <!--<th>Transaction ID </th>-->                                <!--<th>Order Id</th>-->                                <!--<th>Customer Id</th>-->                                <th>Customer Name</th>                                                                <th>Transaction Type</th>                                <th>Total Amount</th>                                <!--<th>Status</th>-->                            </tr>                        </thead>                        <tbody><?php foreach ($transactions as $ind => $item) { ?>                                <tr>                                    <!--<td><?php // echo $ind + 1; ?></td>-->                                    <!--<td><?php // echo $item->id ?></td>-->                                  <!--<td><?php // echo $item->order_id ?></td>-->                                    <!--<td><?php // echo $item->user_id; ?></td>-->                                    <td><?php echo $item->customer_name ?></td>                                                                       <td><?php echo $item->transaction_type ?></td>                                    <td>$<?php echo $item->total_amount; ?></td><!--                                    <td><?php // if($item->status==1)//                                        echo 'Successfull';//                                    Celse //                                        echo'Unsuccesfull';                                        ?></td>-->                                                                                                                                                                               </tr>                            <?php } ?><?php if (empty($transactions)) { ?>                                <tr>                                    <td colspan="3">No record found.</td>                                </tr><?php } ?>                        </tbody>                    </table>                </div>            </div>        </div>    </div>    <div class="row-fluid">        <div class="span12">            <div class="box">                <header>                    <div class="icons"><i class="fa fa-users" style="font-size: 20px; color: #0066cc;"></i></div>                    <h5 style="font-size: 18px; font-weight: bold;">Last 10 Customer's</h5>                </header>                <div id="collapse4" class="body">                    <table id="dataTable_CMS" class="table table-bordered table-condensed table-hover table-striped">                        <thead>                            <tr>                                <!--<th>SI</th>-->                                <th>Customer Name</th>                               <!--  <th>Campaigns</th> -->                                <th>Email</th>                                <th>Address</th>   <!--                            <th>Status</th>--><!--                                <th>Created</th>-->                            </tr>                        </thead>                        <tbody>                            <?php foreach ($users as $ind => $item) { ?>                                <tr>                                    <!--<td><?php // echo $ind + 1; ?></td>-->                                    <td><a href="<?php echo site_url('admin/users/user_list/' . $item->id); ?>"><?php echo $item->username; ?></td>                                    <td><?php echo $item->email; ?></td>                                     <td><?php echo $item->address; ?></td>   <!--                                    <td><a href="<?php // echo site_url('admin/users/user_list/' . $item->id); ?>"><?php // echo $item->fname . ' ' . $item->lname; ?></a></td>-->                                    <!-- <td><a href="<?php //echo '#';//echo site_url(CPREFIX . "/campaign/add/" . $item->id)  ?>"><?php // $camp = $this->Campaign->row(array('conditions'=>array('user_id' => $item->id))); if(!empty($camp)){//echo $camp->title;}  ?></a></td> -->    <!--                                <td><?php // echo $item->email;  ?></td>-->                                    <!--<td><?php // echo ($item->is_active == 1) ? 'Active' : 'Inactive';  ?></td>--><!--                                    <td><?php // $d = strtotime($item->created);//                            echo date("d", $d) . ' ' . date("M", $d) . ' ' . date("Y", $d); ?></td>-->                                </tr>                            <?php } ?><?php if (empty($users)) { ?>                                <tr>                                    <td colspan="3">No record found.</td>                                </tr><?php } ?>                        </tbody>                    </table>                </div>            </div>        </div>    </div></div>   