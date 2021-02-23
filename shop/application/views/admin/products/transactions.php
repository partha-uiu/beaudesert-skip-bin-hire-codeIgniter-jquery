
<div class="row-fluid">
        <div class="span12">
            <div class="box">
                <header>
                    <div class="icons"><i class="fa fa-usd" style="font-size: 20px; color: #0066cc;"></i></div>
                    <h5 style="font-size: 18px; font-weight: bold;">Transactions</h5>
                </header>
                <div id="collapse4" class="body">
                    <table id="dataTable_CMS" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th>SI</th>
                                <th>Transaction ID </th>
                                <th>Order Id</th>
                                <th>User Id</th>
                                <th>Customer Name</th>
                               
                                 <th>Transaction Type</th>
                                <th>Total Amount</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
<?php foreach ($transactions as $ind => $item) { ?>
                                <tr>
                                    <td><?php echo $ind + 1; ?></td>
                                    <td><?php echo $item->transaction_id ?></td>
                                  <td><?php echo $item->order_id ?></td>
                                    <td><?php echo $item->user_id; ?></td>
                                    <td><?php echo $item->customer_name ?></td>
                                   
                                    <td><?php echo $item->transaction_type ?></td>
                                    <td><?php echo $item->total_amount; ?></td>
                                    <td><?php echo $item->status; ?></td>
                                    
                                    
                                    
                                   
                                </tr>
                            <?php } ?>
<?php if (empty($transactions)) { ?>
                                <tr>
                                    <td colspan="3">No record found.</td>
                                </tr>
<?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>