
<div class="row-fluid">
        <div class="span12">
            <div class="box">
                <header>
                    <div class="icons"><i class="icon-truck" style="font-size: 20px; color: #0066cc;"></i></div>
                    <h5 style="font-size: 18px; font-weight: bold;">PayPal Transactions</h5>
                </header>
                <div id="collapse4" class="body">
                    <table id="dataTable_CMS" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                            <tr>
                                <th>SI</th>
                                <th>Transaction ID </th>
                                <th>Item Name</th>
                                <th>Payer Email</th>
                                <th>Full Name</th>
                               
                                 <th>Amount</th>
                                <th>Payment Fee</th>
                                <th>Currency</th>
                                
                                  <th>Country</th>
                                <th>Transaction Id </th>
                                <th>Transaction Type</th>
                                
                                 <th>Payer Id </th>
                                <th>Payment Status  </th>
                                <th>Payment Type</th>
                                <th>Create Date  </th>
                                <th>Payment Date</th>
                                
                                
                                

                            </tr>
                        </thead>
                        <tbody>
<?php foreach ($paypal as $ind => $item) { ?>
                                <tr>
                                    <td><?php echo $ind + 1; ?></td>
                                    <td><?php echo $item->TID ?></td>
                                  <td><?php echo $item->item_name ?></td>
                                    <td><?php echo $item->payer_email; ?></td>
                                   <td><?php echo $item->first_name.' '.$item->last_name; ?></td>
                                   
                                    <td>$<?php echo $item->amount ?></td>
                                    <td>$<?php echo $item->payment_fee; ?></td>
                                    <td><?php echo $item->currency; ?></td>
                                    <td><?php echo $item->country ?></td>
                                    <td><?php echo $item->txn_id; ?></td>
                                    <td><?php echo $item->txn_type ?></td>
                                   
                                    <td><?php echo $item->payer_id ?></td>
                                    <td><?php echo $item->payment_status; ?></td>
                                    <td><?php echo $item->payment_type; ?></td>
                                    
                                    <td><?php echo $item->create_date; ?></td>
                                    <td><?php echo $item->payment_date; ?></td>
                                   
                                </tr>
                            <?php } ?>
<?php if (empty($paypal)) { ?>
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