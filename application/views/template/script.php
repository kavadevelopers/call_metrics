<script type="text/javascript">
	$(document).ready(function() {
		if (!Notification) {
		  	alert('Desktop notifications not available in your browser. Try Chromium.');
		 	return;
		}
		if (Notification.permission !== 'granted'){
		  	Notification.requestPermission();
		}
	});
	function notifyMe(title,string,link) {
 		if (Notification.permission !== 'granted')
  			Notification.requestPermission();
 		else {
  			var notification = new Notification(title, {
	   			icon: '<?= base_url() ?>asset/images/favicon.ico',
	   			body: string,
	  		});
	  		notification.onclick = function() {
	   			window.open(link);
	  		};
 		}
	}
	$(function () {
		$('.btn-delete').click(function() {
			if(confirm('Are you sure you want to delete this?')){
				return true;
			}
			return false;
		})

		$('.table-dt').DataTable({
            "dom": "<'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            
        });

        $('.select2').select2();
	})
</script>

<script type="text/javascript">
	$(function(){
		$(document).on('keyup','.mobile-key-up', function(){
			if($('.mobile-body').children().last().val() != ""){
				var textbox = '<input type="text" name="mobile[]" class="form-control form-control-sm numbers m-t2 mobile-key-up" autocomplete="off" maxlength="10" placeholder="Mobile" minlength="10">';
				$('.mobile-body').append(textbox);
			}
		});

		$(document).on('keyup','.email-key-up', function(){
			if($('.email-body').children().last().val() != ""){
				var textbox = '<input type="email" name="email[]" class="form-control form-control-sm email-key-up m-t2" autocomplete="off" placeholder="Email">';
				$('.email-body').append(textbox);
			}
		});

		$(document).on('change','.service-change', function(){
			if($(this).val() != ""){
				$('.amount-body').children().eq(($(this).index() / 2)).val($(this).val().split("-")[1]);
			}else{
				$('.amount-body').children().eq(($(this).index() / 2)).val("");
			}
			if($('.service-body select').last().val() != ""){
				textbox = '<select class="form-control form-control-sm service-change m-t2 select2" name="services[]">';
					textbox += '<option value="">-- Select Service --</option>';
					textbox += '<?php foreach ($this->general_model->get_services() as $sekey => $sevalue) { ?>';
					textbox += '<option value="<?= $sevalue['id'] ?>-<?=$sevalue['price']?>"><?= $sevalue['name'] ?></option>';
					textbox += '<?php } ?>';	                    					
				textbox += '</select>';	                    					        				
				$('.service-body').append(textbox);
				$('.select2').select2();
				$('.select2-container').addClass('m-t2');
				textbox = '<input type="text" name="amount[]" class="form-control form-control-sm decimal-num mobile-key-up m-t2" autocomplete="off" placeholder="Amount" >';
				$('.amount-body').append(textbox);
			}
		});	

		$(document).on('change','.cus-service-change', function(){
			if($(this).val() != ""){
				$('.cus-amount-body').children().eq(($(this).index() / 2)).val($(this).val().split("-")[1]);
				$('.cus-qty-body').children().eq(($(this).index() / 2)).val(1);
			}else{
				$('.cus-amount-body').children().eq(($(this).index() / 2)).val("");
				$('.cus-qty-body').children().eq(($(this).index() / 2)).val("");
			}
			if($('.cus-service-body select').last().val() != ""){
				textbox = '<select class="form-control form-control-sm cus-service-change m-t2 select2" name="services[]">';
					textbox += '<option value="">-- Select Service --</option>';
					textbox += '<?php foreach ($this->general_model->get_services() as $sekey => $sevalue) { ?>';
					textbox += '<option value="<?= $sevalue['id'] ?>-<?=$sevalue['price']?>"><?= $sevalue['name'] ?></option>';
					textbox += '<?php } ?>';	                    					
				textbox += '</select>';	                    					        				
				$('.cus-service-body').append(textbox);
				$('.cus-service-change').select2();
				$('.select2-container').addClass('m-t2');
				textbox = '<input type="text" name="amount[]" class="form-control form-control-sm decimal-num mobile-key-up m-t2" autocomplete="off" placeholder="Amount" >';
				$('.cus-amount-body').append(textbox);

				textbox = '<input type="text" name="qty[]" class="form-control form-control-sm numbers m-t2" value="" autocomplete="off" placeholder="Quantity">';
				$('.cus-qty-body').append(textbox);
			}
		});	

		$(document).on('change','.language-change', function(){
			if($('.language-body').children().last().val() != ""){
				textbox = '<select class="form-control form-control-sm language-change m-t2" name="prefered_language[]">';
					textbox += '<option value="">-- Select --</option>';
					textbox += '<option value="English">English</option>';
                    textbox += '<option value="Hindi">Hindi</option>';
                    textbox += '<option value="Gujarati">Gujarati</option>';
				textbox += '</select>';	                    					        				
				$('.language-body').append(textbox);
			}
		});	

		$(document).on('keyup','.from-keyup', function(){
			if($('.from-to-body').children('.from-keyup').last().val() != ""){
				var textbox = ' <input name="from[]" type="text" placeholder="From" class="form-control form-control-sm col-md-6 from-keyup m-t2" value="">';
                 	textbox += '<input name="to[]" type="text" placeholder="To" class="form-control form-control-sm col-md-6 m-t2" value="">';
				$('.from-to-body').append(textbox);
			}
		});

		$(document).on('keyup','.landline-key-up', function(){
			if($('.landline-body').children().last().val() != ""){
				var textbox = '<input type="text" name="landline[]" class="form-control form-control-sm numbers landline-key-up m-t2" autocomplete="off" placeholder="Landline" minlength="5" maxlength="11">';
				$('.landline-body').append(textbox);
			}
		});

		$(document).on('keyup','.from-to-time', function(){
			if($('.time-body').children().last().val() != ""){
				var textbox = '<input name="time_to_call[]" type="text" placeholder="Add From To Time Here" class="form-control form-control-sm from-to-time m-t2" value="" >';
				$('.time-body').append(textbox);
			}
		});

		$(document).on('change','.additional-info-change', function(){
			if($('.body-additional-info tr:last td:first').children('.additional-info-change').val() != ""){
				textbox = '<tr><td>';
					textbox += '<select class="form-control form-control-sm additional-info-change" name="industry[]">';
					textbox += '<option value="">-- Select Industry --</option>';
					textbox += '<?php foreach ($this->general_model->list_industries() as $key => $value) { ?>';
                        textbox += '<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>';
                    textbox += '<?php } ?>';
                	textbox += '</select></td>';
                textbox += '<td><select class="form-control form-control-sm" name="sub_industry[]">';
                    textbox += '<option value="">-- Select Sub Industry --</option>';
                    textbox += '<?php foreach ($this->general_model->list_subindustry() as $key => $value) { ?>';
                        textbox += '<option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>';
                    textbox += '<?php } ?>';
                textbox += '</select></td>';
                textbox += '<td><textarea class="form-control" name="ind_remarks[]" placeholder="Remarks"></textarea></td>';
                    textbox += '<td class="text-center">';
                    textbox += '<button type="button" class="btn btn-danger btn-mini remove-row"><i class="fa fa-remove"></i></button></td></tr>';
                                            
                $('.body-additional-info').append(textbox);
			}
		});

		$(document).on('click','.remove-row', function(){
			$(this).closest('tr').remove();
		});

		$(document).on('click','.transfer-lead',function(){
			$('#lead_transfer_model').modal('show');
			$('.select2n').select2({
			    dropdownParent: $('#lead_transfer_model .modal-content')
			});
			$('#lead_tranfer_id').val($(this).data('lead'));
		});

		$(document).on('click','.add-attechment-row',function(){
			textbox = '<tr>';
				textbox += '<td><input type="text" name="fileName[]" class="form-control" placeholder="File Name"></td>';
				textbox += '<td><input type="file" name="file[]" class="form-control fileupload-change" onchange="readFile(this)"></td>';
				textbox += '<td class="text-center"><button type="button" class="btn btn-danger btn-mini remove-row"><i class="fa fa-remove"></i></button></td>';
			textbox += '</tr>';
			$('.body-attchment').append(textbox);
		});

		$(document).on('click','.add-attechment-row-client',function(){
			var last_id = parseFloat(($('.body-attchment-client tr:last').attr('id')).replace('docTr',''));
			last_id++;
			textbox = '<tr id="docTr'+last_id+'">';
				textbox += '<td>';
                    textbox += '<select class="form-control form-control-sm select2 docMainFolder" id="docFolder'+last_id+'" name="folder[]" required>';
                        textbox += '<option value="">-- Select Folder Name --</option>';
                        textbox += '<?php foreach ($this->general_model->get_folder_name() as $key => $value) { ?>';
                            textbox += '<option value="<?= $value['id'] ?>" data-sub="<?= $this->general_model->getSubFolders($value['id']) ?>"><?= $value['name'] ?></option>';
                        textbox += '<?php } ?>';
                    textbox += '</select>';
                textbox += '</td>';
                textbox += '<td>';
                	textbox += '<select class="form-control form-control-sm select2 docSubFolder" id="docSubFolder'+last_id+'" name="sub_folder[]" required>';
                        textbox += '<option value="">-- Select Sub-Folder Name --</option>';
                    textbox += '</select>';
                textbox += '</td>';
				textbox += '<td><input type="text" name="fileName[]" class="form-control" placeholder="File Name"></td>';
				textbox += '<td><input type="file" name="file[]" class="form-control fileupload-change" onchange="readFile(this)"></td>';
				textbox += '<td class="text-center"><button type="button" class="btn btn-danger btn-mini remove-row"><i class="fa fa-remove"></i></button></td>';
			textbox += '</tr>';

			$('.body-attchment-client').append(textbox);
			$('.select2').select2();
		});

		$(document).on('change','.docMainFolder',function(){
			main_id = ($(this).attr('id')).replace('docFolder','');
			if($(this).val() != ""){
				json = $('#docFolder'+main_id+' option:selected').data('sub');
				var str = '<option value="">-- Select Sub-Folder Name --</option>';
                $.each(json, function(index) {
                    str += '<option value="'+json[index].id+'">'+json[index].name+'</option>';
                });
                $('#docSubFolder'+main_id).select2('destroy');
                $('#docSubFolder'+main_id).html(str);
                $('#docSubFolder'+main_id).select2();
			}else{
				var str = '<option value="">-- Select Sub-Folder Name --</option>';
				$('#docSubFolder'+main_id).select2('destroy');
                $('#docSubFolder'+main_id).html(str);
                $('#docSubFolder'+main_id).select2();
			}
		});

		$(document).on('change','.gst_client',function(){
			_this = $(this);
			if(_this.val() == "YES"){
				$('.gst_type_div').show();
				$('.gst_type').val('');
				$('.gst_type').attr('required',true);
			}else{
				$('.gst_type_div').hide();
				$('.gst_type').val('');
				$('.gst_type').removeAttr('required');
				$('.month_quater_div').hide();
				$('.month_quater').removeAttr('required');
			}
		});

		$(document).on('change','.gst_type',function(){
			_this = $(this);
			if(_this.val() == "REGULAR"){
				$('.month_quater_div').show();
				$('.month_quater').val('');
				$('.month_quater').attr('required',true);
			}else{
				$('.month_quater_div').hide();
				$('.month_quater').val('');
				$('.month_quater').removeAttr('required');
			}
		});

		$(document).on('click', '.remove-file-lead', function(event) {
			if(confirm('Are you sure want to delete this?')){
				id = $(this).data('id');
				athis = $(this); 
				
				$.ajax({
	                type: "POST",
	                url : "<?= base_url('leads/file_delete'); ?>",
	                data : "id="+id,
	                cache : false,
	                beforeSend: function() {
	                    PNOTY('Please Wait','info');     
	                },
	                success: function(out)
	                {
	                	athis.closest(".remove-file").remove();
	                	PNOTY("File Deleted",'success');     	
	                }
                });
			}
		});

		$(document).on('click', '.remove-file-client', function(event) {
			if(confirm('Are you sure want to delete this?')){
				id = $(this).data('id');
				athis = $(this); 
				
				$.ajax({
	                type: "POST",
	                url : "<?= base_url('client/file_delete'); ?>",
	                data : "id="+id,
	                cache : false,
	                beforeSend: function() {
	                    PNOTY('Please Wait','info');  
	                    athis.html('<i class="fa fa-circle-o-notch fa-spin"></i>');   
	                },
	                success: function(out)
	                {
	                	athis.html('<i class="fa fa-trash"></i>');
	                	athis.closest(".remove-doc-tr").remove();
	                	PNOTY("File Deleted",'success');     	
	                }
                });
			}
		});

		$(document).on('click', '.add-followup', function(event) {
			_this = $(this);
			_this.html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
			$("#id_followup_lead").val(_this.data('id'));
			$("#type_followup_lead").val(_this.data('type'));
			$('#message_followup').val(_this.data('stop'));
			$.ajax({
                type: "POST",
                url : "<?= base_url('followup/get'); ?>",
                data : "id="+_this.data('id')+"&type="+_this.data('type'),
                dataType: "JSON",
                cache : false,
                beforeSend: function() {
                    
                },
                success: function(out)
                {
                	_this.html('<i class="fa fa-question"></i>');
                	$('#followup_model').modal('show');
                	$('#followup_body').empty();
                	$('#followup_body').append(out[0]);
                	if(out[0] != ""){
						$('#followup_table').show();
					}else{
						$('#followup_table').hide();
					}
					$('#type_followup_cus').val(out[1]);
                }
            });
		});

		$(document).on('click', '.add-job-followup', function(event) {
			_this = $(this);
			_this.html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
			$('#jobFollowupThis').val(_this);
			$("#id_jobModel").val(_this.data('id'));
			$("#type_followup_job").val(_this.data('type'));
			$('#message_followup_job').val(_this.data('stop'));
			$('#jobStatus').val(_this.data('status'));
			if(_this.data('status') >= 3){
				$('#hideJobFollowupForm').hide();
			}
			$.ajax({
                type: "POST",
                url : "<?= base_url('followup/job_get'); ?>",
                data : "id="+_this.data('id')+"&type="+_this.data('type'),
                dataType: "JSON",
                cache : false,
                beforeSend: function() {
                    
                },
                success: function(out)
                {
                	_this.html('<i class="fa fa-question"></i>');
                	$('#job_followup_modal').modal('show');
                	$('#jobfollowup_body').empty();
                	$('#jobfollowup_body').append(out[0]);
                	if(out[0] != ""){
						$('#jobfollowup_table').show();
					}else{
						$('#jobfollowup_table').hide();
					}
					$('#type_followup_jobdone').val(out[1]);
                }
            });
		});		

		$('#followupForm').submit(function(event) {
			event.preventDefault();
			if($('#type_followup_cus').val() != '1'){
				if($("#customer_checkbox").prop('checked') == true){
				    cus = 1;
				}else{
					cus = '';
				}
				$.ajax({
	                type: "POST",
	                url : "<?= base_url('followup/save'); ?>",
	                data : "cus="+cus+"&remarks="+$('#followup_remarks').val()+"&date="+$('#followup_date').val()+"&ftime="+$('#followup_timef').val()+"&ttime="+$('#followup_timet').val()+"&id="+$('#id_followup_lead').val()+"&type="+$('#type_followup_lead').val(),
	                cache : false,
	                dataType: "JSON",
	                beforeSend: function() {
	                    $('#followup_save').attr('disabled','true');
	                    $('#followup_save').html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
	                },
	                success: function(out)
	                {
	                	PNOTY("Followup Saved",'success');  
	                	$('#followup_save').removeAttr('disabled');
	                    $('#followup_save').html('Save');
	                    $('#followup_remarks').val("");
	                    $('#followup_time').val("");
	                    if($("#customer_checkbox").prop('checked') == true){
						    $('#customer_checkbox').prop('checked', false);
						}
						$('#followup_body').prepend(out[0]);
						$('#followup_table').show();
						$('#type_followup_cus').val(cus);

						$('#fdate-'+$('#id_followup_lead').val()).html(out[1]);
						if(cus == 1){
							$('#tr-lead-'+$('#id_followup_lead').val()).remove();
						}
						$('#followup_timef').val('');
						$('#followup_timet').val('');
	                }
	            });
			}else{
				PNOTY($('#message_followup').val(),'error');  
			}
		});

		$(document).on('click', '.add-payment-followup', function(event) {
			_this = $(this);
			_this.html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
			$("#id_paymentModel").val(_this.data('id'));
			$.ajax({
                type: "POST",
                url : "<?= base_url('followup/payment_get'); ?>",
                data : "id="+_this.data('id')+"&type=payment",
                dataType: "JSON",
                cache : false,
                beforeSend: function() {
                    
                },
                success: function(out)
                {
                	_this.html('<i class="fa fa-question"></i>');
                	$('#payment_followup_modal').modal('show');
                	$('#paymentfollowup_body').empty();
                	$('#paymentfollowup_body').append(out[0]);
                	if(out[0] != ""){
						$('#paymentfollowup_table').show();
					}else{
						$('#paymentfollowup_table').hide();
					}
                }
            });
		});		
		
		$('#paymentfollowupForm').submit(function(event) {
			event.preventDefault();
			if($("#payment_done").prop('checked') == true){
			    cus = 1;
			}else{
				cus = '';
			}
			$.ajax({
                type: "POST",
                url : "<?= base_url('followup/payment_save'); ?>",
                data : "cus="+cus+"&remarks="+$('#payment_followup_remarks').val()+"&date="+$('#payment_followup_date').val()+"&id="+$('#id_paymentModel').val()+"&type=payment",
                cache : false,
                dataType: "JSON",
                beforeSend: function() {
                    $('#payment_followup_save').attr('disabled','true');
                    $('#payment_followup_save').html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
                },
                success: function(out)
                {
                	PNOTY("Followup Saved",'success');  
                	$('#payment_followup_save').removeAttr('disabled');
                    $('#payment_followup_save').html('Save');
                    $('#payment_followup_remarks').val("");
                    if($("#payment_done").prop('checked') == true){
					    $('#payment_done').prop('checked', false);
					}
					$('#paymentfollowup_body').prepend(out[0]);
					$('#paymentfollowup_table').show();
					$('#payment_followup_date').val('');
					$('#tr_payment-date'+$('#id_paymentModel').val()).html(out[1]);
					if(cus == 1){
						$('#tr_payment-'+$('#id_paymentModel').val()).remove();
					}
                }
            });
		});

		$(document).on('change', '#followup_needed', function(event) {
			if($("#followup_needed").prop('checked') == true){
			    $('#followUpNeededJob').show();
			    $('#followup_date').attr('required',true);
			}else{
				$('#followUpNeededJob').hide();
				$('#followup_date').removeAttr('required');
			}
		});

		$('#jobfollowupForm').submit(function(event) {
			event.preventDefault();
			if($("#followup_needed").prop('checked') == true){
			    needed = 1;
			}else{
				needed = 0;
			}
			if($('#type_followup_jobdone').val() != '1'){				
				$.ajax({
	                type: "POST",
	                url : "<?= base_url('followup/saveJob'); ?>",
	                data : "remarks="+$('#followup_remarks').val()+"&date="+$('#followup_date').val()+"&ftime="+$('#followup_timef').val()+"&ttime="+$('#followup_timet').val()+"&id="+$('#id_jobModel').val()+"&type="+$('#type_followup_job').val()+"&status="+$('#jobStatus').val()+"&needed="+needed,
	                cache : false,
	                dataType: "JSON",
	                beforeSend: function() {
	                    $('#followup_save').attr('disabled','true');
	                    $('#followup_save').html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
	                },
	                success: function(out)
	                {
	                	PNOTY("Followup Saved",'success');  
	                	$('#followup_save').removeAttr('disabled');
	                    $('#followup_save').html('Save');
	                    $('#followup_remarks').val("");
	                    $('#followup_timef').val("");
	                    $('#followup_timet').val("");
	                    $('#followup_date').val("");
						$('#jobfollowup_body').prepend(out[0]);
						$('#jobfollowup_table').show();
						$('#status-'+$('#id_jobModel').val()).html(out[1]);
						if(needed == 1){
							$('#jobFolllowupDate'+$('#id_jobModel').val()).html(out[2]);
						}else{
							$('#jobFolllowupDate'+$('#id_jobModel').val()).html('NA');
						}
						$('#followup_timef').val('');
						$('#followup_timet').val('');
						$('#jobFollowupBtn_'+$('#id_jobModel').val()).data('status',$('#jobStatus').val());
	                }
	            });
			}else{
				PNOTY($('#message_followup_job').val(),'error');  
			}
		});

		$('#transferLeadAll').click(function(){
			if($(".checkBox:checked").length > 0){
				str = "";
				$('.checkBox:checked').each(function () {
			       	str += $(this).val()+"-";
			  	});
			  	$('#leads_transfer_model').modal('show');
			  	$('.select2n').select2({
				    dropdownParent: $('#leads_transfer_model .modal-content')
				});
			  	$('#leadIds').val(str.substring(0, str.length - 1));
			}else{
				PNOTY("Please Select any lead",'error');  
			}
		});

		$('#tranferJob').click(function () {
			if($(".checkBox:checked").length > 0){
				str = "";
				$('.checkBox:checked').each(function () {
			       	str += $(this).val()+"-";
			  	});
			  	$('#jobTransferModel').modal('show');
			  	$('.select2n').select2({
				    dropdownParent: $('#jobTransferModel .modal-content')
				});
				$('#typeJob').val($(this).data('type'));
			  	$('#jobIds').val(str.substring(0, str.length - 1));
			}else{
				PNOTY("Please Select any job",'error');  
			}
		});

		$(document).on('change','.occupation-onchange',function(){
			_this = $(this);
			if(_this.val() == "JOB" || _this.val() == "OTHER"){
				$('.industry-required').hide();
				$('.sub-industry-required').hide();
				$('.customer-industry-select2').select2('destroy');
				$('.customer-industry-select2').removeAttr('required');
				$('.customer-industry-select2').select2();
				$('.customer-sub-industry-select2').select2('destroy');
				$('.customer-sub-industry-select2').removeAttr('required');
				$('.customer-sub-industry-select2').select2();
			}else{
				$('.industry-required').show();
				$('.sub-industry-required').show();
				$('.customer-industry-select2').attr('required',true);
				$('.customer-industry-select2').select2();
				$('.customer-sub-industry-select2').attr('required',true);
				$('.customer-sub-industry-select2').select2();
			}
		});

		$('.edit-job').click(function(event) {
			$('#jobEditModal').modal('show');
			$('#editJobId').html("#"+$(this).data('job_id'));
			$('#jobEditService').val($(this).data('service'));
			$('#jobId').val($(this).data('job'));
			$('#jobEditPrice').val($(this).data('price'));
			$('#editJobImportance').val($(this).data('importance'));
			$('#jobEditClientName').html("Client - "+$(this).data('client'));
			$('#jobEditService').select2({
			    dropdownParent: $('#jobEditModal .modal-content')
			});
		});

		$('#addNewJob').click(function(event) {
			$('#add_job_model').modal('show');
			$('.select2n').select2({
			    dropdownParent: $('#add_job_model .modal-content')
			});
		});

		$('#addTask').click(function(event) {
			$('#addTaskModal').modal('show');
			$('.select2n').select2({
			    dropdownParent: $('#addTaskModal .modal-content')
			});
		});

		$('#jobEditForm').submit(function(e) {
			e.preventDefault();
			$.ajax({
                type: "POST",
                url : "<?= base_url('job/update'); ?>",
                data : "id="+$('#jobId').val()+"&service="+$('#jobEditService').val()+"&price="+$('#jobEditPrice').val()+"&importance="+$('#editJobImportance').val(),
                cache : false,
                dataType: "JSON",
                beforeSend: function() {
                    $('#saveJobBtn').attr('disabled','true');
                    $('#saveJobBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
                },
                success: function(out)
                {
                	PNOTY("Job Updated",'success');  
                	$('#saveJobBtn').removeAttr('disabled');
                    $('#saveJobBtn').html('Save');
                    $('#jobPrice'+$('#jobId').val()).html(out['price']);
                    $('#jobService'+$('#jobId').val()).html(out['service']);
                    $('#jobImportance'+$('#jobId').val()).html(out['importance']);
                    $('#jobEditModal').modal('hide');

                    $('#jobEditBtn_'+$('#jobId').val()).data('importance',out['importance']);
                    $('#jobEditBtn_'+$('#jobId').val()).data('price',out['price']);
                    $('#jobEditBtn_'+$('#jobId').val()).data('service',$('#jobEditService').val());
                }
            });
		});


		$('.generateFullBill').click(function(event) {
			var _this = $(this);
			$.ajax({
                type: "POST",
                url : "<?= base_url('generate_bill/getJobs'); ?>",
                data : "client="+_this.data('client'),
                cache : false,
                dataType : "json",
                beforeSend: function() {
                    _this.attr('disabled','true');
                    _this.html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
                },
                success: function(out)
                {
                	$('#generateAllBillAppend').html(out['list']);
                	$('#generateAllBillClient').val(out['client']);
                	$('#generateAllBillModal').modal('show');
                	_this.removeAttr('disabled');
                    _this.html('Generate Full Bill');
                    invoiceTotal();
                }
            });
		});

		$('.generateBill').click(function(event) {
			var _this = $(this);
			$.ajax({
                type: "POST",
                url : "<?= base_url('generate_bill/getJob'); ?>",
                data : "job="+_this.data('job'),
                cache : false,
                dataType : "json",
                beforeSend: function() {
                    _this.attr('disabled','true');
                    _this.html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
                },
                success: function(out)
                {
                	$('#generateBillService').val(out['service']);
                	$('#generateBillService').attr("title",out['service']);
                	$('#generateBillPrice').val(out['price']);
                	$('#generateBillQty').val(out['qty']);
                	$('#generateBillTotal').val(out['qty'] * out['price']);
                	$('#generateBillJob').val(out['job']);
                	$('#generateBillModal').modal('show');
                	_this.removeAttr('disabled');
                    _this.html('Generate Bill');
                }
            });
		});

		$(document).on('click','.add-payment',function(){
			$('#add_payment_model').modal('show');
			$('.addPaymentClient').select2({
			    dropdownParent: $('#add_payment_model .modal-content')
			});
		});

		$(document).on('keyup','#generateBillQty',function(){
			if($('#generateBillQty').val() != "" && $('#generateBillPrice').val() != ""){
				total = parseFloat($('#generateBillQty').val())  * parseFloat($('#generateBillPrice').val());
				$('#generateBillTotal').val(total.toFixed(2));
			}else{
				$('#generateBillTotal').val(0);
			}
		});

		$(document).on('keyup','#generateBillPrice',function(){
			if($('#generateBillQty').val() != "" && $('#generateBillPrice').val() != ""){
				total = parseFloat($('#generateBillQty').val())  * parseFloat($('#generateBillPrice').val());
				$('#generateBillTotal').val(total.toFixed(2));
			}else{
				$('#generateBillTotal').val(0);
			}
		});

		$(document).on('click','.edit-payment',function(){
			var _this = $(this);
			$('#edit_payment_model').modal('show');
			$('#editPaymentDate').val(_this.data('date'));
			$('#editPaymentAmount').val(_this.data('amount'));
			$('#editPaymentClient').val(_this.data('client'));
			$('#editPaymentRemarks').val(_this.data('remarks'));
			$('#editPaymentType').val(_this.data('pay_type'));
			$('#editPaymentPayRemarks').val(_this.data('pay_remarks'));
			$('#editPaymentId').val(_this.data('id'));

			$('.editPaymentClient').select2({
			    dropdownParent: $('#edit_payment_model .modal-content')
			});
		});

		$(document).on('click','.approve-payment',function(){
			var _this = $(this);
			$.ajax({
                type: "POST",
                url : "<?= base_url('request/payment_approve'); ?>",
                data : "id="+_this.data('id'),
                cache : false,
                beforeSend: function() {
                    _this.attr('disabled','true');
                    _this.html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
                },
                success: function(out)
                {
                	PNOTY("Payment Approved",'success');  
                	_this.closest('tr').remove();
                }
            });
		});

		$('.add_contact_personRow').click(function(event) {
			var str = "";
			str += '<tr><td>';
				str += '<input type="text" name="con_name[]" class="form-control form-control-sm" placeholder="Name">';
			str += '</td><td>';
				str += '<input type="text" name="con_mobile[]" class="form-control form-control-sm numbers" placeholder="Mobile" minlength="10" maxlength="10" >';
			str += '</td><td>';
				str += '<textarea class="form-control" placeholder="Address" name="con_address[]"></textarea>';
			str += '</td><td><input type="text" name="con_birth[]" class="form-control form-control-sm birth-date" value="" placeholder="Birth Date" readonly>';
			str += '</td><td class="text-center">';
				str += '<button class="btn btn-danger btn-mini remove_contact_personRow" type="button"><i class="fa fa-minus"></i></button>';

			str += '</td></tr>';
			$('#contact_person_row').append(str);
		});
		$(document).on('click','.remove_contact_personRow',function(){
			$(this).closest('tr').remove();
		});

		$('#addGroupForm').submit(function(event) {
			event.preventDefault();
			var _this = $('#addGroupSubmitBtn');
			$.ajax({
                type: "POST",
                url : "<?= base_url('client/add_group'); ?>",
                data : "main="+$('#addGroupChild').val()+"&child="+$('#addGroupMain').val()+"&relation="+$('#addGroupRelation').val()+"&remarks="+$('#addGroupRemarks').val(),
                cache : false,
                dataType: "JSON",
                beforeSend: function() {
                    _this.attr('disabled','true');
                    _this.html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
                },
                success: function(out)
                {
                	PNOTY("Group Member Added",'success');  
                	str = "<tr>";
                	str += '<td class="text-center">'+out['group']+'</td>';
                	str += '<td>'+out['name']+'</td>';
                	str += '<td class="text-center">'+out['relation']+'</td>';
                	str += '<td class="text-center">'+out['client']+'</td>';
                	str += '<td>'+out['remarks']+'</td>';
                	str += "</tr>";
                	$('#addGroupTbody').append(str);
                	_this.removeAttr('disabled');
                    _this.html('<i class="fa fa-plus"></i>');
                }
            });
		});

		$(document).on('click','#addTodo',function(){
			$('#add_todo_modal').modal('show');
			$('.select2n').select2({
			    dropdownParent: $('#add_todo_modal .modal-content')
			});
		});

		$(document).on('click','.delete-todo',function(){
			var _this = $(this);
			$.ajax({
                type: "POST",
                url : "<?= base_url('todo/delete'); ?>",
                data : "id="+_this.data('id'),
                cache : false,
                beforeSend: function() {
                    _this.attr('disabled','true');
                    _this.html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
                },
                success: function(out)
                {
                	PNOTY("To-Do Deleted",'success');  
                	_this.closest('tr').remove();
                }
            });
		});

		$('.customer-industry-select2').select2();
		$('.customer-sub-industry-select2').select2();
		

		$('#new_client_form').submit(function(event) {
			var pan = $('#panNo').val();
			$.ajax({
                type: "POST",
                url : "<?= base_url('client/panCheck'); ?>",
                data : "pan="+pan,
                cache : false,
                dataType: "JSON",
                context: this,
                beforeSend: function() {
                    $('#ajaxLoader').fadeIn('fast');
                },
                success: function(out){
                	if(out[0] == '0'){
                		this.submit();
                	}else{
                		PNOTY(out[1],'error');  
                		$('#panNo').focus();
                	}
                	$('#ajaxLoader').fadeOut('slow');
                }
            });
            return false;
		});

		$('#editNewWorkBtn').click(function() {
			$('.select2n').select2({
			    dropdownParent: $('#editNewFollowupJobModel .modal-content')
			});
			$('#editNewFollowupJobModel').modal('show');
		});

		$('#addNewFollowupJob').click(function(event) {
			$('.select2n').select2({
			    dropdownParent: $('#addNewFollowupJobModel .modal-content')
			});
			$('#addNewFollowupJobModel').modal('show');
		});

		$('.serviceToPrice').change(function(event) {
			if($(this).val() != ""){
				$('.serviewFromPrice').val($(this).val().split("-")[1]);
			}else{
				$('.serviewFromPrice').val("");
			}
		});

		$('#serviceJobFollowupNew').change(function(event) {
			if($(this).val() != ""){
				$('#servicePriceJobFollowupNew').val($(this).val().split("-")[1]);
			}else{
				$('#servicePriceJobFollowupNew').val("");
			}
		});
	})
	



	function otherArea(val){
		if(val == '3244'){
			$('#otherArea').show();
			$('.other-area').attr('required',true);
		}else{
			$('#otherArea').hide();
			$('.other-area').removeAttr('required');
		}
	}

	function invoiceTotal () {
		maintotal = 0;
		$(".generateFullBillJobList").each(function() {
			_this = $(this).val();
		    if($('#generateBillQty'+_this).val() != "" && $('#generateBillPrice'+_this).val() != ""){
				total = parseFloat($('#generateBillQty'+_this).val())  * parseFloat($('#generateBillPrice'+_this).val());
				maintotal += total;
				$('#generateBillTotal'+_this).val(total.toFixed(2));
			}else{
				$('#generateBillTotal'+_this).val(0);
			}
		});

		$('#generateBillsTotal').val(maintotal.toFixed(2));
	}

	function generateMultipleBill (client) {
		_this = $('.generateFullBill'+client);
		if($('.generateBill'+client+':checked').length > 0){
			str = "";
			$('.generateBill'+client+':checked').each(function () {
		       	str += $(this).val()+",";
		  	});
			$.ajax({
                type: "POST",
                url : "<?= base_url('generate_bill/getJobs'); ?>",
                data : {job : str,client : client},
                cache : false,
                dataType : "json",
                beforeSend: function() {
                    _this.attr('disabled','true');
                    _this.html('<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait');
                },
                success: function(out)
                {
                	$('#generateAllBillAppend').html(out['list']);
                	$('#generateAllBillClient').val(out['client']);
                	$('#generateAllBillModal').modal('show');
                	_this.removeAttr('disabled');
                    _this.html('Generate Full Bill');
                    invoiceTotal();
                }
            });
		}else{
			alert('Please Select Bill');
		}
	}
</script>



<script type="text/javascript">
	setInterval(function(){ 
	    getNotification();
	    getTodoNotification();
	}, 2000);

	$(function(){
		$('#zeroNotificationCounter').click(function(){
			$('#notificationCounter').html(0);
			setTimeout(function() { $('#newNotification').hide(); }, 5000);
			
		})

		$('#zeroTodoCounter').click(function(event) {
			$('#todoCounter').html(0);
			setTimeout(function() { $('#newTodo').hide(); }, 5000);
		});
	})

	function redirectUrl(url = ""){
		window.location = url;
	}

	function getNotification(){
		$.ajax({
            type: "POST",
            url : "<?= base_url('followup/getNotifications'); ?>",
            cache : false,
            dataType : "json",
            success: function(out)
            {
            	$.each(out[0], function(key,value) {
				   notifyMe(value['title'],value['desc'],value['url']);
				});

				if(out[2] != 0){
					$('#notificationList li:eq(0)').after(out[1]);
					counter = parseFloat($('#notificationCounter').html());
					counter += out[2];
					$('#notificationCounter').html(counter);
					$('#newNotification').show();
				}
            }
        });
	}

	function getTodoNotification(){
		$.ajax({
            type: "POST",
            url : "<?= base_url('followup/getTodoNotification'); ?>",
            cache : false,
            dataType : "json",
            success: function(out)
            {
            	$.each(out[0], function(key,value) {
				   notifyMe(value['title'],value['desc'],value['url']);
				});
				if(out[2] != 0){
					$('#todoList li:eq(0)').after(out[1]);
					counter = parseFloat($('#todoCounter').html());
					counter += out[2];
					$('#todoCounter').html(counter);
					$('#newTodo').show();
				}
            }
        });
	}

	// $(function(){
	// 	$('#mobile-collapse').click(function(event) {
	// 		if($('#mobile-collapse i').hasClass('icon-toggle-right')){
	// 			type = 0;
	// 		}else{
	// 			type = 1;
	// 		}

	// 		$.ajax({
	//             type: "POST",
	//             url : "<?= base_url('setting/save_sidebar_toggle'); ?>",
	//             cache : false,
	//             data: {type:type},
	//             success: function(out)
	//             {
	            	
	//             }
	//         });
	// 	});
	// });
</script>


