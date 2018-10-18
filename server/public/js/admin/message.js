$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    loadEventCheckBox();
    
});

function loadEventCheckBox(){
    $('input.checkAll').click(function(){
        let value = $(this).is(':checked');
        if(value){
            $('div.mailbox-messages input.checkbox').each(function(){
                $(this).prop( "checked", true );
            });
        }else{
            $('div.mailbox-messages input.checkbox').each(function(){
                $(this).prop( "checked", false );
            });
        }
        loadEnableDelete();
    }); 
    $('input.checkbox').click(function(){
        let checkAll = true;
        $('div.mailbox-messages input.checkbox').each(function(){
            if(!$(this).prop( "checked")){
                checkAll = false;
            }
        });
        if(checkAll){
            $('input.checkAll').prop("checked",true);
        }else{
            $('input.checkAll').prop("checked",false);
        }
        loadEnableDelete();
    });
}


function loadEnableDelete(){
	$('button.btn-delete').prop('disabled', true);
    var controlValue = $('.list_id');
    var listValueId = '';
	$('div.mailbox-messages input.checkbox').each(function(){
		if($(this).prop( "checked")){
			$('button.btn-delete').prop('disabled', false);
            var messageId = $(this).closest('td').find('.message_id').val();
            if(listValueId == '')
			     listValueId = messageId;
            else
                listValueId+= ',' + messageId;
		}
	});
    controlValue.val(listValueId);
}