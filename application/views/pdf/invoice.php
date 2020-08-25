<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <br><br>
        <table style="width:100%">
            <tr>
                <td style="font-size: 25px; text-align: center; font-weight: bold; color: #6e6e6e;">
                   INVOICE
                </td>
            </tr>
        </table>
        <br>
        <table style="width:100%">
            <tr>
                <td style="font-size: 25px;">
                    
                </td>
                <td align="right">
                    <table  style="width:100%">
                        <tr>
                            <td align="right"><b>Invoice</b> : #<?= $invoice['inv'] ?> </td>
                        </tr>
                        <tr>
                            <td align="right"><b>Client</b> : #<?= $this->general_model->_get_client($invoice['client'])['c_id'] ?> </td>
                        </tr>
                        <tr>
                            <td align="right"><b>Date</b> : <?= vd($invoice['date']) ?> </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <br><br>
        <?php $client = $this->general_model->_get_client($invoice['client']); ?>
        <table style="width:100%">
            <tr>
                <th>
                   <b>To :  </b>
                </th>
            </tr>
            <tr>
                <td align="left">
                    <table style="width: 50%">
                        <tr>
                            <td align="left"><?= $client['fname'].' '.$client['mname'].' '.$client['lname'] ?> <?= $client['firm'] != ""?' ('.$client['firm'].')':'' ?></td>
                        </tr>
                        <tr>
                            <td align="left" style="font-size: 10px;"><?= $client['add1'] ?></td>
                        </tr>
                        <?php if($client['add2'] != ""){ ?>
                            <tr>
                                <td align="left" style="font-size: 10px;"><?= $client['add2'] ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td align="left" style="font-size: 10px;"><?=  $this->general_model->_get_area($client['area'])['name'] ?>, <?= $this->general_model->_get_city($client['city'])['name'] ?>, <?= $this->general_model->_get_district($client['district'])['name'] ?>, <?= $this->general_model->_get_state($client['state'])['name'] ?> <?= $client['pin'] != ''?",".$client['pin']:''; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <br><br>
        <?php $details = $this->db->get_where('invoice_details',['invoice' => $invoice['id']])->result_array(); ?>
        <table style="width: 100%; background-color: #6e6e6e; color: #fff; border-bottom: 1px solid #ddd;" cellpadding="5px;">
            <tr>
                <td style="width: 5%; text-align: center;"><b>SN</b></td>
                <td style="width: 50%;"><b>Particulars</b></td>
                <td style="width: 10%; text-align: center;"><b>Qty</b></td>
                <td style="width: 15%; text-align: right;"><b>Price</b></td>
                <td style="width: 20%; text-align: right;"><b>Total</b></td>
            </tr>
        </table>

        <?php foreach($details as $key => $value){ ?>
            <table style="width: 100%; border-bottom: 1px solid #ddd;" cellpadding="5px;">
                <tr>
                    <td style="width: 5%; text-align: center;"><?= $key + 1 ?></td>
                    <td style="width: 50%; font-size: 11px;"><?= $this->general_model->_get_service($value['service'])['name'] ?></td>
                    <td style="width: 10%; text-align: center;"><?= $value['qty'] ?></td>
                    <td style="width: 15%; text-align: right;"><?= $value['price'] ?></td>
                    <td style="width: 20%; text-align: right;"><?= $value['total'] ?></td>
                </tr>
            </table>
        <?php } ?>

        <?php 
        if(count($details) < 11){
            for ($i=1; $i <= 2; $i++) {  ?>
                <table style="width: 100%; border-bottom: 1px solid #ddd;" cellpadding="5px;">
                    <tr>
                        <td style="width: 10%; text-align: center; height: 5px;"></td>
                        <td style="width: 55%;"></td>
                        <td style="width: 15%; text-align: center;"></td>
                        <td style="width: 20%; text-align: right;"></td>
                    </tr>
                </table>
            <?php
        } } ?>


        <table style="width: 100%; background-color: #6e6e6e; color: #fff; border-bottom: 1px solid #ddd;" cellpadding="5px;">
            <tr>
                <td style="width: 10%; text-align: center;"></td>
                <td style="width: 55%; text-align: center;"></td>
                <td style="width: 15%; text-align: center;"><b>Total : </b></td>
                <td style="width: 20%; text-align: right;"><b>Rs. <?= $invoice['total'] ?></b></td>
            </tr>
        </table>

        <br><br>
        <?php if(!empty($invoice['remarks'])){ ?>
            <table style="width: 100%; border-bottom: 1px solid #ddd;">
                <tr>
                    <td style="font-size: 12px;">Remarks</td>
                </tr>
                <tr>
                    <td style="font-size: 10px;">
                        <table style="width: 100%;">
                            <tr>
                                <td>
                                    <?= $invoice['remarks'] ?>            
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </table>
            <br><br>
        <?php } ?>



        <table style="width: 100%; border-bottom: 1px solid #ddd;" cellpadding="5px;">
            <tr>
                <td colspan="2" style="font-size: 12px;">Company's Bank Details</td>
            </tr>
            <tr>
                <td style="width: 50%;">
                    <table style="width: 100%;">
                        <tr>
                            <td><b>Bank</b></td>
                            <td><?= $this->general_model->_get_company($invoice['company'])['bank'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Account Holder Name</b></td>
                            <td><?= $this->general_model->_get_company($invoice['company'])['ac_name'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Account Number</b></td>
                            <td><?= $this->general_model->_get_company($invoice['company'])['ac_no'] ?></td>
                        </tr>
                        <tr>
                            <td><b>IFSC Code</b></td>
                            <td><?= $this->general_model->_get_company($invoice['company'])['ifsc'] ?></td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%;">
                    <table style="width: 100%; text-align: center;">
                        <tr>
                            <td align="center">
                                GOOGLE PAY | PHONE PAY | PAYTM
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 15px;" align="center">
                                <?= $this->general_model->_get_company($invoice['company'])['upi'] ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>    

        <br><br>

        

        <table style="width: 100%">
            <tr>
                <td>Have a Great Day!!!</td>
                <td style="text-align: right;">
                    <b>For, <?= $this->general_model->_get_company($invoice['company'])['name'] ?></b>
                </td>
            </tr>
        </table>
        <br><br>
        <table style="width: 100%">
            <tr>
                <td align="center" style="font-style: italic; font-size: 10px; ">This is computer generated invoice doesn't required signature</td>
            </tr>
        </table>
    </body>
</html>