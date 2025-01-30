(()=>{"use strict";$("#replyId").summernote({minHeight:160,toolbar:[["style",["bold","italic","underline","clear"]],["font",["strikethrough"]],["para",["paragraph"]]]}),$(".edit-reply").summernote({minHeight:200,toolbar:[["style",["bold","italic","underline","clear"]],["font",["strikethrough"]],["para",["paragraph"]]]}),$(document).on("submit","#ticketReplyStoreForm",(function(e){return e.preventDefault(),""==$("#replyId").val()?(displayErrorMessage("Reply field is required."),!1):""===$("<div />").html($("#replyId").summernote("code")).text().trim().replace(/ \r\n\t/g,"")?(displayErrorMessage("Reply field is not contain only white space"),!1):($("#btnReply").prop("disabled",!0),void $.ajax({url:route("ticket.reply.store"),type:"POST",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),window.location.href=e.data)},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){$("#btnReply").prop("disabled",!1)}}))})),$(document).on("click",".edit-ticket-reply",(function(){var e=$(this).attr("data-id");$.ajax({url:route("ticket.reply.edit",e),type:"GET",success:function(e){if(e.success){var t=e.data;$("#ticketReplyID").val(t.id);var o=document.createElement("textarea");o.innerHTML=e.data.reply;var s=o.value;$("#editReplyID").summernote("code",s),$("#editTicketReplyModal").append("body").modal("show")}},error:function(e){displayErrorMessage(e.responseJSON.messages)}})})),$(document).on("submit","#ticketReplyUpdateForm",(function(e){if(e.preventDefault(),""==$("#editReplyID").val())return displayErrorMessage("Reply field is required."),!1;if(""===$("<div />").html($("#editReplyID").summernote("code")).text().trim().replace(/ \r\n\t/g,""))return displayErrorMessage("Reply field is not contain only white space"),!1;processingBtn("#ticketReplyUpdateForm","#btnEditReplySave","loading");var t=$("#ticketReplyID").val();$.ajax({url:route("ticket.reply.update",t),type:"PUT",data:$(this).serialize(),success:function(e){e.success&&(displaySuccessMessage(e.message),$("#editTicketReplyModal").modal("hide"),window.location.href=e.data)},error:function(e){displayErrorMessage(e.responseJSON.message)},complete:function(){processingBtn("#ticketReplyUpdateForm","#btnEditReplySave")}})})),$(document).on("click",".delete-ticket-reply",(function(){var e=$(this).attr("data-id");swal({title:Lang.get("messages.common.delete")+"!",text:Lang.get("messages.common.delete_confirm_common")+' "Ticket Reply"?',type:"warning",showCancelButton:!0,closeOnConfirm:!1,showLoaderOnConfirm:!0,confirmButtonColor:"#6777ef",cancelButtonColor:"#d33",cancelButtonText:Lang.get("messages.common.no"),confirmButtonText:Lang.get("messages.common.yes")},(function(){$.ajax({url:route("ticket.reply.destroy",e),type:"DELETE",success:function(e){e.success&&(window.location.href=e.data),swal({title:Lang.get("messages.common.deleted"),text:"Ticket Reply"+Lang.get("messages.common.has_been_delete"),type:"success",confirmButtonText:Lang.get("messages.common.ok"),confirmButtonColor:"#6777ef",timer:2e3})},error:function(e){swal({title:"",text:e.responseJSON.message,type:"error",confirmButtonText:Lang.get("messages.common.ok"),confirmButtonColor:"#6777ef",timer:5e3})}})}))}))})();