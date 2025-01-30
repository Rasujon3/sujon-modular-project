(()=>{"use strict";$(document).on("click","#btnCancel",(function(){$("#noteContainer").summernote("code","")})),$(document).on("click","#btnNote",(function(){var e=n.summernote("code"),t=$("#ownerId").val(),o=$("#moduleId").val();if(n.summernote("isEmpty"))return!1;var s=""===$("<div />").html($("#noteContainer").summernote("code")).text().trim().replace(/ \r\n\t/g,"");if($("#noteContainer").summernote("isEmpty"))$("#noteContainer").val("");else if(s){return displayErrorMessage("Note field is not contain only white space"),$(this).button("reset"),!1}var a=$(this);a.button("loading"),$.ajax({url:route("notes.store"),type:"post",data:{note:e,owner_id:t,module_id:o},success:function(e){e.success&&function(e){var t=function(e){var n=e.id,t="";return e.added_by==authId&&(t='                    <a class="user__icons del-note d-none task-comment-delete" title="'+Lang.get("messages.common.delete")+'" data-id="'+n+'"><i class="fas fa-trash ml-0 card-delete-icon"></i></a>\n                    <a class="user__icons edit-note d-none task-comment-edit" title="'+Lang.get("messages.common.edit")+'" data-id="'+n+'"><i class="fas fa-edit mr-2 card-edit-icon"></i></a>\n                    <a class="user__icons save-note comment-save-icon-'+n+' d-none task-comment-check" data-id="'+n+'"><i class="far fa-check-circle card-save-icon text-success font-weight-bold hand-cursor mr-2 ml-2"></i></a>\n                    <a class="user__icons cancel-note comment-cancel-icon-'+n+' d-none task-comment-cancel" data-id="'+n+'"><i class="fas fa-times card-cancel-icon hand-cursor"></i></a>\n'),'<div class="activity clearfix notes__information" id="note__'+n+'">\n        <div class="activity-icon">\n            <img class="user__img profile" src="'+e.user.image_url+'" alt="User Image" width="50" height="50">\n            <span class="user__username">\n            </span>\n        </div>\n        <div class="activity-detail col-xl-11 col-lg-10 pt-1 mb-3">        <div class="mb-0 d-flex justify-content-between flex-wrap">        <div class="d-flex flex-wrap align-items-center">             <span class="font-weight-bold lead">'+e.user.full_name+'</span>\n            <span class="user__description text-job text-dark ml-2">Just now</span>\n        </div><div>'+t+'            </div></div>            <div class="user__comment mt-2 note-display comment-display-'+n+'" data-id="'+n+'">\n'+e.note+'           </div>\n           <div class="user__comment d-none note-edit comment-edit-'+n+'">\n           <div id="noteEditContainer'+n+'" class="quill-editor-container"></div>\n           </div>\n       </div>    </div>'}(e);$(".notes .activities").prepend(t),n.summernote("code",""),$(".no_notes").hide()}(e.data),a.button("reset")},error:function(e){a.button("reset"),printErrorMessage("#taskValidationErrorsBox",e)}})})),$(document).on("click",".del-note",(function(){var e=$(this).data("id");swal({title:Lang.get("messages.common.delete")+"!",text:Lang.get("messages.common.delete_note"),type:"warning",showCancelButton:!0,closeOnConfirm:!1,showLoaderOnConfirm:!0,confirmButtonColor:"#6777ef",cancelButtonColor:"#d33",cancelButtonText:Lang.get("messages.common.no"),confirmButtonText:Lang.get("messages.common.yes")},(function(){$.ajax({url:route("notes.destroy",e),type:"DELETE",success:function(n){n.success&&function(e,n){$("#note__"+e).remove(),$.ajax({url:ownerUrl+"/"+n+"/notes/notes-count",type:"POST",success:function(e){0==e.data&&($(".no_notes").show(),$(".no_notes").removeClass("d-none"))}})}(e,ownerId),swal({title:Lang.get("messages.common.deleted"),text:Lang.get("messages.common.note_delete"),type:"success",confirmButtonColor:"#6777ef",timer:2e3})},error:function(e){swal({title:"",text:e.responseJSON.message,type:"error",timer:5e3})}})}))}));var e=[];$(document).on("click",".note-display,.edit-note",(function(){var n=$(this).data("id");if($(document).find("[class*='comment-display-']").removeClass("d-none"),$(document).find("[class*='comment-edit-']").addClass("d-none"),$(document).find("[class*='comment-save-icon-']").addClass("d-none"),$(document).find("[class*='comment-cancel-icon-']").addClass("d-none"),$(".comment-display-"+n).addClass("d-none"),""===$("#noteEditContainer"+n).html())setNoteEditData(n);else{var t=$.trim($(".comment-display-"+n).html());e[n].summernote("code",""),e[n].summernote("code",t)}$(".comment-edit-"+n).removeClass("d-none"),$(".comment-save-icon-"+n).removeClass("d-none"),$(".comment-cancel-icon-"+n).removeClass("d-none")})),window.setNoteEditData=function(n){e[n]=$("#noteEditContainer"+n).summernote({placeholder:Lang.get("messages.placeholder.add_note"),minHeight:200,toolbar:[["style",["bold","italic","underline","clear"]],["font",["strikethrough"]],["para",["paragraph"]]]});var t=$.trim($(".comment-display-"+n).html());e[n].summernote("code",t)},$(document).on("click",".cancel-note",(function(){var e=$(this).data("id");$(this).addClass("d-none"),$(".comment-display-"+e).removeClass("d-none"),$(".comment-edit-"+e).addClass("d-none"),$(".comment-save-icon-"+e).addClass("d-none")})),$(document).on("click",".save-note",(function(){var n=$(this).data("id"),t=e[n].summernote("code"),o=$("#ownerId").val(),s=$("#moduleId").val();if(e[n].summernote("isEmpty"))return!1;var a=""===$("<div />").html($("#noteEditContainer"+n).summernote("code")).text().trim().replace(/ \r\n\t/g,"");if($("#noteEditContainer"+n).summernote("isEmpty"))$("#noteEditContainer"+n).val("");else if(a){return displayErrorMessage("Note field is not contain only white space"),$(this).button("reset"),!1}$.ajax({url:route("notes.update",n),type:"put",data:{note:t,owner_id:o,module_id:s},success:function(e){e.success&&function(e,n){$(".comment-display-"+e).html(n).removeClass("d-none"),$(".comment-edit-"+e).addClass("d-none"),$(".comment-save-icon-"+e).addClass("d-none"),$(".comment-cancel-icon-"+e).addClass("d-none")}(n,t)},error:function(e){printErrorMessage("#taskValidationErrorsBox",e)}})})),$(document).on("mouseenter",".notes__information",(function(){$(this).find(".del-note").removeClass("d-none"),$(this).find(".edit-note").removeClass("d-none")})),$(document).on("mouseleave",".notes__information",(function(){$(this).find(".del-note").addClass("d-none"),$(this).find(".edit-note").addClass("d-none")}));var n=$("#noteContainer").summernote({placeholder:Lang.get("messages.placeholder.add_note"),minHeight:200,toolbar:[["style",["bold","italic","underline","clear"]],["font",["strikethrough"]],["para",["paragraph"]]]})})();