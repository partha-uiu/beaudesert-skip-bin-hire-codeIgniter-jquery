<?php

ob_start();
// we can have any view part here like HTML, PHP etc
?>    

<style>
            table , th , tr , td {
                border: 1px solid grey;
            }
           .habijabi ul {
                list-style: none !important;
            }
            .print-order-total {
                float: right;
                text-align: right;
                margin-top: 25px;
            }
</style>

 <div id="product-show-area">
    <div class="container cart-area">
        <!-- content area -->
        <div>
            <div>
                <h1 style="text-align: center;">Beaudesert Area Skip Bin Hire</h1>
                <p style="text-align: center;"><b>ABN 18 102 736 185</b></p>
            </div>
            <div class="habijabi" style="margin-left: -40px;">
                <ul>
                    <li>
                        <b>Invoice No:</b>
                        <span><?php echo $transactions->invoice_no; ?></span>
                    </li>
                    <li>
                        <b>Customer Name:</b>
                        <span><?php echo $user->username; ?></span>
                    </li>
                    <li>
                        <b>Customer Email:</b>
                        <span><?php echo $user->email; ?></span>
                    </li>
                    <li>
                        <b>Company Name:</b>
                        <span><?php echo $user->company_name; ?></span>
                    </li>
                    <li>
                        <b>Postcode:</b>
                        <span><?php echo $user->postcode; ?></span>
                    </li>
                    <li>
                        <b>Suburb:</b>
                        <span><?php echo $user->suburb; ?></span>
                    </li>
                    <li>
                        <b>Delivery Address:</b>
                        <span><?php echo $user->address; ?></span>
                    </li>
                </ul>
            </div>
    <div class-="table-container">

      <table class="viewTable" style="width: 100%;">

        <thead class="view">
            <tr>
                <th><b>Waste Bin Size</b></th>                
                <th><b>Waste Type</b></th>
                <th><b>Bin Placement</b></th>
                <th><b>Delivery Date</b></th>
                <th><b>Collection Date</b></th>
                <th><b>Transaction Type</b></th>                             
                <th><b>Price</b></th>                             
            </tr>
        </thead>
      <tbody> 

            <?php foreach ($all_order as $order) :?>
                    <tr>     
                        <td><?php echo $order->product_title;?></td> 
                        <td><?php echo $order->p_type; ?></td>
                        <td><?php echo $order->bin_placement; ?></td>
                        <td><?php echo $order->delivery_date; ?></td>                                               
                        <td><?php echo $order->collection_date; ?></td>
                        <td><?php echo $transactions->transaction_type; ?></td>
                        <td><?php echo $order->total_amount; ?></td>
                        
                    </tr>
            <?php endforeach;?>

        </tbody>

    </table>
            </div>
        </div><!-- end content area -->

                <div class="print-order-total">
                    <b>Order Total(GST Inclusive) : <?php echo '$'.$transactions->total_amount;?></b>
                </div>

    </div>   
</div>
 <?php
$content = ob_get_contents();
ob_end_clean();
$file_path = str_replace('\\', '/',  realpath(APPPATH .'../')) .'/assets/uploads/invoice';
if(!file_exists($file_path)){
    @mkdir($file_path, 0777, true);
}


$file_name = 'Invoice'.$transactions->invoice_no.'.pdf';
$full_path = $file_path. '/' .$file_name;
if(!file_exists($full_path)){
 
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Tax Invoice";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('helvetica');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('helvetica', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
$obj_pdf->writeHTML($content, true, false, true, false, '');

////$obj_pdf->Output($_SERVER['DOCUMENT_ROOT'].'/'.'Invoice'.$transactions->invoice_no.'.pdf', 'FD');
//$obj_pdf->Output($_SERVER['DOCUMENT_ROOT'].'/'.'Invoice.pdf', 'FD');
$obj_pdf->Output($full_path, 'F');

redirect(current_url());
} ?>
    <!------------------------------->
<?php

echo $content;
?>
    <a target="_blank" href="<?php echo site_url("/assets/uploads/invoice/$file_name") ?>">
    <div style="float: right; width: 138px; padding: 8px 10px 1px; border: 1px #d9d9d9 solid; border-radius: 5px; margin: 10px 50px 10px 0;">
        <p>Download Invoice</p>
    </div>
</a>
    

