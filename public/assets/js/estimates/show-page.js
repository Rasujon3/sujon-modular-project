(()=>{"use strict";$(document).on("click","a",(function(s){s.stopPropagation()})),$(document).on("click","#markAsDraft, #markAsSend, #markAsExpired, #markAsDeclined, #markAsAccepted",(function(){var s=$(this).data("status");$.ajax({url:route("estimate.change-status",estimateId),type:"put",data:{status:s},success:function(s){s.success&&(window.location.reload(),displaySuccessMessage(s.message))},error:function(s){displayErrorMessage(s.responseJSON.message)}})})),$(document).on("click","#convertToInvoice",(function(){$.ajax({url:route("estimate.convert-to-invoice",estimateId),type:"post",success:function(s){if(s.success){var e=s.data.id;window.location.href=invoiceUrl+"/"+e,displaySuccessMessage(s.message)}},error:function(s){displayErrorMessage(s.responseJSON.message)}})}))})();